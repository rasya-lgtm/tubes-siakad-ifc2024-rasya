@extends('layouts.app')

@section('header')
    <h1>Mahasiswa</h1>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Mahasiswa</h3>
            <div class="card-tools">
                <a href="{{ route('mahasiswa.create') }}" class="btn btn-outline-dark btn-sm">
                    <i class="fas fa-plus"></i> Tambah Mahasiswa
                </a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead class="bg-navy">
                    <tr>
                        <th>No</th>
                        <th>NPM</th>
                        <th>Nama</th>
                        <th>Wali Dosen</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($dataMahasiswa as $i => $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->npm }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->dosen->nama ?? 'kosong' }}</td>
                            
                            <td>
                                <a href="{{ route('mahasiswa.edit', $item->npm) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('mahasiswa.destroy', $item->npm) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="text-center">Belum ada data.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection