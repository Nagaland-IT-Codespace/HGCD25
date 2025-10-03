<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\ManageDistricts;
use App\Livewire\ManageEmployees;
use App\Livewire\ManageLocations;
use App\Livewire\ManageUsers;
use App\Livewire\ViewIndividualAssignments;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return view('welcome');
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Management Routes
    Route::get('manageUsers', ManageUsers::class)->name('manageUsers');
    Route::get('manageDistricts', ManageDistricts::class)->name('manageDistricts');
    Route::get('manageLocations', ManageLocations::class)->name('manageLocations');
    Route::get('manageEmployees', ManageEmployees::class)->name('manageEmployees');
    Route::get('viewIndividualAssignments/{empID}', ViewIndividualAssignments::class)->name('viewIndividualAssignments');
});

require __DIR__ . '/auth.php';
