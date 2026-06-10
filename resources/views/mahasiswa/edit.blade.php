@extends('layouts.app')

@section('content')
<div class="container-fluid p-0">
    <div class="mb-4">
        <h4 class="fw-bold text-dark mb-1" style="font-family: 'Segoe UI', sans-serif;">Edit Data Mahasiswa</h4>
        <p class="text-muted small">Perbarui informasi biodata mahasiswa <strong>{{ $dataMahasiswa->nama }}</strong>.</p>
    </div>

    <div class="row g-4">
        <div class="col-12 col-lg-8">
            <div class="card shadow-sm rounded-4 border-0 p-4">
                <form action="{{ route('mahasiswa.update', $dataMahasiswa->npm) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class="col-12 col-md-5">
                            <label class="form-label fw-bold small text-muted text-uppercase" style="letter-spacing: 0.5px;">NPM</label>
                            <input type="text" name="npm" class="form-control rounded-3 py-2 bg-light border-light-subtle @error('npm') is-invalid @enderror" value="{{ old('npm', $dataMahasiswa->npm) }}" readonly>
                            @error('npm') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12 col-md-7">
                            <label class="form-label fw-bold small text-muted text-uppercase" style="letter-spacing: 0.5px;">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control rounded-3 py-2 border-light-subtle shadow-sm @error('nama') is-invalid @enderror" value="{{ old('nama', $dataMahasiswa->nama) }}" required maxlength="50">
                            @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold small text-muted text-uppercase" style="letter-spacing: 0.5px;">Dosen Wali</label>
                            <select name="nidn" class="form-select rounded-3 py-2 border-light-subtle shadow-sm @error('nidn') is-invalid @enderror" required>
                                <option value="">-- Pilih Dosen Wali --</option>
                                @foreach($dataDosen as $dosen)
                                    <option value="{{ $dosen->nidn }}" {{ old('nidn', $dataMahasiswa->nidn) == $dosen->nidn ? 'selected' : '' }}>
                                        {{ $dosen->nama }} ({{ $dosen->nidn }})
                                    </option>
                                @endforeach
                            </select>
                            @error('nidn') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mt-4 pt-4 border-top d-flex flex-column flex-sm-row gap-2">
                        <button type="submit" class="btn btn-primary px-4 rounded-3 fw-bold">
                            <i class="bi bi-arrow-repeat me-2"></i> Update Mahasiswa
                        </button>
                        <a href="{{ route('mahasiswa.index') }}" class="btn btn-light px-4 rounded-3 text-muted fw-bold">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
