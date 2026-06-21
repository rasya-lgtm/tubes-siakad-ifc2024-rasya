@extends('layouts.app')

@section('header')
    <h1>Tambah Mahasiswa</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Form input Tambah Mahasiswa</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('mahasiswa.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>NPM</label>
                    <input type="text" name="npm" class="form-control @error('npm') is-invalid @enderror" value="{{ old('npm') }}">
                    @error('npm')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}">
                    @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label>Wali Dosen</label>
                    <select name="nidn" class="form-control @error('nidn') is-invalid @enderror">
                        <option value="">-- Pilih Wali Dosen --</option>
                        @foreach($dataDosen as $dosen)
                            <option value="{{ $dosen->nidn }}" {{ old('nidn') == $dosen->nidn ? 'selected' : '' }}>
                                {{ $dosen->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('nidn')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-navy">Simpan</button>
            </form>
        </div>
    </div>
@endsection