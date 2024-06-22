<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('roleView.permission.create');
});

// While using resource request no array will come 
Route::resource('permissions', App\Http\Controllers\PermissionController::class);

// While using resource request no array will come 
Route::get('permissions/{permissionId}/delete', [App\Http\Controllers\PermissionController::class, 'destroy']);

// While using resource request no array will come 
Route::resource('roles', App\Http\Controllers\RoleController::class);

// While using resource request no array will come 
Route::get('roles/{roleId}/delete', [App\Http\Controllers\RoleController::class, 'destroy']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
