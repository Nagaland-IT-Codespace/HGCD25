<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        Log::info('Assignments fetched', ['filters' => $request->all(), 'count' => $assignments->count()]);


        return response()->json($assignments);
    }
}
