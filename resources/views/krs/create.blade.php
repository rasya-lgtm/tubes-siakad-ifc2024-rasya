@extends('layouts.app')

@section('header')
    <h1>Tambah KRS</h1>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Form input KRS</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('krs.store') }}" method="POST">
                @csrf
                
                @if(auth()->user()->role == 'admin')
                    <div class="form-group">
                        <label>Mahasiswa</label>
                        <select name="npm" class="form-control @error('npm') is-invalid @enderror">
                            <option value="">-- Pilih Mahasiswa --</option>
                            @foreach($dataMahasiswa as $mhs)
                                <option value="{{ $mhs->npm }}" {{ old('npm') == $mhs->npm ? 'selected' : '' }}>
                                    {{ $mhs->npm }} - {{ $mhs->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('npm')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                @else
                    <input type="hidden" name="npm" value="{{ auth()->user()->npm }}">
                    <div class="form-group">
                        <label>NPM</label>
                        <input type="text" class="form-control" value="{{ auth()->user()->npm }}" disabled>
                    </div>
                @endif

                <div class="form-group">
                    <label>Mata Kuliah</label>
                    <select name="kode_matakuliah" class="form-control @error('kode_matakuliah') is-invalid @enderror">
                        <option value="">-- Pilih Mata Kuliah --</option>
                        @foreach($dataMatakuliah as $mk)
                            <option value="{{ $mk->kode_matakuliah }}" {{ old('kode_matakuliah') == $mk->kode_matakuliah ? 'selected' : '' }}>
                                {{ $mk->kode_matakuliah }} - {{ $mk->nama_matakuliah }}
                            </option>
                        @endforeach
                    </select>
                    @error('kode_matakuliah')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mt-4">
                    <a href="{{ route('krs.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-navy">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
