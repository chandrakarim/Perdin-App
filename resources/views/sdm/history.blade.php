@extends('sdm.layouts.master')

@section('menu')
@include('sdm.layouts.menu')
@endsection

@section('navbar')
@include('sdm.layouts.navbar')
@endsection

@section('content')
<div class="container my-4">
  <div class="card border-0 shadow-sm rounded-4">
    {{-- Header --}}
    <div class="card-header bg-primary text-white py-3 d-flex justify-content-between align-items-center rounded-top-4">
      <h5 class="mb-0 fw-semibold">
        <i class="bi bi-clock-history me-2"></i> Daftar History Pengajuan Perjalanan Dinas
      </h5>
    </div>

    {{-- Body --}}
    <div class="card-body p-4">

      {{-- Alert sukses --}}
      @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif

      {{-- Alert error --}}
      @if(session('error'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif

      {{-- Tabel --}}
      <div class="table-responsive mt-3">
        <table class="table table-hover align-middle text-nowrap">
          <thead class="table-primary">
            <tr>
              <th class="text-center" style="width: 50px;">#</th>
              <th>Nama</th>
              <th>Kota</th>
              <th>Tanggal</th>
              <th class="text-end">Jarak (km)</th>
              <th class="text-end">Uang Saku</th>
              <th class="text-center">Status</th>
            </tr>
          </thead>

          <tbody>
            @forelse($perdins as $perdin)
            <tr>
              <td class="text-center">{{ $loop->iteration }}</td>
              <td class="fw-medium">{{ $perdin->user->name }}</td>
              <td>
                <i class="bi bi-geo-alt text-primary me-1"></i>{{ $perdin->fromCity->name }}
                <span class="mx-1 text-muted">→</span>
                <i class="bi bi-flag-fill text-success me-1"></i>{{ $perdin->toCity->name }}
              </td>
              <td>
                {{ \Carbon\Carbon::parse($perdin->start_date)->translatedFormat('d M') }}
                -
                {{ \Carbon\Carbon::parse($perdin->end_date)->translatedFormat('d M Y') }}
                ({{ $perdin->duration_days }} hari)
              </td>
              <td class="text-end">{{ number_format($perdin->distance_km, 2) }}</td>
              <td class="text-end">Rp {{ number_format($perdin->total_allowance, 0, ',', '.') }}</td>
              <td class="text-center">
                <span class="badge rounded-pill bg-{{ $perdin->status == 'approved' ? 'success' : ($perdin->status == 'rejected' ? 'danger' : 'warning') }} px-3 py-2">
                  {{ ucfirst($perdin->status) }}
                </span>
              </td>

            </tr>
            @empty
            <tr>
              <td colspan="8" class="text-center text-muted py-4">
                <i class="bi bi-info-circle me-2"></i> Belum ada pengajuan perjalanan dinas.
              </td>
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