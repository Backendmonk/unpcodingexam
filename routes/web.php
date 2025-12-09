<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminSoalController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login/admin', function () {
    return view('admin.login');
})->name('admin.login');

Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');

Route::get('/admin/tambahakun', [AdminController::class, 'tambahAkun'])->name('admin.tambahakun');
Route::post('/admin/usersadd', [AdminController::class, 'storeUser'])->name('admin.usersadd');

Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

route::get('/admin/soal',[AdminSoalController::class,'index'])->name('admin.soal');
route::post('/admin/soal/store',[AdminSoalController::class,'store'])->name('admin.soal.store');

Route::delete('/admin/soal/{id}/delete', [AdminSoalController::class, 'destroy'])
    ->name('admin.soal.delete');

});


