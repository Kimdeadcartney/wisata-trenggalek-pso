<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\RekomendasiController;
use App\Http\Controllers\WisataController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- RUTE DEFAULT / HOME ---
Route::get('/', [WisataController::class, 'index'])->name('home');

// Rute Tentang Trenggalek
Route::get('/about', [WisataController::class, 'about'])->name('about');

// Rute untuk mengecek koneksi
Route::get('/cek', function() {
    return "Rute Cek Berhasil!";
});

// --- TEMPORARY: Reset session PSO ---
Route::get('/clear-pso-session', function () {
    session()->forget(['pso_results', 'pso_rute', 'pso_meta', 'pso_data']);
    return redirect()->route('rekomendasi.langkah1');
});

// --- RUTE AUTENTIKASI ---
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

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
Route::post('/review/store', [ReviewController::class, 'store'])
    ->name('review.store')
    ->middleware('auth');

// --- RUTE DESTINASI ---
Route::prefix('destinasi')->name('destinasi.')->group(function () {
    Route::get('/', [WisataController::class, 'index'])->name('index');
    Route::get('/{id}', [WisataController::class, 'show'])->name('show');
});

// --- GRUP RUTE REKOMENDASI (PSO) ---
Route::prefix('rekomendasi')->name('rekomendasi.')->group(function () {

    // Langkah 1: Pilih Kategori
    Route::get('/pso',         [RekomendasiController::class, 'langkah1'])->name('pso');
    Route::get('/langkah-1',   [RekomendasiController::class, 'langkah1'])->name('langkah1');
    Route::post('/langkah-1',  [RekomendasiController::class, 'simpanLangkah1'])->name('simpanLangkah1');

    // Langkah 2: Lokasi, Durasi & Budget
    Route::get('/langkah-2',   [RekomendasiController::class, 'langkah2'])->name('langkah2');
    Route::post('/langkah-2',  [RekomendasiController::class, 'simpanLangkah2'])->name('simpanLangkah2');

    // Langkah 3: Tipe Rombongan & Minat
    Route::get('/langkah-3',   [RekomendasiController::class, 'langkah3'])->name('langkah3');
    Route::post('/langkah-3',  [RekomendasiController::class, 'simpanLangkah3'])->name('simpanLangkah3');

    // Langkah 4: Jumlah Destinasi & Bobot Prioritas
    Route::get('/langkah-4',   [RekomendasiController::class, 'langkah4'])->name('langkah4');

    // Proses PSO
    Route::post('/proses',     [RekomendasiController::class, 'prosesPSO'])->name('proses');

    // Loading & Hasil
    Route::get('/loading',     [RekomendasiController::class, 'loading'])->name('loading');
    Route::get('/hasil',       [RekomendasiController::class, 'hasil'])->name('hasil');

    // ── Update Rute (hapus / tambah destinasi dari halaman hasil) ──
    Route::post('/update-rute', [RekomendasiController::class, 'updateRute'])->name('updateRute');
});

// Alias untuk Blade "Tentang" (recommendations -> rekomendasi.pso)
Route::get('/recommendations', function() {
    return redirect()->route('rekomendasi.pso');
})->name('recommendations');