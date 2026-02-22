<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\AntrianController;
use App\Http\Controllers\RekamMedisController;
use App\Http\Controllers\PoliController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\VitalSignController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\Icd10Controller;
use App\Http\Controllers\TindakanController;
use App\Http\Controllers\JadwalDokterController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\BookingController;

Route::get('/', function () {
    return redirect()->route('booking.create');
});

// Public: Booking Online
Route::get('/booking', [BookingController::class, 'create'])->name('booking.create');
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
Route::get('/booking/success/{kode_booking}', [BookingController::class, 'success'])->name('booking.success');
Route::get('/booking/check', [BookingController::class, 'checkStatus'])->name('booking.check');
Route::post('/booking/check-pasien', [BookingController::class, 'checkPasien'])->name('booking.check-pasien');
Route::post('/booking/get-jadwal', [BookingController::class, 'getJadwalDokter'])->name('booking.get-jadwal');
Route::post('/booking/get-status', [BookingController::class, 'getStatus'])->name('booking.get-status');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Semua user yang login bisa akses
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Antrian - Semua role bisa akses
    Route::resource('antrian', AntrianController::class)->except(['show', 'edit', 'update']);
    Route::post('/antrian/{antrian}/panggil', [AntrianController::class, 'panggil'])->name('antrian.panggil');
    Route::post('/antrian/{antrian}/layani', [AntrianController::class, 'layani'])->name('antrian.layani');
    Route::post('/antrian/{antrian}/selesai', [AntrianController::class, 'selesai'])->name('antrian.selesai');
    
    // Vital Sign - Semua role bisa akses
    Route::post('/vital-sign/{kunjungan}', [VitalSignController::class, 'store'])->name('vital_sign.store');
    Route::get('/vital-sign', [VitalSignController::class, 'index'])->name('vital_sign.index');
});

// Superadmin & Rekam Medis - Data Pasien
Route::middleware(['auth', 'role:superadmin|rekam_medis'])->group(function () {
    Route::resource('pasien', PasienController::class);
});

// Superadmin, Dokter, Rekam Medis - Rekam Medis
Route::middleware(['auth', 'role:superadmin|dokter|rekam_medis'])->group(function () {
    Route::get('/rekam-medis', [RekamMedisController::class, 'index'])->name('rekam_medis.index');
    Route::get('/rekam-medis/create/{kunjungan}', [RekamMedisController::class, 'create'])->name('rekam_medis.create');
    Route::post('/rekam-medis/{kunjungan}', [RekamMedisController::class, 'store'])->name('rekam_medis.store');
    Route::get('/rekam-medis/{rekam_medis}', [RekamMedisController::class, 'show'])->name('rekam_medis.show');
    Route::get('/rekam-medis/{rekam_medis}/edit', [RekamMedisController::class, 'edit'])->name('rekam_medis.edit');
    Route::put('/rekam-medis/{rekam_medis}', [RekamMedisController::class, 'update'])->name('rekam_medis.update');
});

// Superadmin Only - Master Data & Pengaturan
Route::middleware(['auth', 'role:superadmin'])->group(function () {
    Route::resource('poli', PoliController::class)->except(['show']);
    Route::get('/poli/create', [PoliController::class, 'create'])->name('poli.create');
    Route::resource('dokter', DokterController::class)->except(['show']);
    Route::get('/dokter/create', [DokterController::class, 'create'])->name('dokter.create');
    Route::resource('jadwal', JadwalDokterController::class);
    Route::resource('users', UserController::class)->except(['show']);
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::resource('ruangan', RuanganController::class);
    Route::resource('icd10', Icd10Controller::class);
    Route::resource('tindakan', TindakanController::class);
    Route::get('/pengaturan', [PengaturanController::class, 'index'])->name('pengaturan.index');
    Route::put('/pengaturan', [PengaturanController::class, 'update'])->name('pengaturan.update');
    
    // Booking Management
    Route::get('/booking-management', [BookingController::class, 'index'])->name('booking.index');
    Route::get('/booking/{booking}/detail', [BookingController::class, 'detail'])->name('booking.detail');
    Route::post('/booking/{booking}/confirm', [BookingController::class, 'confirm'])->name('booking.confirm');
    Route::post('/booking/{booking}/cancel', [BookingController::class, 'cancel'])->name('booking.cancel');
});

// API
Route::get('/api/dokters-by-poli', [AntrianController::class, 'getDoktersByPoli']);
