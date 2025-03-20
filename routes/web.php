<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GuestController;

// Default route / Landing page
Route::get('/', function () {
    return view('auth/login');
});

// Routes for guest user
Route::middleware(['auth'])->group(function () {
    Route::get('guest/dashboard', [GuestController::class,'index'])->name('guest.dashboard');
});

// Routes/Middleware for admin user
Route::middleware(['auth', 'admin'])->group(function () {
    // Display all employees
    Route::get('admin/dashboard', [UserController::class, 'index'])->name('admin.dashboard');
    // Add employee
    Route::get('admin/create', [UserController::class,'create'])->name('admin/create');
    Route::post('admin/create/save', [UserController::class,'save'])->name('admin/create/save');
    // Edit employee
    Route::get('admin/edit/{id}', [UserController::class,'edit_form'])->name('admin/edit_form');
    Route::put('admin/edit/{id}', [UserController::class,'edit'])->name('admin/edit');
    // Delete employee
    Route::get('admin/delete/{id}', [UserController::class,'delete'])->name('admin/delete');
});

// Routes/Middleware for employee user
Route::middleware(['auth', 'employee', 'approval'])->group(function () {
    // Display all employees
    Route::get('employee/dashboard', [EmployeeController::class,'index'])->name('employee.dashboard');
    // Add employee
    Route::get('employee/create', [EmployeeController::class,'create'])->name('employee/create');
    Route::post('employee/create/save', [EmployeeController::class,'save'])->name('employee/create/save');
    // Edit employee
    Route::get('employee/edit/{id}', [EmployeeController::class,'edit_form'])->name('employee/edit_form');
    Route::put('employee/edit/{id}', [EmployeeController::class,'edit'])->name('employee/edit');
    // Delete employee
    Route::get('employee/delete/{id}', [EmployeeController::class,'delete'])->name('employee/delete');
});

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
