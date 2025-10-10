<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use Illuminate\Http\Request;
use Livewire\Attributes\Rule;

class ApiEmployeeController extends Controller
{
    public function getEmployees(Request $request)
    {
        // 1. Validate incoming request data
        $request->validate([
            'search' => 'nullable|string|max:255',
            'designation' => 'nullable|string|max:255',
            'district' => 'nullable|string|max:255',
            'per_page' => 'nullable|integer|min:1|max:100', // How many items per page
            'page' => 'nullable|integer|min:1', // Current page number
        ]);

        // 2. Build the query
        $employees = Employee::query();

        if ($request->has('search') && $request->input('search')) {
            $searchTerm = '%' . $request->input('search') . '%';
            $employees->where(function ($query) use ($searchTerm) {
                $query->where('full_name', 'like', $searchTerm)
                    ->orWhere('emp_code', 'like', $searchTerm)
                    ->orWhere('mobile', 'like', $searchTerm)
                    ->orWhere('designation', 'like', $searchTerm)
                    ->orWhere('office_name', 'like', $searchTerm)
                    ->orWhere('district', 'like', $searchTerm);
            });
        }

        if ($request->has('designation') && $request->input('designation')) {
            $employees->where('designation', $request->input('designation'));
        }

        if ($request->has('district') && $request->input('district')) {
            $employees->where('district', $request->input('district'));
        }

        if ($request->has('gender') && $request->input('gender')) {
            $employees->where('gender', $request->input('gender'));
        }

        $sortBy = $request->input('sort_by', 'full_name'); // Default sort by full_name
        $sortDirection = $request->input('sort_direction', 'asc'); // Default sort direction ascending

        $employees->orderBy($sortBy, $sortDirection);

        $perPage = $request->input('per_page', 15); // Default 15 items per page
        $paginatedEmployees = $employees->paginate($perPage);

        return EmployeeResource::collection($paginatedEmployees)
            ->response()
            ->setStatusCode(200);
    }
}
