@extends('layouts.app')

@section('header')
    <h1>Mata Kuliah</h1>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Daftar Jadwal Mata Kuliah</h1>
            <div class="card-tools">
                <a href="{{ route('matakuliah.create') }}" class="btn btn-outline-dark btn-sm">
                    <i class="fas fa-plus"></i> Tambah Matakuliah
                </a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead class="bg-navy">
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama Matakuliah</th>
                        <th>SKS</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($dataMatakuliah as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->kode_matakuliah }}</td>
                            <td>{{ $item->nama_matakuliah }}</td>
                            <td>{{ $item->sks }}</td>
                            <td>
                                <a href="{{ route('matakuliah.edit', $item->kode_matakuliah) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('matakuliah.destroy', $item->kode_matakuliah) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data ini?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center">Belum ada data matakuliah.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection