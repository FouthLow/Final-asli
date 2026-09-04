<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\KelasController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/gallery', [GalleryController::class, 'publicIndex'])->name('gallery.index');
Route::get('/gallery/{id}', [GalleryController::class, 'show'])->name('gallery.show');

// Route Halaman Hubungi (Contact)
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// Guest Auth Routes
Route::middleware(['guest', 'prevent-back-history'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Admin Protected Routes
Route::middleware(['auth', 'prevent-back-history'])->prefix('admin')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [GalleryController::class, 'index'])->name('admin.dashboard');

    // CRUD Siswa
    Route::resource('siswa', SiswaController::class)->names('admin.siswa');
    
    // CRUD Kelas
    Route::resource('kelas', KelasController::class)->names('admin.kelas');

    // CRUD News
    Route::resource('news', NewsController::class)->names('admin.news');

    // CRUD Guru
    Route::resource('guru', GuruController::class)->names('admin.guru');

    // CRUD Galleries
    Route::resource('galleries', GalleryController::class)->except(['index']);
    
    // CRUD Categories
    Route::resource('categories', CategoryController::class)->names('admin.categories');
});