<?php

use App\Http\Controllers\DosenController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KrsController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});


Route::get('/dashboard', function () {
    return view('dashboard.index', [
        'totalMahasiswa' => \App\Models\Mahasiswa::count(),
        'totalDosen'     => \App\Models\Dosen::count(),
        'totalMatakuliah'=> \App\Models\Matakuliah::count(),
        'totalKrs'       => \App\Models\Krs::count(),
    ]);
})->middleware(['auth'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth'])->group(function() {
    Route::middleware(['isAdmin'])->group(function() {
        Route::resource('dosen', DosenController::class);
        Route::resource('mahasiswa', MahasiswaController::class);
        Route::resource('matakuliah', MatakuliahController::class);
    });

    Route::resource('krs', KrsController::class);
    Route::resource('jadwal', JadwalController::class);
});

//buat ping ke web biar ga mati
Route::get('/ping-db', function () {
    try {
        DB::select('SELECT 1');
        return response('Database OK', 200);
    } catch (\Exception $e) {
        return response('Database Error: ' . $e->getMessage(), 500);
    }
});

require __DIR__.'/auth.php';
