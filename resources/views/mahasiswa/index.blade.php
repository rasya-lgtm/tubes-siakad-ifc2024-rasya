@extends('layouts.app')

@section('content')
<div class="container-fluid p-0">
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 gap-3">
        <div>
            <h4 class="fw-bold text-dark mb-1" style="font-family: 'Segoe UI', sans-serif;">Data Mahasiswa</h4>
            <p class="text-muted small mb-0">Daftar mahasiswa aktif Universitas Suryakancana.</p>
        </div>
        <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary shadow-sm rounded-3 px-4 py-2 fw-bold">
            <i class="bi bi-person-plus me-2"></i> Tambah Mahasiswa
        </a>
    </div>

    <div class="card shadow-sm rounded-4 border-0 overflow-hidden">
        {{-- Desktop Table --}}
        <div class="table-responsive d-none d-md-block">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="px-4 py-3 text-muted small fw-bold">NO</th>
                        <th class="px-4 py-3 text-muted small fw-bold">NPM</th>
                        <th class="px-4 py-3 text-muted small fw-bold">NAMA LENGKAP</th>
                        <th class="px-4 py-3 text-muted small fw-bold">DOSEN WALI</th>
                        <th class="px-4 py-3 text-center text-muted small fw-bold">AKSI</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @forelse($dataMahasiswa as $key => $mhs)
                        <tr>
                            <td class="px-4 py-3 text-muted small">{{ $key + 1 }}</td>
                            <td class="px-4 py-3 fw-bold text-primary">{{ $mhs->npm }}</td>
                            <td class="px-4 py-3 text-dark fw-medium">{{ $mhs->nama }}</td>
                            <td class="px-4 py-3 text-muted small">
                                @if($mhs->dosen)
                                    <div class="text-dark fw-medium">{{ $mhs->dosen->nama }}</div>
                                    <div style="font-size: 10px;">NIDN: {{ $mhs->nidn }}</div>
                                @else
                                    <span class="text-danger">Belum diset</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('mahasiswa.edit', $mhs->npm) }}" class="btn btn-sm btn-outline-info rounded-pill px-3">
                                        <i class="bi bi-pencil-square me-1"></i> Edit
                                    </a>
                                    <form action="{{ route('mahasiswa.destroy', $mhs->npm) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data mahasiswa ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                            <i class="bi bi-trash me-1"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted small">Belum ada data mahasiswa tersimpan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Mobile Cards --}}
        <div class="d-md-none">
            @forelse($dataMahasiswa as $key => $mhs)
                <div class="p-3 border-bottom {{ $loop->last ? 'border-bottom-0' : '' }}">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <div class="fw-bold text-dark">{{ $mhs->nama }}</div>
                            <div class="text-primary small fw-bold">NPM: {{ $mhs->npm }}</div>
                        </div>
                        <span class="badge bg-light text-muted border">#{{ $key + 1 }}</span>
                    </div>
                    <div class="mt-2">
                        <small class="text-muted d-block">Dosen Wali:</small>
                        <div class="small fw-medium text-dark">{{ $mhs->dosen->nama ?? 'Belum diset' }}</div>
                    </div>
                    <div class="d-flex gap-2 mt-3">
                        <a href="{{ route('mahasiswa.edit', $mhs->npm) }}" class="btn btn-sm btn-outline-primary flex-grow-1 rounded-3">
                            <i class="bi bi-pencil-square me-1"></i> Edit
                        </a>
                        <form action="{{ route('mahasiswa.destroy', $mhs->npm) }}" method="POST" class="flex-grow-1" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data mahasiswa ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger w-100 rounded-3">
                                <i class="bi bi-trash me-1"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-center py-5 text-muted small">Belum ada data mahasiswa tersimpan.</div>
            @endforelse
        </div>
    </div>
</div>
@endsection
