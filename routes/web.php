<?php

use App\Http\Controllers\DosenController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KrsController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Profile 
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Admin
Route::middleware(['auth', 'isAdmin'])->group(function(){
    Route::resource('dosen', DosenController::class);
    Route::resource('mahasiswa', MahasiswaController::class);
    Route::resource('matakuliah', MatakuliahController::class);
    Route::resource('krs', KrsController::class);
    Route::resource('jadwal', JadwalController::class);
});

//Mahasiswa
Route::middleware(['auth', 'isMahasiswa'])->group(function(){
    Route::resource('krs', KrsController::class)->only(['index', 'store', 'destroy']);
    Route::get('jadwal', [JadwalController::class, 'index'])->name('jadwal.mahasiswa');
});

require __DIR__.'/auth.php';