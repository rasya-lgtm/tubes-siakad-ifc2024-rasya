@extends('layouts.app')

@section('header')
    <h1>Dashboard</h1>
@endsection

@section('content')


    <div class="row">
        <div class="col-12">
            <div class="card card-navy card-outline mb-3">
                <div class="card-body py-3 d-flex align-items-center justify-content-between flex-wrap">
                    <div>
                        <h5 class="mb-1">Selamat datang {{ Auth::user()->name }}</h5>
                        <span class="text-muted">Berikut ringkasan data sistem akademik hari ini.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3 col-sm-6">
            <div class="info-box">
                <span class="info-box-icon bg-navy"><i class="fas fa-user-graduate"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Mahasiswa</span>
                    <span class="info-box-number">{{ $totalMahasiswa }}</span>
                    <span class="progress-description">Total terdaftar</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="info-box">
                <span class="info-box-icon bg-navy"><i class="fas fa-chalkboard-teacher"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Dosen</span>
                    <span class="info-box-number">{{ $totalDosen }}</span>
                    <span class="progress-description">Total terdaftar</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="info-box">
                <span class="info-box-icon bg-navy"><i class="fas fa-book"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Mata Kuliah</span>
                    <span class="info-box-number">{{ $totalMatakuliah }}</span>
                    <span class="progress-description">Total tersedia</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="info-box">
                <span class="info-box-icon bg-navy"><i class="fas fa-list-alt"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">KRS</span>
                    <span class="info-box-number">{{ $totalKrs }}</span>
                    <span class="progress-description">Total diambil</span>
                </div>
            </div>
        </div>
    </div>
@endsection