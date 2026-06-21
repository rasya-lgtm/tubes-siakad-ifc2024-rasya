@extends('layouts.app')

@section('header')
    <h1>Data Dosen</h1>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Dosen</h3>
            <div class="card-tools">
                <a href="{{ route('dosen.create') }}" class="btn btn-outline-dark btn-sm">
                    <i class="fas fa-plus"></i> Tambah Dosen
                </a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead class="bg-navy">
                    <tr>
                        <th>No</th>
                        <th>NIDN</th>
                        <th>Nama</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($dataDosen as $dosen)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $dosen->nidn }}</td>
                            <td>{{ $dosen->nama }}</td>
                            <td>
                                <a href="{{ route('dosen.edit', $dosen->nidn) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('dosen.destroy', $dosen->nidn) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data ini?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center">Belum ada data dosen.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection