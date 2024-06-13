<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

/**
 * ! Jangan ubah route yang ada dalam group ini
 * */

Route::middleware('auth.guest')
    ->group(function () {
        Route::get('/guest/home', [HomeController::class, 'index'])->name('landing');
    });

Route::controller(AuthController::class)
    ->group(function () {
        Route::get('/', 'checkToken')->name('check');
        Route::get('/logout', 'logout')->name('logout'); // gunakan untuk logout
        Route::get('/roles', 'changeUserRole')->middleware('auth.token');
        Route::get('/login', 'redirectToLogin')->name('login');
    });

/**
 * ! Jadikan route di bawah sebagai halaman utama dari web
 * ! harap tidak mengubah nilai pada name();
 */
Route::middleware('auth.token')
    ->group(function () {
        Route::get('/home', [HomeController::class, 'index'])->name('home');
    });

/**
 * * Buat route-route baru di bawah ini
 * * Pastikan untuk selalu menggunakan middleware('auth.token')
 * * middleware tersebut digunakan untuk verifikasi access pengguna dengan web
 *
 * * Bisa juga ditambahkan dengan middleware lainnya.
 * * Berikut adalah beberapa middleware lain yang telah tersedia,
 * * dapat digunakan untuk mengatur akses route berdasarkan role user
 *
 * 1.) auth.admin -> biasa digunakan untuk akses route untuk manage user lain
 * 2.) auth.mahasiswa -> akses route untuk user dengan role mahasiswa
 * 3.) auth.dosen -> akses route untuk user dengan role dosen
 * 4.) auth.developer -> akses route untuk user developer
 *
 * ? contoh penggunaan: middleware(['auth.token', 'auth.mahasiswa'])
 */

Route::get('/profil', [ProfilController::class, 'profil'])->middleware('auth.token');

Route::controller(MahasiswaController::class)
    ->prefix('/kuesioner')
    ->middleware(['auth.token', 'auth.mahasiswa'])
    ->group(function () {

        // * Kuesioner Perkuliahan
        Route::get('/perkuliahan', 'kuesionerPerkuliahanView');
        Route::get('/perkuliahan/saran/{id}', 'saranPerkuliahanView');
        Route::post('/perkuliahan/saran/{id}', 'addSaranPerkuliahan');
        Route::get('/perkuliahan/{id}', 'getPertanyaanView');
        Route::post('/perkuliahan/{id}', 'addJawabanPerkuliahan');
    });

Route::controller(MahasiswaController::class)
    ->prefix('/kuesioner')
    ->group(function () {
        Route::get('/kegiatan', 'getKegiatanView');
        Route::get('/kegiatan/{id}', 'getPertanyaanKegiatanView');
        Route::post('/kegiatan/{id}', 'addJawabanKegiatan');
        Route::get('/kegiatan/saran/{id}', 'saranKegiatanView')->name('saranKegiatan');
    });

Route::controller(AdminController::class)
    ->prefix('/admin/kuesioner')
    ->middleware(['auth.token', 'auth.admin'])
    ->group(function () {
        Route::get('/kegiatan', 'kuesionerKegiatanView');
    });
