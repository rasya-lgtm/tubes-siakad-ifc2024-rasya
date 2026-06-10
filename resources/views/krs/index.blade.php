@extends('layouts.app')

@section('content')
<div class="container-fluid p-0">
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 gap-3">
        <div>
            <h4 class="fw-bold text-dark mb-1" style="font-family: 'Segoe UI', sans-serif;">{{ auth()->user()->role == 'admin' ? 'Kelola KRS Mahasiswa' : 'KRS Saya' }}</h4>
            <p class="text-muted small mb-0">Halaman kartu rencana studi Universitas Suryakancana.</p>
        </div>
        @if(auth()->user()->role == 'mahasiswa' || auth()->user()->role == 'admin')
            <a href="{{ route('krs.create') }}" class="btn btn-primary shadow-sm rounded-3 px-4 py-2 fw-bold">
                <i class="bi bi-plus-circle me-2"></i> {{ auth()->user()->role == 'admin' ? 'Daftarkan KRS' : 'Tambah Matakuliah' }}
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
                        @if(auth()->user()->role == 'admin')
                            <th class="px-4 py-3 text-muted small fw-bold">MAHASISWA</th>
                        @endif
                        <th class="px-4 py-3 text-muted small fw-bold">MATA KULIAH</th>
                        <th class="px-4 py-3 text-center text-muted small fw-bold">SKS</th>
                        <th class="px-4 py-3 text-center text-muted small fw-bold">AKSI</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @php $totalSks = 0; @endphp
                    @forelse($dataKrs as $key => $krs)
                        @php $totalSks += $krs->matakuliah->sks; @endphp
                        <tr>
                            <td class="px-4 py-3 text-muted small">{{ $key + 1 }}</td>
                            @if(auth()->user()->role == 'admin')
                                <td class="px-4 py-3">
                                    <div class="fw-bold text-dark">{{ $krs->mahasiswa->nama }}</div>
                                    <div class="text-primary small fw-bold" style="font-size: 11px;">NPM: {{ $krs->npm }}</div>
                                </td>
                            @endif
                            <td class="px-4 py-3">
                                <div class="fw-bold text-dark">{{ $krs->matakuliah->nama_matakuliah }}</div>
                                <div class="text-muted small" style="font-size: 11px;">Kode: {{ $krs->kode_matakuliah }}</div>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <span class="badge bg-light text-dark border px-3 py-2 rounded-2 fw-bold">{{ $krs->matakuliah->sks }} SKS</span>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <form action="{{ route('krs.destroy', $krs->id) }}" method="POST" onsubmit="return confirm('Batalkan pengambilan matakuliah ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                        <i class="bi bi-x-circle me-1"></i> Batal
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ auth()->user()->role == 'admin' ? '5' : '4' }}" class="text-center py-5 text-muted small">Belum ada data KRS yang diambil.</td>
                        </tr>
                    @endforelse
                </tbody>
                @if($dataKrs->count() > 0)
                    <tfoot class="bg-light fw-bold">
                        <tr>
                            <td colspan="{{ auth()->user()->role == 'admin' ? '3' : '2' }}" class="px-4 py-3 text-end">TOTAL SKS</td>
                            <td class="px-4 py-3 text-center text-primary fs-5">{{ $totalSks }}</td>
                            <td></td>
                        </tr>
                    </tfoot>
                @endif
            </table>
        </div>

        {{-- Mobile Cards - Modern Style --}}
        <div class="d-md-none bg-light bg-opacity-50">
            @forelse($dataKrs as $key => $krs)
                <div class="p-3 mb-2 bg-white border-bottom shadow-sm">
                    @if(auth()->user()->role == 'admin')
                        <div class="d-flex align-items-center mb-3 p-2 bg-primary bg-opacity-10 rounded-3">
                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold me-2" style="width: 32px; height: 32px; font-size: 12px;">
                                {{ substr($krs->mahasiswa->nama, 0, 1) }}
                            </div>
                            <div>
                                <div class="fw-bold text-dark small">{{ $krs->mahasiswa->nama }}</div>
                                <div class="text-primary fw-bold" style="font-size: 10px;">NPM: {{ $krs->npm }}</div>
                            </div>
                        </div>
                    @endif

                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="pe-2">
                            <div class="fw-bold text-dark" style="font-size: 15px;">{{ $krs->matakuliah->nama_matakuliah }}</div>
                            <div class="text-muted small mt-1"><i class="bi bi-code-square me-1"></i> {{ $krs->kode_matakuliah }}</div>
                        </div>
                        <span class="badge bg-white text-dark border px-2 py-1 rounded-2 fw-bold" style="font-size: 11px;">
                            <i class="bi bi-check2-circle text-success me-1"></i> {{ $krs->matakuliah->sks }} SKS
                        </span>
                    </div>

                    <div class="d-flex mt-3">
                        <form action="{{ route('krs.destroy', $krs->id) }}" method="POST" class="w-100" onsubmit="return confirm('Batalkan pengambilan matakuliah ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger w-100 rounded-3 py-2 fw-bold" style="font-size: 12px;">
                                <i class="bi bi-trash me-1"></i> Batalkan Matakuliah
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-center py-5 text-muted small bg-white">Belum ada data KRS yang diambil.</div>
            @endforelse
            
            @if($dataKrs->count() > 0)
                <div class="p-3 bg-white d-flex justify-content-between align-items-center fw-bold sticky-bottom shadow-lg border-top">
                    <div class="text-muted small">TOTAL SKS DIAMBIL:</div>
                    <div class="text-primary fs-4">{{ $totalSks }} <span class="fs-6 text-muted fw-normal">SKS</span></div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
