<?php

use App\Http\Controllers\Api\ApiAssignmentsController;
use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\ApiEmployeeController;
use App\Http\Controllers\Api\ApiUtilsController;
use App\Http\Controllers\Api\ReassignmentRequestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::post('/login', [ApiAuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('utils')->group(function () {
        Route::get('/districts', [ApiUtilsController::class, 'getDistricts']);
        Route::get('/locations', [ApiUtilsController::class, 'getLocations']);
    });

    Route::post('/assignments', [ApiAssignmentsController::class, 'getAssignments']);

    Route::post('/assignments/upload-photo', [ApiAssignmentsController::class, 'uploadPhoto']);

    Route::get('/employees', [ApiEmployeeController::class, 'getEmployees']);

    Route::get('/assignments/employee/{employee_id}', [ApiAssignmentsController::class, 'getIndividualAssignments']);
    Route::post('/assignments/add-assignment', [ApiAssignmentsController::class, 'addAssignment']);
    Route::get('/assignment/{id}', [ApiAssignmentsController::class, 'getSingleAssignment']);

    Route::get('/employees/duties/{emp_code}', [ApiAssignmentsController::class, 'getDutiesForEmployee']);

    Route::prefix('reassignment-requests')->group(function () {
        Route::post('/', [ReassignmentRequestController::class, 'store']);
        Route::get('/incoming', [ReassignmentRequestController::class, 'getIncomingRequests']);
        Route::get('/my-requests', [ReassignmentRequestController::class, 'getMyRequests']);
        Route::get('/{reassignment_request}', [ReassignmentRequestController::class, 'show']);
        Route::put('/{reassignment_request}', [ReassignmentRequestController::class, 'update']);
        Route::delete('/{reassignment_request}', [ReassignmentRequestController::class, 'destroy']);
    });
});
