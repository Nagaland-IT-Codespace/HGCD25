<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\PhotoVerification;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Geometry\Rectangle;
use Intervention\Image\Laravel\Facades\Image;

class ApiAssignmentsController extends Controller
{
    public function getAssignments(Request $request)
    {
        $query = Assignment::query();

        $location_id = $request->input('location_id');
        $date_of_assignment = $request->input('date_of_assignment');

        if ($location_id) {
            Log::info('Filtering assignments by location_id: ' . $location_id);
            $query->where('location_id', $location_id);
        }
        if ($date_of_assignment) {
            Log::info('Filtering assignments by date_of_assignment: ' . $date_of_assignment);
            $query->where('date_of_assignment', Carbon::parse($date_of_assignment)->format('Y-m-d'));
        }

        $query->with(['employee', 'location.district', 'photoVerifications']);

        $perPage = $request->input('per_page', 10);
        $assignments = $query->paginate($perPage);

        $assignments->getCollection()->load('employee', 'location.district', 'photoVerifications');

        $assignments->setCollection(
            $assignments->getCollection()->map(function ($assignment) {
                return [
                    'id' => $assignment->id,
                    'name' => $assignment->employee ? $assignment->employee->full_name : 'N/A',
                    'date_of_assignment' => $assignment->date_of_assignment,
                    'status' => $assignment->status,
                    'district_name' => $assignment->location && $assignment->location->district
                        ? $assignment->location->district->name
                        : 'N/A',
                    'location_name' => $assignment->location ? $assignment->location->name : 'N/A',

                    'photo_verifications' => $assignment->photoVerifications->map(function ($photo) {
                        return [
                            'id' => $photo->id,
                            'photo_url' => url(Storage::url($photo->photo_url)),
                            'verified_by' => $photo->verified_by,
                            'remarks' => $photo->remarks,
                            'created_at' => Carbon::parse($photo->created_at)->toDateTimeString(),
                        ];
                    }),
                ];
            })
        );


        return response()->json($assignments);
    }
    public function uploadPhoto(Request $request)
    {
        Log::info('Received photo upload request', $request->all());
        $validator = Validator::make($request->all(), [
            'assignment_id' => 'required|exists:assignments,id',
            'photo' => 'required|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        try {
            $base64Image = $request->input('photo');
            $imageData = base64_decode($base64Image);

            if ($imageData === false) {
                throw new Exception('Base64 decode failed.');
            }

            // Create Intervention Image instance (v3 API)
            $image = Image::read($imageData);

            // Extract metadata
            $latitude = $request->input('latitude');
            $longitude = $request->input('longitude');
            $timestamp = now()->format('Y-m-d H:i:s');

            $watermarkText1 = "Lat: {$latitude}, Lon: {$longitude}";
            $watermarkText2 = "Time: {$timestamp}";

            if ($latitude && $longitude) {
                // Lat/Lon line
                $image->text(
                    text: $watermarkText1,
                    x: 20,
                    y: $image->height() - 50,
                    font: function ($font) {
                     
                        $font->size(400);
                        $font->color('rgba(255,255,255,0.9)');
                        $font->align('left');
                        $font->valign('bottom');
                    }
                );

                // Timestamp line
                $image->text(
                    text: $watermarkText2,
                    x: 20,
                    y: $image->height() - 20,
                    font: function ($font) {
                        $font->size(400);
                        $font->color('rgba(255,255,255,0.9)');
                        $font->align('left');
                        $font->valign('bottom');
                    }
                );
            }

            // Define path and save
            $filepath = 'assignments/' . $request->input('assignment_id') . '/' . uniqid() . '.jpeg';

            Storage::disk('public')->put(
                $filepath,
                (string) $image->encodeByExtension('jpeg', quality: 90)
            );

            // Save database entries
            PhotoVerification::create([
                'assignment_id' => $request->input('assignment_id'),
                'verified_by' => Auth::id(),
                'photo_url' => $filepath,
                'remarks' => 'Photo uploaded via mobile app',
            ]);

            Assignment::where('id', $request->input('assignment_id'))->update([
                'status' => 'Completed',
            ]);

            return response()->json([
                'message' => 'Photo uploaded and watermarked successfully!',
                'photo_url' => Storage::url($filepath),
            ], 200);
        } catch (Exception $e) {
            // Log the error for debugging
            Log::error('Photo upload failed: ' . $e->getMessage());

            return response()->json([
                'message' => 'An error occurred while processing the image.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
