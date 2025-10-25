@extends('sdm.layouts.master')

@section('menu')
@include('sdm.layouts.menu')
@endsection

@section('navbar')
@include('sdm.layouts.navbar')
@endsection

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Pengajuan Perjalanan Dinas (Pending)</h5>
            <span class="badge bg-light text-primary">{{ $perdins->count() }} pengajuan</span>
        </div>

        <div class="card-body">
            {{-- Alert sukses / error --}}
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            {{-- Tabel --}}
            <div class="table-responsive">
                <table class="table table-striped align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th class="text-center">#</th>
                            <th>Nama</th>
                            <th>Kota</th>
                            <th>Tanggal</th>
                            <th>Keterangan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($perdins as $perdin)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $perdin->user->name }}</td>
                            <td>{{ $perdin->fromCity->name }} <span class="text-muted">→</span> {{ $perdin->toCity->name }}</td>
                            <td>
                                {{ \Carbon\Carbon::parse($perdin->start_date)->translatedFormat('d M') }}
                                -
                                {{ \Carbon\Carbon::parse($perdin->end_date)->translatedFormat('d M Y') }}
                                ({{ $perdin->duration_days }} hari)
                            </td>
                            <td>{{ $perdin->purpose }}</td>
                            <td class="text-center">
                                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#confirmModal{{ $perdin->id }}">
                                    <i class="bi bi-check-circle"></i> Konfirmasi
                                </button>
                            </td>
                        </tr>
                        {{-- MODAL KONFIRMASI --}}
                        <!-- Modal Detail Perjalanan Dinas -->
                        <div class="modal fade" id="confirmModal{{ $perdin->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-md modal-dialog-centered">
                                <div class="modal-content border-0 shadow rounded-3" style="font-size: 0.85rem;">

                                    {{-- Header --}}
                                    <div class="modal-header bg-primary text-white py-2">
                                        <h6 class="modal-title mb-0">Detail Perjalanan Dinas</h6>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>

                                    {{-- Body --}}
                                    <div class="modal-body py-2">
                                        <form>
                                            @csrf
                                            <div class="mb-2">
                                                <label class="form-label fw-semibold small mb-1">Nama Pegawai</label>
                                                <input type="text" class="form-control form-control-sm" value="{{ $perdin->user->name }}" readonly>
                                            </div>

                                            <div class="row">
                                                <div class="col-6 mb-2">
                                                    <label class="form-label fw-semibold small mb-1">Kota Asal</label>
                                                    <input type="text" class="form-control form-control-sm" value="{{ $perdin->fromCity->name }}" readonly>
                                                </div>
                                                <div class="col-6 mb-2">
                                                    <label class="form-label fw-semibold small mb-1">Kota Tujuan</label>
                                                    <input type="text" class="form-control form-control-sm" value="{{ $perdin->toCity->name }}" readonly>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-6 mb-2">
                                                    <label class="form-label fw-semibold small mb-1">Tanggal Berangkat</label>
                                                    <input type="text" class="form-control form-control-sm"
                                                        value="{{ \Carbon\Carbon::parse($perdin->start_date)->translatedFormat('d M Y') }}" readonly>
                                                </div>
                                                <div class="col-6 mb-2">
                                                    <label class="form-label fw-semibold small mb-1">Tanggal Pulang</label>
                                                    <input type="text" class="form-control form-control-sm"
                                                        value="{{ \Carbon\Carbon::parse($perdin->end_date)->translatedFormat('d M Y') }}" readonly>
                                                </div>
                                            </div>

                                            <div class="mb-2">
                                                <label class="form-label fw-semibold small mb-1">Lama Perjalanan</label>
                                                <input type="text" class="form-control form-control-sm" value="{{ $perdin->duration_days }} hari" readonly>
                                            </div>

                                            <div class="mb-2">
                                                <label class="form-label fw-semibold small mb-1">Maksud / Tujuan</label>
                                                <textarea class="form-control form-control-sm" rows="2" readonly>{{ $perdin->purpose }}</textarea>
                                            </div>
                                            <hr class="my-3">

                                            <div class="row g-3 justify-content-center text-center">
                                                {{-- Total Hari --}}
                                                <div class="col-12 col-md-4">
                                                    <div class="card bg-light border-0 shadow-sm h-100 py-3">
                                                        <h6 class="fw-bold text-primary mb-1">Total Hari</h6>
                                                        <p class="mb-0 fs-6">{{ $perdin->duration_days }} hari</p>
                                                    </div>
                                                </div>

                                                {{-- Jarak Tempuh --}}
                                                <div class="col-12 col-md-4">
                                                    <div class="card bg-light border-0 shadow-sm h-100 py-3">
                                                        <h6 class="fw-bold text-primary mb-1">Jarak Tempuh</h6>
                                                        <p class="mb-0 fs-6">{{ number_format($perdin->distance_km, 2) }} km</p>
                                                        <p class="mb-0 small {{ $perdin->distance_km > 60 ? 'text-success' : 'text-danger' }}">
                                                            ({{ \App\Helpers\PerdinHelper::keteranganJarak($perdin->distance_km) }})
                                                        </p>
                                                    </div>
                                                </div>

                                                {{-- Total Uang Perdin --}}
                                                <div class="col-12 col-md-4">
                                                    <div class="card bg-light border-0 shadow-sm h-100 py-3">
                                                        <h6 class="fw-bold text-primary mb-1">Total Uang Perdin</h6>
                                                        <p class="mb-0 fs-6">Rp {{ number_format($perdin->total_allowance, 0, ',', '.') }}</p>
                                                    </div>
                                                </div>
                                            </div>

                                        </form>
                                    </div>

                                    {{-- Footer --}}
                                    <div class="modal-footer justify-content-center py-2">
                                        <!-- Tombol Tolak -->
                                        <button type="button" class="btn btn-danger btn-sm mx-2"
                                            data-bs-toggle="modal" data-bs-target="#rejectModal{{ $perdin->id }}">
                                            <i class="bi bi-x-circle"></i> Reject
                                        </button>

                                        <!-- Tombol Setujui -->
                                        <form action="{{ route('sdm.perdin.approve', $perdin->id) }}" method="POST" class="d-inline mx-2">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">
                                                <i class="bi bi-check-circle"></i> Approve
                                            </button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- Modal Alasan Penolakan (DILUAR modal utama) -->
                        <div class="modal fade" id="rejectModal{{ $perdin->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-sm">
                                <div class="modal-content border-0 shadow-sm rounded-3">
                                    <div class="modal-header bg-danger text-white py-2">
                                        <h6 class="modal-title mb-0">Alasan Penolakan</h6>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>

                                    <form action="{{ route('sdm.perdin.reject', $perdin->id) }}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold small">Catatan / Alasan</label>
                                                <textarea name="notes" class="form-control form-control-sm" rows="3"
                                                    placeholder="Tuliskan alasan penolakan..." required></textarea>
                                            </div>
                                        </div>

                                        <div class="modal-footer py-2">
                                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="bi bi-x-circle"></i> Tolak
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">Belum ada pengajuan perjalanan dinas.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('footer')
@include('sdm.layouts.footer')
@endsection