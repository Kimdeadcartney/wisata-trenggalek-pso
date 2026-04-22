<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\RekomendasiController;
use App\Http\Controllers\WisataController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\ReviewController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- RUTE DEFAULT / HOME ---
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Rute untuk mengecek koneksi
Route::get('/cek', function() {
    return "Rute Cek Berhasil!";
});

// --- RUTE AUTENTIKASI (Login, Register, Logout) ---
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// Rute Logout (Menangani error Route [logout] not defined)
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');

// --- RUTE GOOGLE LOGIN ---
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

// --- RUTE REVIEW ---
// Menggunakan satu rute yang konsisten dengan nama 'review.store'
Route::post('/review/store', [ReviewController::class, 'store'])
    ->name('review.store')
    ->middleware('auth');

// --- RUTE DESTINASI ---
Route::prefix('destinasi')->name('destinasi.')->group(function () {
    // Menampilkan daftar semua destinasi (index)
    Route::get('/', [WisataController::class, 'index'])->name('index');
    
    // Menampilkan detail destinasi tertentu
    Route::get('/{id}', [WisataController::class, 'show'])->name('show');
});

// --- GRUP RUTE REKOMENDASI (PSO) ---
Route::prefix('rekomendasi')->name('rekomendasi.')->group(function () {
    
    // Langkah-langkah Input User
    Route::get('/langkah-1', [RekomendasiController::class, 'langkah1'])->name('langkah1');
    Route::post('/simpan-langkah-1', [RekomendasiController::class, 'simpanLangkah1'])->name('simpanLangkah1');
    
    Route::get('/langkah-2', [RekomendasiController::class, 'langkah2'])->name('langkah2');
    Route::post('/simpan-langkah-2', [RekomendasiController::class, 'simpanLangkah2'])->name('simpanLangkah2');

    Route::get('/langkah-3', [RekomendasiController::class, 'langkah3'])->name('langkah3');
    Route::post('/simpan-langkah-3', [RekomendasiController::class, 'simpanLangkah3'])->name('simpanLangkah3');

    Route::get('/langkah-4', [RekomendasiController::class, 'langkah4'])->name('langkah4');

    // Shortcut pso yang dipanggil di Navbar
    Route::get('/pso', [RekomendasiController::class, 'langkah1'])->name('pso');

    // --- ALUR PROSES PSO ---
    Route::post('/proses', [RekomendasiController::class, 'prosesPSO'])->name('proses');
    Route::get('/loading', [RekomendasiController::class, 'loading'])->name('loading');
    Route::get('/hasil', [RekomendasiController::class, 'hasil'])->name('hasil');
});