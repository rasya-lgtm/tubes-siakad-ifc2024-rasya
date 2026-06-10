@extends('layouts.app')

@section('content')
<div class="container-fluid p-0">
    <div class="mb-4">
        <h4 class="fw-bold text-dark mb-1" style="font-family: 'Segoe UI', sans-serif;">Edit Data Dosen</h4>
        <p class="text-muted small">Perbarui informasi dosen <strong>{{ $dataDosen->nama }}</strong>.</p>
    </div>

    <div class="row g-4">
        <div class="col-12 col-lg-8">
            <div class="card shadow-sm rounded-4 border-0 p-4">
                <form action="{{ route('dosen.update', $dataDosen->nidn) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class="col-12 col-md-5">
                            <label class="form-label fw-bold small text-muted text-uppercase" style="letter-spacing: 0.5px;">NIDN</label>
                            <input type="text" name="nidn" class="form-control rounded-3 py-2 bg-light border-light-subtle @error('nidn') is-invalid @enderror" value="{{ old('nidn', $dataDosen->nidn) }}" readonly>
                            <div class="form-text text-muted" style="font-size: 11px;">NIDN bersifat permanen.</div>
                            @error('nidn') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold small text-muted text-uppercase" style="letter-spacing: 0.5px;">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control rounded-3 py-2 border-light-subtle shadow-sm @error('nama') is-invalid @enderror" value="{{ old('nama', $dataDosen->nama) }}" required maxlength="50">
                            @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mt-4 pt-4 border-top d-flex flex-column flex-sm-row gap-2">
                        <button type="submit" class="btn btn-primary px-4 rounded-3 fw-bold">
                            <i class="bi bi-arrow-repeat me-2"></i> Update Data
                        </button>
                        <a href="{{ route('dosen.index') }}" class="btn btn-light px-4 rounded-3 text-muted fw-bold">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
