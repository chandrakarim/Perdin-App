@extends('pegawai.layouts.master')

@section('menu')
@include('pegawai.layouts.menu')
@endsection

@section('navbar')
@include('pegawai.layouts.navbar')
@endsection

@section('content')
<div class="container">
  <!-- <h1>Beranda</h1>
  <p>Ini isi konten halaman Data Pegawai</p> -->
</div>
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">
      <span class="text-muted fw-light">Tables /</span> Data Perdin
    </h4>
    <a href="{{ route('pegawai.perdin.create') }}" class="btn btn-primary mt-2 mt-sm-0">
      <i class="bx bx-plus"></i> Tambah Perdin
    </a>
  </div>

  <!-- Basic Bootstrap Table -->
  <div class="card">
    <h5 class="card-header">Daftar User</h5>
    <div class="table-responsive text-nowrap">
      <table class="table table-hover align-middle">
        <thead class="table-light">
          <tr>
            <th>#</th>
            <th>Kota</th>
            <th>Tanggal</th>
            <th>Keterangan</th>
            <th>Status</th>
            <!-- <th class="text-center">Actions</th> -->
          </tr>
        </thead>
        <tbody>
          @foreach ($perdins as $perdin)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $perdin->fromCity->name }} &rarr; {{ $perdin->toCity->name }}</td>
            <td>
              {{ \Carbon\Carbon::parse($perdin->start_date)->translatedFormat('d M') }}
              -
              {{ \Carbon\Carbon::parse($perdin->end_date)->translatedFormat('d M Y') }}
              ({{ $perdin->duration_days }} hari)
            </td>
            <td>
              @if($perdin->status == 'pending')
              {{ $perdin->purpose }}
              @else
              {{ $perdin->notes }}
              @endif
            </td>
            <td>
              <span class="badge bg-{{ $perdin->status == 'approved' ? 'success' : ($perdin->status == 'rejected' ? 'danger' : 'warning') }}">
                {{ ucfirst($perdin->status) }}
              </span>
            </td>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

<!--/ Basic Bootstrap Table -->
@endsection

@section('footer')
@include('pegawai.layouts.footer')
@endsection