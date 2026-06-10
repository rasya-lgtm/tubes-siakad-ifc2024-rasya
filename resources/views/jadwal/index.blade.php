@extends('layouts.app')

@section('content')
<div class="container-fluid p-0">
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 gap-3">
        <div>
            <h4 class="fw-bold text-dark mb-1" style="font-family: 'Segoe UI', sans-serif;">Data Jadwal Kuliah</h4>
            <p class="text-muted small mb-0">Manajemen waktu perkuliahan mahasiswa UNSUR.</p>
        </div>
        @if(auth()->user()->role == 'admin')
            <a href="{{ route('jadwal.create') }}" class="btn btn-primary shadow-sm rounded-3 px-4 py-2 fw-bold">
                <i class="bi bi-calendar-plus me-2"></i> Tambah Jadwal
            </a>
        @endif
    </div>

    <div class="card shadow-sm rounded-4 border-0 overflow-hidden">
        {{-- Desktop Table --}}
        <div class="table-responsive d-none d-md-block">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="px-4 py-3 text-muted small fw-bold">NO</th>
                        <th class="px-4 py-3 text-muted small fw-bold">MATA KULIAH</th>
                        <th class="px-4 py-3 text-muted small fw-bold">DOSEN PENGAMPU</th>
                        <th class="px-4 py-3 text-muted small fw-bold">HARI/JAM</th>
                        <th class="px-4 py-3 text-center text-muted small fw-bold">KELAS</th>
                        @if(auth()->user()->role == 'admin')
                            <th class="px-4 py-3 text-center text-muted small fw-bold">AKSI</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @forelse($dataJadwal as $key => $jadwal)
                        <tr>
                            <td class="px-4 py-3 text-muted small">{{ $key + 1 }}</td>
                            <td class="px-4 py-3">
                                <div class="fw-bold text-dark">{{ $jadwal->matakuliah->nama_matakuliah }}</div>
                                <div class="text-muted small" style="font-size: 11px;">Kode: {{ $jadwal->kode_matakuliah }}</div>
                            </td>
                            <td class="px-4 py-3 text-dark fw-medium small">{{ $jadwal->dosen->nama }}</td>
                            <td class="px-4 py-3">
                                <div class="fw-bold text-dark">{{ $jadwal->hari }}</div>
                                <div class="text-primary fw-bold small">{{ date('H:i', strtotime($jadwal->jam)) }} WIB</div>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <span class="badge bg-light text-dark border px-3 py-2 rounded-2 fw-bold">{{ $jadwal->kelas }}</span>
                            </td>
                            @if(auth()->user()->role == 'admin')
                                <td class="px-4 py-3 text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('jadwal.edit', $jadwal->id) }}" class="btn btn-sm btn-outline-info rounded-pill px-3">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('jadwal.destroy', $jadwal->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ auth()->user()->role == 'admin' ? '6' : '5' }}" class="text-center py-5 text-muted small">Belum ada data jadwal perkuliahan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Mobile Cards --}}
        <div class="d-md-none">
            @forelse($dataJadwal as $key => $jadwal)
                <div class="p-3 border-bottom {{ $loop->last ? 'border-bottom-0' : '' }}">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="fw-bold text-dark">{{ $jadwal->matakuliah->nama_matakuliah }}</div>
                        <span class="badge bg-primary rounded-pill px-3">{{ $jadwal->kelas }}</span>
                    </div>
                    <div class="text-muted small mb-1"><i class="bi bi-person me-1"></i> {{ $jadwal->dosen->nama }}</div>
                    <div class="d-flex align-items-center gap-3 mt-2">
                        <div class="small fw-bold text-dark"><i class="bi bi-calendar-event me-1 text-primary"></i> {{ $jadwal->hari }}</div>
                        <div class="small fw-bold text-primary"><i class="bi bi-clock me-1"></i> {{ date('H:i', strtotime($jadwal->jam)) }} WIB</div>
                    </div>
                    @if(auth()->user()->role == 'admin')
                        <div class="d-flex gap-2 mt-3">
                            <a href="{{ route('jadwal.edit', $jadwal->id) }}" class="btn btn-sm btn-outline-primary flex-grow-1 rounded-3">
                                <i class="bi bi-pencil-square me-1"></i> Edit
                            </a>
                            <form action="{{ route('jadwal.destroy', $jadwal->id) }}" method="POST" class="flex-grow-1" onsubmit="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger w-100 rounded-3">
                                    <i class="bi bi-trash me-1"></i> Hapus
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            @empty
                <div class="text-center py-5 text-muted small">Belum ada data jadwal perkuliahan.</div>
            @endforelse
        </div>
    </div>
</div>
@endsection
