@extends('layouts.app')

@section('header')
    <h1>Edit Jadwal</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Form Edit Jadwal</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('jadwal.update', $dataJadwal->id) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label>Kode</label>
                    <select name="kode_matakuliah" class="form-control @error('kode_matakuliah') is-invalid @enderror">
                        <option value="">-- Pilih Kode Matakuliah --</option>
                        @foreach ($dataMatakuliah as $matakuliah)
                            <option value="{{ $matakuliah->kode_matakuliah }}"
                                {{ old('kode_matakuliah', $dataJadwal->kode_matakuliah) == $matakuliah->kode_matakuliah ? 'selected' : '' }}>
                                {{ $matakuliah->kode_matakuliah }} - {{ $matakuliah->nama_matakuliah }}
                            </option>
                        @endforeach
                    </select>
                    @error('kode_matakuliah')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Nama Dosen</label>
                    <select name="nidn" class="form-control @error('nidn') is-invalid @enderror">
                        <option value="">-- Pilih Dosen --</option>
                        @foreach ($dataDosen as $dosen)
                            <option value="{{ $dosen->nidn }}" {{ old('nidn', $dataJadwal->nidn) == $dosen->nidn ? 'selected' : '' }}>
                                {{ $dosen->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('nidn')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Kelas</label>
                    <input type="text" name="kelas" placeholder="Contoh : A" class="form-control @error('kelas') is-invalid @enderror"
                        value="{{ old('kelas', $dataJadwal->kelas) }}">
                    @error('kelas')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Hari</label>
                    <select name="hari" class="form-control @error('hari') is-invalid @enderror">
                        <option value="">-- Pilih Hari --</option>
                        <option value="Senin" {{ old('hari', $dataJadwal->hari) == 'Senin' ? 'selected' : '' }}>Senin</option>
                        <option value="Selasa" {{ old('hari', $dataJadwal->hari) == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                        <option value="Rabu" {{ old('hari', $dataJadwal->hari) == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                        <option value="Kamis" {{ old('hari', $dataJadwal->hari) == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                        <option value="Jumat" {{ old('hari', $dataJadwal->hari) == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                        <option value="Sabtu" {{ old('hari', $dataJadwal->hari) == 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
                    </select>
                    @error('hari')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Jam</label>
                    <input type="time" name="jam" class="form-control @error('jam') is-invalid @enderror"
                        value="{{ old('jam', $dataJadwal->jam) }}">
                    @error('jam')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <a href="{{ route('jadwal.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-navy">Update</button>
            </form>
        </div>
    </div>
@endsection
