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

// Guest Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Admin Protected Routes
Route::middleware('auth')->prefix('admin')->group(function () {
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

    // CRUD Galleries (tanpa method index karena index dipake buat dashboard)
    Route::resource('galleries', GalleryController::class)->except(['index']);
    
    // CRUD Categories (otomatis buat route index, store, destroy dll)
    Route::resource('categories', CategoryController::class);
});