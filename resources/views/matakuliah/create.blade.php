@extends('layouts.app')

@section('header')
    <h1>Tambah Matakuliah</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Form input Tambah Mahasiswa</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('matakuliah.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Kode</label>
                    <input type="text" name="kode_matakuliah" class="form-control @error('kode_matakuliah') is-invalid @enderror" value="{{ old('kode_matakuliah') }}">
                    @error('kode_matakuliah')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label>Nama Matakuliah</label>
                    <input type="text" name="nama_matakuliah" class="form-control @error('nama_matakuliah') is-invalid @enderror" value="{{ old('nama_matakuliah') }}">
                    @error('nama_matakuliah')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label>SKS</label>
                    <input type="text" name="sks" class="form-control @error('sks') is-invalid @enderror" value="{{ old('sks') }}">
                    @error('sks')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <a href="{{ route('matakuliah.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-navy">Simpan</button>
            </form>
        </div>
    </div>
@endsection