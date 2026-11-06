<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\CourseController;

// Halaman utama
Route::get('/', [HomeController::class, 'index'])
    ->name('home');

// Pengelolaan data kursus (CRUD Pertemuan 11)
Route::resource('courses', CourseController::class);

// Daftar seluruh pendaftaran
Route::get('/daftar-pendaftaran', [
    EnrollmentController::class, 'index'
])->name('enrollments.index');

// Form tambah pendaftaran lama
Route::get('/enrollments/create', [
    EnrollmentController::class, 'create'
])->name('enrollments.create');

// Simpan pendaftaran lama
Route::post('/enrollments', [
    EnrollmentController::class, 'store'
])->name('enrollments.store');

// Form edit pendaftaran
Route::get('/enrollments/{enrollment}/edit', [
    EnrollmentController::class, 'edit'
])->name('enrollments.edit');

// Proses update pendaftaran
Route::put('/enrollments/{enrollment}', [
    EnrollmentController::class, 'update'
])->name('enrollments.update');

// Hapus pendaftaran
Route::delete('/enrollments/{enrollment}', [
    EnrollmentController::class, 'destroy'
])->name('enrollments.destroy');

// Form pendaftaran praktikum
Route::get('/pendaftaran-praktikum', [
    EnrollmentController::class, 'practicumCreate'
])->name('practicum.enrollments.create');

// Preview pendaftaran
Route::post('/pendaftaran-praktikum/preview', [
    EnrollmentController::class, 'practicumPreview'
])->name('practicum.enrollments.preview');

// Simpan pendaftaran praktikum
Route::post('/pendaftaran-praktikum/simpan', [
    EnrollmentController::class, 'practicumStore'
])->name('practicum.enrollments.store');

// Pengecekan kuota melalui AJAX
Route::get('/courses/{course}/availability', [
    EnrollmentController::class, 'availability'
])->name('courses.availability');
