@extends('layouts.app')

@section('content')
<div class="container-fluid p-0">
    <div class="mb-4">
        <h4 class="fw-bold text-dark mb-1" style="font-family: 'Segoe UI', sans-serif;">Edit Matakuliah</h4>
        <p class="text-muted small">Perbarui data matakuliah <strong>{{ $dataMatakuliah->nama_matakuliah }}</strong>.</p>
    </div>

    <div class="row g-4">
        <div class="col-12 col-lg-8">
            <div class="card shadow-sm rounded-4 border-0 p-4">
                <form action="{{ route('matakuliah.update', $dataMatakuliah->kode_matakuliah) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class="col-12 col-md-5">
                            <label class="form-label fw-bold small text-muted text-uppercase" style="letter-spacing: 0.5px;">Kode Matakuliah</label>
                            <input type="text" name="kode_matakuliah" class="form-control rounded-3 py-2 bg-light border-light-subtle @error('kode_matakuliah') is-invalid @enderror" value="{{ old('kode_matakuliah', $dataMatakuliah->kode_matakuliah) }}" readonly>
                            @error('kode_matakuliah') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12 col-md-7">
                            <label class="form-label fw-bold small text-muted text-uppercase" style="letter-spacing: 0.5px;">Nama Matakuliah</label>
                            <input type="text" name="nama_matakuliah" class="form-control rounded-3 py-2 border-light-subtle shadow-sm @error('nama_matakuliah') is-invalid @enderror" value="{{ old('nama_matakuliah', $dataMatakuliah->nama_matakuliah) }}" required maxlength="50">
                            @error('nama_matakuliah') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label class="form-label fw-bold small text-muted text-uppercase" style="letter-spacing: 0.5px;">Jumlah SKS</label>
                            <input type="number" name="sks" class="form-control rounded-3 py-2 border-light-subtle shadow-sm @error('sks') is-invalid @enderror" value="{{ old('sks', $dataMatakuliah->sks) }}" min="1" max="6" required>
                            @error('sks') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mt-4 pt-4 border-top d-flex flex-column flex-sm-row gap-2">
                        <button type="submit" class="btn btn-primary px-4 rounded-3 fw-bold">
                            <i class="bi bi-arrow-repeat me-2"></i> Update Matakuliah
                        </button>
                        <a href="{{ route('matakuliah.index') }}" class="btn btn-light px-4 rounded-3 text-muted fw-bold">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
