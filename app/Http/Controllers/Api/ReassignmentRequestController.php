<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\ReassignmentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReassignmentRequestController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'assignment_id' => 'required|exists:assignments,id',
            'requested_to_emp_code' => 'required|exists:users,emp_code',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = Auth::user();
        $assignment = Assignment::find($request->assignment_id);

        // Check if the assignment belongs to the user who is requesting the reassignment
        if ($assignment->employee->emp_code != $user->emp_code) {
            return response()->json(['message' => 'This assignment does not belong to you.'], 403);
        }
        
        // check if user is requesting to himself
        if ($user->emp_code == $request->requested_to_emp_code) {
            return response()->json(['message' => 'You cannot reassign an assignment to yourself.'], 422);
        }


        $reassignmentRequest = ReassignmentRequest::create([
            'assignment_id' => $request->assignment_id,
            'requester_emp_code' => $user->emp_code,
            'requested_to_emp_code' => $request->requested_to_emp_code,
        ]);

        return response()->json($reassignmentRequest, 201);
    }

    public function getIncomingRequests(Request $request)
    {
        $user = Auth::user();
        $requests = ReassignmentRequest::where('requested_to_emp_code', $user->emp_code)
            ->with(['assignment', 'requester', 'requestedTo'])
            ->latest()
            ->get();

        return response()->json($requests);
    }

    public function getMyRequests(Request $request)
    {
        $user = Auth::user();
        $requests = ReassignmentRequest::where('requester_emp_code', $user->emp_code)
            ->with(['assignment', 'requester', 'requestedTo'])
            ->latest()
            ->get();

        return response()->json($requests);
    }

    /**
     * Display the specified resource.
     */
    public function show(ReassignmentRequest $reassignmentRequest)
    {
        $user = Auth::user();
        if ($reassignmentRequest->requester_emp_code !== $user->emp_code && $reassignmentRequest->requested_to_emp_code !== $user->emp_code) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json($reassignmentRequest->load(['assignment', 'requester', 'requestedTo']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ReassignmentRequest $reassignmentRequest)
    {
        $user = Auth::user();
        if ($reassignmentRequest->requested_to_emp_code !== $user->emp_code) {
            return response()->json(['message' => 'You are not authorized to update this request.'], 403);
        }

        $validator = Validator::make($request->all(), [
            'status' => 'required|in:accepted,rejected',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        
        if ($reassignmentRequest->status !== 'pending') {
            return response()->json(['message' => 'This request has already been actioned.'], 422);
        }


        $reassignmentRequest->status = $request->status;
        $reassignmentRequest->save();

        if ($request->status === 'accepted') {
            $assignment = $reassignmentRequest->assignment;
            // The user who accepted the request
            $newEmployee = $reassignmentRequest->requestedTo->employee;
            if ($newEmployee) {
                $assignment->employee_id = $newEmployee->id;
                $assignment->save();
            } else {
                // This case should be handled, maybe the user is not an employee.
                // For now, we assume the user is an employee.
            }
        }

        return response()->json($reassignmentRequest);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ReassignmentRequest $reassignmentRequest)
    {
        $user = Auth::user();
        if ($reassignmentRequest->requester_emp_code !== $user->emp_code) {
            return response()->json(['message' => 'You are not authorized to delete this request.'], 403);
        }

        if ($reassignmentRequest->status !== 'pending') {
            return response()->json(['message' => 'Only pending requests can be deleted.'], 422);
        }

        $reassignmentRequest->delete();

        return response()->json(null, 204);
    }
}
