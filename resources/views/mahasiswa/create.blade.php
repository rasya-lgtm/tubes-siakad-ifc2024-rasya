@extends('layouts.app')

@section('content')
<div class="container-fluid p-0">
    <div class="mb-4">
        <h4 class="fw-bold text-dark mb-1" style="font-family: 'Segoe UI', sans-serif;">Tambah Mahasiswa</h4>
    </div>

    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="card shadow-sm rounded-4 border-0 p-4">
                <form action="{{ route('mahasiswa.store') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-12 col-md-5">
                            <label class="form-label fw-bold small text-muted text-uppercase" style="letter-spacing: 0.5px;">NPM</label>
                            <input type="text" name="npm" class="form-control rounded-3 py-2 border-light-subtle shadow-sm @error('npm') is-invalid @enderror" value="{{ old('npm') }}" placeholder="Contoh: 2143001" required maxlength="10">
                            @error('npm') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12 col-md-7">
                            <label class="form-label fw-bold small text-muted text-uppercase" style="letter-spacing: 0.5px;">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control rounded-3 py-2 border-light-subtle shadow-sm @error('nama') is-invalid @enderror" value="{{ old('nama') }}" placeholder="Nama sesuai identitas" required maxlength="50">
                            @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold small text-muted text-uppercase" style="letter-spacing: 0.5px;">Dosen Wali</label>
                            <select name="nidn" class="form-select rounded-3 py-2 border-light-subtle shadow-sm @error('nidn') is-invalid @enderror" required>
                                <option value="">-- Pilih Dosen Wali --</option>
                                @foreach($dataDosen as $dosen)
                                    <option value="{{ $dosen->nidn }}" {{ old('nidn') == $dosen->nidn ? 'selected' : '' }}>
                                        {{ $dosen->nama }} ({{ $dosen->nidn }})
                                    </option>
                                @endforeach
                            </select>
                            @error('nidn') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mt-4 pt-4 border-top d-flex flex-column flex-sm-row gap-2">
                        <button type="submit" class="btn btn-primary px-4 rounded-3 fw-bold">
                            <i class="bi bi-person-check me-2"></i> Simpan Mahasiswa
                        </button>
                        <a href="{{ route('mahasiswa.index') }}" class="btn btn-light px-4 rounded-3 text-muted fw-bold">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
