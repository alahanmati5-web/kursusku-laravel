<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EnrollmentController;

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

// Pendaftaran praktikum Pertemuan 9
Route::get('/pendaftaran-praktikum', [
    EnrollmentController::class,
    'practicumCreate'
])->name('practicum.enrollments.create');

Route::post('/pendaftaran-praktikum/preview', [
    EnrollmentController::class,
    'practicumPreview'
])->name('practicum.enrollments.preview');

Route::get('/courses/{course}/availability', [
    EnrollmentController::class,
    'availability'
])->name('courses.availability');
