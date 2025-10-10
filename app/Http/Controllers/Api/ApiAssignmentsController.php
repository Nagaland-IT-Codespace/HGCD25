<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\PhotoVerification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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
            $query->where('date_of_assignment',Carbon::parse($date_of_assignment)->format('Y-m-d'));
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
        $validator = Validator::make($request->all(), [
            'assignment_id' => 'required|exists:assignments,id',
            'photo' => 'required|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $base64Image = $request->input('photo');
        $image = base64_decode($base64Image);

        if ($image === false) {
            return response()->json(['message' => 'Base64 decode failed.'], 400);
        }

        $filepath = 'assignments/' . $request->input('assignment_id') . '/' . uniqid() . '.jpeg';
        Storage::disk('public')->put($filepath, $image);

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
            'message' => 'Photo uploaded successfully!',
        ], 200);
    }
}
