<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminSiswaController;
use App\Http\Controllers\AdminSoalController;
use App\Http\Controllers\controllerlaporansiswa;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;

// =================== HALAMAN AWAL ======================
Route::get('/', function () {
    return view('welcome');
});

route::get('/admin/tambahakun',[AdminController::class, 'tambahAkun'])
    ->name('admin.tambahakun');
route::post('/admin/usersadd', [AdminController::class, 'storeUser'])
    ->name('admin.useradd');


// =================== AUTH ADMIN ========================
Route::get('/login/admin', function () {
    return view('admin.login');
})->name('admin.login');

Route::post('/admin/login', [AdminController::class, 'login'])
    ->name('admin.login.submit');


// =================== ROUTE ADMIN (auth wajib) ==========
Route::middleware('auth')->group(function () {

    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Soal
    Route::get('/admin/soal', [AdminSoalController::class, 'index'])->name('admin.soal');
    Route::post('/admin/soal/store', [AdminSoalController::class, 'store'])->name('admin.soal.store');
    Route::delete('/admin/soal/{id}/delete', [AdminSoalController::class, 'destroy'])->name('admin.soal.delete');

    // Siswa
    Route::get('/admin/siswa', [AdminSiswaController::class, 'index'])->name('admin.siswa');
    Route::post('/admin/siswa/store', [AdminSiswaController::class, 'store'])->name('admin.siswa.store');
    Route::delete('/admin/siswa/{id}/delete', [AdminSiswaController::class, 'destroy'])->name('admin.siswa.delete');

    // Laporan
    Route::get('/admin/laporan', [controllerlaporansiswa::class, 'index'])->name('admin.laporan');

});


// =================== ROUTE SISWA ========================

// Halaman login siswa
Route::get('/login/siswa', [SiswaController::class, 'index'])->name('siswa.login');

// Ambil nama siswa via Ajax
Route::get('/ajax/nama-siswa/{kelas}', [SiswaController::class, 'fetchNama'])
    ->where('kelas', '.*');

// Proses login siswa
Route::post('/login-siswa', [SiswaController::class, 'loginAction'])
    ->name('siswa.login.action');

// Dashboard siswa
Route::get('/siswa/dashboard', [SiswaController::class, 'dashboard'])
    ->name('siswa.dashboard');

// Submit ujian
Route::post('/siswa/submit-ujian', [SiswaController::class, 'submitUjian'])
    ->name('siswa.submit');

// Hasil ujian
Route::get('/siswa/hasil', [SiswaController::class, 'hasil'])
    ->name('siswa.hasil');

