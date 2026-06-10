@extends('layouts.app')

@section('content')
<div class="container-fluid p-0">
    <div class="mb-4">
        <h4 class="fw-bold text-dark mb-1" style="font-family: 'Segoe UI', sans-serif;">Tambah Jadwal Baru</h4>
    </div>

    <div class="row">
        <div class="col-12 col-lg-8">
            @if ($errors->any())
                <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4">
                    <div class="fw-bold mb-2 small"><i class="bi bi-exclamation-triangle me-2"></i> Periksa kembali inputan Anda:</div>
                    <ul class="mb-0 small">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card shadow-sm rounded-4 border-0 p-4">
                <form action="{{ route('jadwal.store') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-bold small text-muted text-uppercase" style="letter-spacing: 0.5px;">Mata Kuliah</label>
                            <select name="kode_matakuliah" class="form-select rounded-3 py-2 border-light-subtle shadow-sm @error('kode_matakuliah') is-invalid @enderror" required>
                                <option value="">-- Pilih Mata Kuliah --</option>
                                @foreach($dataMatakuliah as $mk)
                                    <option value="{{ $mk->kode_matakuliah }}" {{ old('kode_matakuliah') == $mk->kode_matakuliah ? 'selected' : '' }}>
                                        {{ $mk->nama_matakuliah }} ({{ $mk->kode_matakuliah }})
                                    </option>
                                @endforeach
                            </select>
                            @error('kode_matakuliah') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold small text-muted text-uppercase" style="letter-spacing: 0.5px;">Dosen Pengampu</label>
                            <select name="nidn" class="form-select rounded-3 py-2 border-light-subtle shadow-sm @error('nidn') is-invalid @enderror" required>
                                <option value="">-- Pilih Dosen --</option>
                                @foreach($dataDosen as $dosen)
                                    <option value="{{ $dosen->nidn }}" {{ old('nidn') == $dosen->nidn ? 'selected' : '' }}>
                                        {{ $dosen->nama }} ({{ $dosen->nidn }})
                                    </option>
                                @endforeach
                            </select>
                            @error('nidn') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold small text-muted text-uppercase" style="letter-spacing: 0.5px;">Hari</label>
                            <select name="hari" class="form-select rounded-3 py-2 border-light-subtle shadow-sm @error('hari') is-invalid @enderror" required>
                                <option value="">-- Pilih Hari --</option>
                                @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $hari)
                                    <option value="{{ $hari }}" {{ old('hari') == $hari ? 'selected' : '' }}>{{ $hari }}</option>
                                @endforeach
                            </select>
                            @error('hari') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold small text-muted text-uppercase" style="letter-spacing: 0.5px;">Tanggal & Jam</label>
                            <input type="datetime-local" name="jam" class="form-control rounded-3 py-2 border-light-subtle shadow-sm @error('jam') is-invalid @enderror" value="{{ old('jam') }}" required>
                            @error('jam') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold small text-muted text-uppercase" style="letter-spacing: 0.5px;">Kelas</label>
                            <input type="text" name="kelas" class="form-control rounded-3 py-2 border-light-subtle shadow-sm @error('kelas') is-invalid @enderror" value="{{ old('kelas') }}" placeholder="Contoh: A" required>
                            @error('kelas') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mt-4 pt-4 border-top d-flex flex-column flex-sm-row gap-2">
                        <button type="submit" class="btn btn-primary px-4 rounded-3 fw-bold">
                            <i class="bi bi-calendar-check me-2"></i> Simpan Jadwal
                        </button>
                        <a href="{{ route('jadwal.index') }}" class="btn btn-light px-4 rounded-3 text-muted fw-bold">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
