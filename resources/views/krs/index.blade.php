@extends('layouts.app')

@section('header')
    <h1>Daftar KRS</h1>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data KRS Mahasiswa</h3>
            <div class="card-tools">
                <a href="{{ route('krs.create') }}" class="btn btn-outline-dark btn-sm">
                    <i class="fas fa-plus"></i> Tambah KRS
                </a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead class="bg-navy">
                    <tr>
                        <th>No</th>
                        <th>NPM</th>
                        <th>Nama Mahasiswa</th>
                        <th>Mata Kuliah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($dataKrs as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->npm }}</td>
                            <td>{{ $item->mahasiswa->nama ?? 'N/A' }}</td>
                            <td>{{ $item->matakuliah->nama_matakuliah ?? 'N/A' }}</td>
                            <td>
                                <form action="{{ route('krs.destroy', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus KRS ini?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center">Belum ada data KRS.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection