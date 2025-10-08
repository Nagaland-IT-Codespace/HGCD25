<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::post('/login', [\App\Http\Controllers\Api\ApiAuthController::class, 'login']);


Route::prefix('utils')->group(function () {
    Route::get('/districts', [\App\Http\Controllers\Api\ApiUtilsController::class, 'getDistricts']);
    Route::get('/locations', [\App\Http\Controllers\Api\ApiUtilsController::class, 'getLocations']);
});


// Route::prefix('assignments')->group(function () {
    Route::post('/assignments', [\App\Http\Controllers\Api\ApiAssignmentsController::class, 'getAssignments']);
// });
