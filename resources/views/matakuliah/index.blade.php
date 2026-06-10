@extends('layouts.app')

@section('content')
<div class="container-fluid p-0">
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 gap-3">
        <div>
            <h4 class="fw-bold text-dark mb-1" style="font-family: 'Segoe UI', sans-serif;">Data Mata Kuliah</h4>
            <p class="text-muted small mb-0">Daftar kurikulum matakuliah Universitas Suryakancana.</p>
        </div>
        <a href="{{ route('matakuliah.create') }}" class="btn btn-primary shadow-sm rounded-3 px-4 py-2 fw-bold">
            <i class="bi bi-book me-2"></i> Tambah Matakuliah
        </a>
    </div>

    <div class="card shadow-sm rounded-4 border-0 overflow-hidden">
        {{-- Desktop Table --}}
        <div class="table-responsive d-none d-md-block">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="px-4 py-3 text-muted small fw-bold">KODE</th>
                        <th class="px-4 py-3 text-muted small fw-bold">NAMA MATAKULIAH</th>
                        <th class="px-4 py-3 text-center text-muted small fw-bold">SKS</th>
                        <th class="px-4 py-3 text-center text-muted small fw-bold">AKSI</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @forelse($dataMatakuliah as $mk)
                        <tr>
                            <td class="px-4 py-3 fw-bold text-dark">{{ $mk->kode_matakuliah }}</td>
                            <td class="px-4 py-3 text-dark fw-medium">{{ $mk->nama_matakuliah }}</td>
                            <td class="px-4 py-3 text-center">
                                <span class="badge bg-light text-dark border px-3 py-2 rounded-2 fw-bold">{{ $mk->sks }} SKS</span>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('matakuliah.edit', $mk->kode_matakuliah) }}" class="btn btn-sm btn-outline-info rounded-pill px-3">
                                        <i class="bi bi-pencil-square me-1"></i> Edit
                                    </a>
                                    <form action="{{ route('matakuliah.destroy', $mk->kode_matakuliah) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus matakuliah ini?')">
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
                            <td colspan="4" class="text-center py-5 text-muted small">Belum ada data matakuliah tersimpan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Mobile Cards --}}
        <div class="d-md-none">
            @forelse($dataMatakuliah as $mk)
                <div class="p-3 border-bottom {{ $loop->last ? 'border-bottom-0' : '' }}">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <div class="fw-bold text-dark">{{ $mk->nama_matakuliah }}</div>
                            <div class="text-muted small">Kode: {{ $mk->kode_matakuliah }}</div>
                        </div>
                        <span class="badge bg-light text-dark border fw-bold">{{ $mk->sks }} SKS</span>
                    </div>
                    <div class="d-flex gap-2 mt-3">
                        <a href="{{ route('matakuliah.edit', $mk->kode_matakuliah) }}" class="btn btn-sm btn-outline-primary flex-grow-1 rounded-3">
                            <i class="bi bi-pencil-square me-1"></i> Edit
                        </a>
                        <form action="{{ route('matakuliah.destroy', $mk->kode_matakuliah) }}" method="POST" class="flex-grow-1" onsubmit="return confirm('Apakah Anda yakin ingin menghapus matakuliah ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger w-100 rounded-3">
                                <i class="bi bi-trash me-1"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-center py-5 text-muted small">Belum ada data matakuliah tersimpan.</div>
            @endforelse
        </div>
    </div>
</div>
@endsection
