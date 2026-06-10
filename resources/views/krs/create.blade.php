@extends('layouts.app')

@section('content')
<div class="container-fluid p-0">
    <div class="mb-4">
        <h4 class="fw-bold text-dark mb-1" style="font-family: 'Segoe UI', sans-serif;">{{ auth()->user()->role == 'admin' ? 'Daftarkan KRS Mahasiswa' : 'Ambil Mata Kuliah' }}</h4>
    </div>

    <div class="row">
        <div class="col-12 col-lg-8">
            @if ($errors->any())
                <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4">
                    <ul class="mb-0 small fw-bold">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card shadow-sm rounded-4 border-0 p-4">
                <form action="{{ route('krs.store') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        @if(auth()->user()->role == 'admin')
                            <div class="col-12">
                                <label class="form-label fw-bold small text-muted text-uppercase" style="letter-spacing: 0.5px;">Mahasiswa</label>
                                <select name="npm" class="form-select rounded-3 py-2 border-light-subtle shadow-sm @error('npm') is-invalid @enderror" required>
                                    <option value="">-- Pilih Mahasiswa --</option>
                                    @foreach($dataMahasiswa as $mhs)
                                        <option value="{{ $mhs->npm }}" {{ old('npm') == $mhs->npm ? 'selected' : '' }}>
                                            {{ $mhs->nama }} ({{ $mhs->npm }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('npm') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        @else
                            <input type="hidden" name="npm" value="{{ auth()->user()->npm }}">
                            <div class="col-12">
                                <label class="form-label fw-bold small text-muted text-uppercase" style="letter-spacing: 0.5px;">Data Mahasiswa</label>
                                <div class="p-3 bg-light rounded-3 border">
                                    <div class="fw-bold text-dark">{{ auth()->user()->name }}</div>
                                    <div class="text-primary small fw-bold">NPM: {{ auth()->user()->npm ?? 'NPM Belum Diset' }}</div>
                                </div>
                            </div>
                        @endif

                        <div class="col-12">
                            <label class="form-label fw-bold small text-muted text-uppercase" style="letter-spacing: 0.5px;">Pilih Mata Kuliah</label>
                            <select name="kode_matakuliah" class="form-select rounded-3 py-2 border-light-subtle shadow-sm @error('kode_matakuliah') is-invalid @enderror" required>
                                <option value="">-- Pilih Mata Kuliah --</option>
                                @foreach($dataMatakuliah as $mk)
                                    <option value="{{ $mk->kode_matakuliah }}" {{ old('kode_matakuliah') == $mk->kode_matakuliah ? 'selected' : '' }}>
                                        {{ $mk->nama_matakuliah }} ({{ $mk->sks }} SKS)
                                    </option>
                                @endforeach
                            </select>
                            @error('kode_matakuliah') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mt-4 pt-4 border-top d-flex flex-column flex-sm-row gap-2">
                        <button type="submit" class="btn btn-primary px-4 rounded-3 fw-bold" {{ (auth()->user()->role !== 'admin' && !auth()->user()->npm) ? 'disabled' : '' }}>
                            <i class="bi bi-check-circle me-2"></i> Daftarkan KRS
                        </button>
                        <a href="{{ route('krs.index') }}" class="btn btn-light px-4 rounded-3 text-muted fw-bold">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
