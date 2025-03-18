<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\PaginationController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\NilaiController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth', 'verified')->group(function() {
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // student
    Route::prefix('students')->group(function () {
        Route::get('/', [StudentController::class, 'index'])->name('students');
        Route::get('/create', [StudentController::class, 'create'])->name('students.create');
        Route::post('/store', [StudentController::class, 'store'])->name('students.store');
        Route::get('/{id}/edit', [StudentController::class, 'edit'])->name('students.edit');
        Route::put('/{id}', [StudentController::class, 'update'])->name('students.update');
        Route::delete('/{id}', [StudentController::class, 'destroy'])->name('students.destroy');
    });

    // user
    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('user');
        Route::get('/create', [UserController::class, 'create'])->name('user.create');
        Route::post('/store', [UserController::class, 'store'])->name('user.store');
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::put('/{id}', [UserController::class, 'update'])->name('user.update');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    });

    // mapel
    Route::prefix('backend/mapel')->group(function () {
        Route::get('/', [MapelController::class, 'index'])->name('mapel');
        Route::get('/backend/mapel/create', [MapelController::class, 'create'])->name('mapel.create');
        Route::post('/backend/mapel/store', [MapelController::class, 'store'])->name('mapel.store');
        Route::get('/{id}/edit', [MapelController::class, 'edit'])->name('mapel.edit');
        Route::put('/{id}', [MapelController::class, 'update'])->name('mapel.update');
        Route::delete('/destroy/{id}', [MapelController::class, 'destroy'])->name('mapel.destroy');
        Route::get('/mapel/search', [MapelController::class, 'search'])->name('mapel.search');

    });


    // teacher (sudah diperbaiki, sesuai dengan database yang menggunakan "teacher" bukan "teachers")
    Route::prefix('teacher')->group(function () {
        Route::get('/', [TeacherController::class, 'index'])->name('teacher');
        Route::get('/create', [TeacherController::class, 'create'])->name('teacher.create');
        Route::post('/store', [TeacherController::class, 'store'])->name('teacher.store');
        Route::get('/{id}/edit', [TeacherController::class, 'edit'])->name('teacher.edit');
        Route::put('/{id}', [TeacherController::class, 'update'])->name('teacher.update');
        Route::delete('/{id}', [TeacherController::class, 'destroy'])->name('teacher.destroy');
    });

    // nilai
    Route::prefix('backend/nilai')->group(function () {
        Route::get('/', [NilaiController::class, 'index'])->name('nilai');
        Route::get('/create', [NilaiController::class, 'create'])->name('nilai.create');
        Route::post('/', [NilaiController::class, 'store'])->name('nilai.store');
        Route::get('/{id}/edit', [NilaiController::class, 'edit'])->name('nilai.edit');
        Route::put('/{id}', [NilaiController::class, 'update'])->name('nilai.update');
        Route::delete('/{id}', [NilaiController::class, 'destroy'])->name('nilai.destroy');
        Route::get('/students/search', [NilaiController::class, 'searchStudents'])->name('students.search');
        Route::get('/nilai/export/pdf', [NilaiController::class, 'exportPdf'])->name('nilai.export.pdf');
    });
    

    // profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    });


require __DIR__.'/auth.php';
