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
        $location_id = $request->query('location_id');
        $assignment_date = $request->query('assignment_date');


        if ($location_id) {
            $query->where('location_id', $location_id);
        }
        // if ($assignment_date) {
        //     $query->whereDate('assignment_date', $request->query('assignment_date'));
        // }

        $query->with(['employee', 'location']);
        $perPage = $request->query('per_page', 10);
        $assignments = $query->paginate($perPage);

        $assignments->through(function ($assignment) {
            return [
                'id' => $assignment->id,
                'name' => $assignment->employee ? $assignment->employee->full_name : 'N/A',
                'date_of_assignment' => $assignment->date_of_assignment,
                'status' => $assignment->status,
                'district_name' => $assignment->location ? $assignment->location->district->name : 'N/A',
                'location_name' => $assignment->location ? $assignment->location->name : 'N/A',
            ];
        });


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
