@extends('layouts.app')

@section('header')
    <h1>Tambah Dosen</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Form Input Data Dosen Baru</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('dosen.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>NIDN</label>
                    <input type="text" name="nidn" class="form-control @error('nidn') is-invalid @enderror" value="{{ old('nidn') }}">
                    @error('nidn')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}">
                    @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <a href="{{ route('dosen.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-navy">Simpan</button>
            </form>
        </div>
    </div>
@endsection