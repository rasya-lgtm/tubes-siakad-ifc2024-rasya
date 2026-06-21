@extends('layouts.app')

@section('header')
    <h1>Daftar Jadwal Mata Kuliah</h1>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Jadwal</h3>
            @if(auth()->user()->role == 'admin')
            <div class="card-tools">
                <a href="{{ route('jadwal.create') }}" class="btn btn-outline-dark btn-sm">
                    <i class="fas fa-plus"></i> Tambah Daftar Jadwal 
                </a>
            </div>
            @endif
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead class="bg-navy">
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama Dosen</th>
                        <th>Kelas</th>
                        <th>Hari</th>
                        <th>Jam</th>
                        @if(auth()->user()->role == 'admin')
                        <th>Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse($dataJadwal as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->kode_matakuliah }}</td>
                            <td>{{ $item->dosen->nama }}</td>
                            <td>{{ $item->kelas }}</td>
                            <td>{{ $item->hari }}</td>
                            <td>{{ $item->jam }}</td>
                            @if(auth()->user()->role == 'admin')
                            <td>
                                <a href="{{ route('jadwal.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('jadwal.destroy', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data ini?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center">Belum ada data jadwal.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection