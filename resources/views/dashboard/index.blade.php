@extends('layouts.app')

@section('content')
<div class="container-fluid p-0">
    @php
        $user = auth()->user();
        $role = $user->role;
        
        if($role == 'admin') {
            $totalMahasiswa = \App\Models\Mahasiswa::count();
            $totalDosen = \App\Models\Dosen::count();
            $totalMatakuliah = \App\Models\Matakuliah::count();
            $totalJadwal = \App\Models\Jadwal::count();
            $totalKrs = \App\Models\Krs::count();
            $recentMahasiswa = \App\Models\Mahasiswa::with('dosen')->latest()->take(5)->get();
        } else {
            $krsDiambil = \App\Models\Krs::where('npm', $user->npm)->count();
            $totalSks = \App\Models\Krs::where('npm', $user->npm)
                ->join('matakuliah', 'krs.kode_matakuliah', '=', 'matakuliah.kode_matakuliah')
                ->sum('sks');
            
            $mapHari = ['Monday' => 'Senin', 'Tuesday' => 'Selasa', 'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu', 'Sunday' => 'Minggu'];
            $hariDb = $mapHari[\Carbon\Carbon::now()->format('l')] ?? 'Senin';
            
            $jadwalHariIni = \App\Models\Jadwal::with(['matakuliah', 'dosen'])
                ->where('hari', $hariDb)
                ->whereHas('matakuliah.krs', function($q) use ($user) {
                    $q->where('npm', $user->npm);
                })
                ->get();
        }
    @endphp

    <div class="mb-4">
        <h4 class="fw-bold text-dark">Dashboard Overview</h4>
        <p class="text-muted small">Selamat datang kembali di Portal Akademik Universitas Suryakancana.</p>
    </div>

    @if($role == 'admin')
        {{-- Admin Grid Statistik --}}
        <div class="row g-3 g-md-4 mb-4">
            <div class="col-6 col-md-4 col-xl">
                <div class="card p-3 shadow-sm rounded-4 h-100 border-0">
                    <div class="d-flex flex-column flex-sm-row align-items-center text-center text-sm-start">
                        <div class="flex-shrink-0 bg-primary bg-opacity-10 p-2 p-sm-3 rounded-3 text-primary mb-2 mb-sm-0">
                            <i class="bi bi-people fs-4"></i>
                        </div>
                        <div class="ms-sm-3">
                            <div class="text-muted small fw-medium">Mahasiswa</div>
                            <div class="fs-5 fs-sm-4 fw-bold text-dark">{{ $totalMahasiswa }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-xl">
                <div class="card p-3 shadow-sm rounded-4 h-100 border-0">
                    <div class="d-flex flex-column flex-sm-row align-items-center text-center text-sm-start">
                        <div class="flex-shrink-0 bg-success bg-opacity-10 p-2 p-sm-3 rounded-3 text-success mb-2 mb-sm-0">
                            <i class="bi bi-person-badge fs-4"></i>
                        </div>
                        <div class="ms-sm-3">
                            <div class="text-muted small fw-medium">Dosen</div>
                            <div class="fs-5 fs-sm-4 fw-bold text-dark">{{ $totalDosen }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-xl">
                <div class="card p-3 shadow-sm rounded-4 h-100 border-0">
                    <div class="d-flex flex-column flex-sm-row align-items-center text-center text-sm-start">
                        <div class="flex-shrink-0 bg-info bg-opacity-10 p-2 p-sm-3 rounded-3 text-info mb-2 mb-sm-0">
                            <i class="bi bi-book fs-4"></i>
                        </div>
                        <div class="ms-sm-3">
                            <div class="text-muted small fw-medium">Mata Kuliah</div>
                            <div class="fs-5 fs-sm-4 fw-bold text-dark">{{ $totalMatakuliah }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-xl">
                <div class="card p-3 shadow-sm rounded-4 h-100 border-0">
                    <div class="d-flex flex-column flex-sm-row align-items-center text-center text-sm-start">
                        <div class="flex-shrink-0 bg-warning bg-opacity-10 p-2 p-sm-3 rounded-3 text-warning mb-2 mb-sm-0">
                            <i class="bi bi-calendar-check fs-4"></i>
                        </div>
                        <div class="ms-sm-3">
                            <div class="text-muted small fw-medium">Jadwal</div>
                            <div class="fs-5 fs-sm-4 fw-bold text-dark">{{ $totalJadwal }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 col-xl">
                <div class="card p-3 shadow-sm rounded-4 h-100 border-0">
                    <div class="d-flex flex-column flex-sm-row align-items-center text-center text-sm-start">
                        <div class="flex-shrink-0 bg-danger bg-opacity-10 p-2 p-sm-3 rounded-3 text-danger mb-2 mb-sm-0">
                            <i class="bi bi-file-earmark-text fs-4"></i>
                        </div>
                        <div class="ms-sm-3">
                            <div class="text-muted small fw-medium">Total KRS</div>
                            <div class="fs-5 fs-sm-4 fw-bold text-dark">{{ $totalKrs }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            {{-- Quick Actions --}}
            <div class="col-12 col-lg-4">
                <div class="card shadow-sm rounded-4 p-4 h-100 border-0">
                    <h6 class="fw-bold mb-4">Manajemen Data</h6>
                    <div class="list-group list-group-flush">
                        <a href="{{ route('dosen.index') }}" class="list-group-item list-group-item-action border-0 px-0 d-flex justify-content-between py-3">
                            <div class="d-flex align-items-center"><i class="bi bi-person-badge me-3 text-primary"></i> Data Dosen</div>
                            <i class="bi bi-chevron-right small text-muted"></i>
                        </a>
                        <a href="{{ route('mahasiswa.index') }}" class="list-group-item list-group-item-action border-0 px-0 d-flex justify-content-between py-3">
                            <div class="d-flex align-items-center"><i class="bi bi-people me-3 text-success"></i> Data Mahasiswa</div>
                            <i class="bi bi-chevron-right small text-muted"></i>
                        </a>
                        <a href="{{ route('matakuliah.index') }}" class="list-group-item list-group-item-action border-0 px-0 d-flex justify-content-between py-3">
                            <div class="d-flex align-items-center"><i class="bi bi-book me-3 text-info"></i> Data Matakuliah</div>
                            <i class="bi bi-chevron-right small text-muted"></i>
                        </a>
                        <a href="{{ route('jadwal.index') }}" class="list-group-item list-group-item-action border-0 px-0 d-flex justify-content-between py-3">
                            <div class="d-flex align-items-center"><i class="bi bi-calendar3 me-3 text-warning"></i> Atur Jadwal</div>
                            <i class="bi bi-chevron-right small text-muted"></i>
                        </a>
                        <a href="{{ route('krs.index') }}" class="list-group-item list-group-item-action border-0 px-0 d-flex justify-content-between py-3 border-bottom">
                            <div class="d-flex align-items-center"><i class="bi bi-file-earmark-check me-3 text-danger"></i> Kelola KRS</div>
                            <i class="bi bi-chevron-right small text-muted"></i>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Summary Table --}}
            <div class="col-12 col-lg-8">
                <div class="card shadow-sm rounded-4 overflow-hidden border-0">
                    <div class="p-4 border-bottom bg-white d-flex justify-content-between align-items-center">
                        <h6 class="fw-bold mb-0">Mahasiswa Terbaru</h6>
                        <a href="{{ route('mahasiswa.index') }}" class="btn btn-sm btn-light text-primary fw-bold px-3 rounded-pill">Lihat Semua</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="px-4 py-3 text-muted small fw-bold border-0">MAHASISWA</th>
                                    <th class="px-4 py-3 text-muted small fw-bold border-0 d-none d-md-table-cell">DOSEN WALI</th>
                                    <th class="px-4 py-3 text-center text-muted small fw-bold border-0">AKSI</th>
                                </tr>
                            </thead>
                            <tbody class="border-top-0">
                                @forelse($recentMahasiswa as $mhs)
                                    <tr>
                                        <td class="px-4">
                                            <div class="fw-bold text-dark">{{ $mhs->nama }}</div>
                                            <div class="text-muted small" style="font-size: 11px;">NPM: {{ $mhs->npm }}</div>
                                        </td>
                                        <td class="px-4 text-muted small d-none d-md-table-cell">{{ $mhs->dosen->nama }}</td>
                                        <td class="px-4 text-center">
                                            <a href="{{ route('mahasiswa.edit', $mhs->npm) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 border-0 bg-primary bg-opacity-10">Edit</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="3" class="text-center py-5 text-muted small">Belum ada data mahasiswa.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    @else
        {{-- Mahasiswa Grid Statistik --}}
        <div class="row g-3 mb-4">
            <div class="col-6 col-md-4">
                <div class="card p-3 shadow-sm rounded-4 h-100 border-0 border-start border-primary border-4 bg-white text-center text-sm-start">
                    <div class="text-muted small fw-bold text-uppercase" style="font-size: 10px; letter-spacing: 0.5px;">KRS Diambil</div>
                    <div class="fs-4 fw-bold mt-1 text-primary">{{ $krsDiambil }} <span class="fw-normal text-muted fs-6">Matkul</span></div>
                </div>
            </div>
            <div class="col-6 col-md-4">
                <div class="card p-3 shadow-sm rounded-4 h-100 border-0 border-start border-success border-4 bg-white text-center text-sm-start">
                    <div class="text-muted small fw-bold text-uppercase" style="font-size: 10px; letter-spacing: 0.5px;">Jadwal Hari Ini</div>
                    <div class="fs-4 fw-bold mt-1 text-success">{{ $jadwalHariIni->count() }} <span class="fw-normal text-muted fs-6">Sesi</span></div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card p-3 shadow-sm rounded-4 h-100 border-0 border-start border-info border-4 bg-white text-center text-sm-start">
                    <div class="text-muted small fw-bold text-uppercase" style="font-size: 10px; letter-spacing: 0.5px;">Total SKS</div>
                    <div class="fs-4 fw-bold mt-1 text-info">{{ $totalSks }} <span class="fw-normal text-muted fs-6">SKS</span></div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            {{-- Quick Menu --}}
            <div class="col-12 col-lg-4">
                <div class="card shadow-sm rounded-4 p-4 border-0 bg-white">
                    <h6 class="fw-bold mb-4">Akses Cepat</h6>
                    <div class="d-grid gap-3">
                        <a href="{{ route('krs.index') }}" class="btn btn-outline-primary text-start p-3 rounded-4 d-flex align-items-center border-0 bg-light">
                            <i class="bi bi-card-checklist fs-4 me-3 text-primary"></i>
                            <div>
                                <div class="fw-bold text-dark">Lihat KRS Saya</div>
                                <div class="text-muted small" style="font-size: 11px;">Cek daftar matakuliah diambil</div>
                            </div>
                        </a>
                        <a href="{{ route('krs.create') }}" class="btn btn-outline-success text-start p-3 rounded-4 d-flex align-items-center border-0 bg-light">
                            <i class="bi bi-plus-square fs-4 me-3 text-success"></i>
                            <div>
                                <div class="fw-bold text-dark">Ambil Matakuliah</div>
                                <div class="text-muted small" style="font-size: 11px;">Pendaftaran KRS Semester Baru</div>
                            </div>
                        </a>
                        <a href="{{ route('jadwal.index') }}" class="btn btn-outline-info text-start p-3 rounded-4 d-flex align-items-center border-0 bg-light">
                            <i class="bi bi-calendar3 fs-4 me-3 text-info"></i>
                            <div>
                                <div class="fw-bold text-dark">Jadwal Kuliah</div>
                                <div class="text-muted small" style="font-size: 11px;">Lihat jadwal mingguan aktif</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Table Jadwal --}}
            <div class="col-12 col-lg-8">
                <div class="card shadow-sm rounded-4 overflow-hidden h-100 border-0 bg-white">
                    <div class="p-4 border-bottom bg-white d-flex justify-content-between align-items-center">
                        <h6 class="fw-bold mb-0">Jadwal Hari Ini <span class="text-primary">({{ $hariDb }})</span></h6>
                        <i class="bi bi-clock-history text-muted"></i>
                    </div>
                    {{-- Desktop View --}}
                    <div class="table-responsive d-none d-md-block">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="px-4 py-3 text-muted small fw-bold border-0">JAM</th>
                                    <th class="px-4 text-muted small fw-bold border-0">MATA KULIAH</th>
                                    <th class="px-4 text-center text-muted small fw-bold border-0">KELAS</th>
                                </tr>
                            </thead>
                            <tbody class="border-top-0">
                                @forelse($jadwalHariIni as $j)
                                    <tr>
                                        <td class="px-4 py-3 text-primary fw-bold">{{ date('H:i', strtotime($j->jam)) }}</td>
                                        <td class="px-4">
                                            <div class="fw-bold text-dark">{{ $j->matakuliah->nama_matakuliah }}</div>
                                            <div class="text-muted small" style="font-size: 11px;">Dosen: {{ $j->dosen->nama }}</div>
                                        </td>
                                        <td class="px-4 text-center">
                                            <span class="badge bg-light text-dark border px-3 py-2 rounded-2 fw-bold">{{ $j->kelas }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="3" class="text-center py-5 text-muted small">Tidak ada jadwal hari ini.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{-- Mobile View --}}
                    <div class="d-md-none">
                        @forelse($jadwalHariIni as $j)
                            <div class="p-3 border-bottom {{ $loop->last ? 'border-bottom-0' : '' }}">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="text-primary fw-bold small">{{ date('H:i', strtotime($j->jam)) }}</span>
                                    <span class="badge bg-light text-dark border px-2 py-1 small rounded-1">Kelas {{ $j->kelas }}</span>
                                </div>
                                <div class="fw-bold text-dark">{{ $j->matakuliah->nama_matakuliah }}</div>
                                <div class="text-muted small" style="font-size: 11px;">{{ $j->dosen->nama }}</div>
                            </div>
                        @empty
                            <div class="text-center py-4 text-muted small">Tidak ada jadwal hari ini.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection