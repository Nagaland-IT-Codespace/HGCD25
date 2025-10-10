<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::post('/login', [\App\Http\Controllers\Api\ApiAuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('utils')->group(function () {
        Route::get('/districts', [\App\Http\Controllers\Api\ApiUtilsController::class, 'getDistricts']);
        Route::get('/locations', [\App\Http\Controllers\Api\ApiUtilsController::class, 'getLocations']);
    });

    Route::post('/assignments', [\App\Http\Controllers\Api\ApiAssignmentsController::class, 'getAssignments']);

    Route::post('/assignments/upload-photo', [\App\Http\Controllers\Api\ApiAssignmentsController::class, 'uploadPhoto']);

    Route::get('/employees', [\App\Http\Controllers\Api\ApiEmployeeController::class, 'getEmployees']);
});
