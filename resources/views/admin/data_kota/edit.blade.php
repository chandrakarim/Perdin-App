@extends('admin.layouts.master')

@section('menu')
@include('admin.layouts.menu')
@endsection

@section('navbar')
@include('admin.layouts.navbar')
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

  <!-- Header -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">
      <i class="bx bx-map-pin me-2"></i> Edit Data Kota
    </h4>
    <a href="{{ route('admin.data_kota') }}" class="btn btn-outline-secondary btn-sm">
      <i class="bx bx-arrow-back"></i> Kembali
    </a>
  </div>

  <!-- Card Form -->
  <div class="row justify-content-start">
    <div class="col-md-8 col-lg-6">
      <div class="card border-0 shadow-sm">
        <div class="card-header bg-primary text-white py-2 d-flex justify-content-between align-items-center">
          <h6 class="mb-0"><i class="bx bx-edit me-1"></i> Form Edit Kota</h6>
          <small class="text-white-50">Data wilayah & koordinat</small>
        </div>

        <div class="card-body p-4">
          {{-- Notifikasi sukses --}}
          @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <i class="bx bx-check-circle me-1"></i> {{ session('success') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
          @endif

          <form action="{{ route('admin.update', $city->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Nama Kota --}}
            <div class="mb-3">
              <label class="form-label fw-semibold">Nama Kota</label>
              <div class="input-group input-group-merge">
                <span class="input-group-text"><i class="bx bx-building-house"></i></span>
                <input
                  type="text"
                  name="name"
                  value="{{ old('name', $city->name) }}"
                  class="form-control"
                  placeholder="Contoh: Jayapura"
                  required>
              </div>
            </div>

            {{-- Provinsi --}}
            <div class="mb-3">
              <label class="form-label fw-semibold">Provinsi</label>
              <div class="input-group input-group-merge">
                <span class="input-group-text"><i class="bx bx-map"></i></span>
                <input
                  type="text"
                  name="province"
                  value="{{ old('province', $city->province) }}"
                  class="form-control"
                  placeholder="Contoh: Papua"
                  required>
              </div>
            </div>

            {{-- Pulau --}}
            <div class="mb-3">
              <label class="form-label fw-semibold">Pulau</label>
              <div class="input-group input-group-merge">
                <span class="input-group-text"><i class="bx bx-globe"></i></span>
                <input
                  type="text"
                  name="island"
                  value="{{ old('island', $city->island) }}"
                  class="form-control"
                  placeholder="Contoh: Papua"
                  required>
              </div>
            </div>

            {{-- Luar Negeri --}}
            <div class="mb-3">
              <label class="form-label fw-semibold">Luar Negeri</label>
              <div class="input-group input-group-merge">
                <span class="input-group-text"><i class="bx bx-flag"></i></span>
                <select name="is_foreign" class="form-select" required>
                  <option value="tidak" {{ old('is_foreign', $city->is_foreign) == 'tidak' ? 'selected' : '' }}>Tidak</option>
                  <option value="ya" {{ old('is_foreign', $city->is_foreign) == 'ya' ? 'selected' : '' }}>Ya</option>
                </select>
              </div>
            </div>

            {{-- Latitude --}}
            <div class="mb-3">
              <label class="form-label fw-semibold">Latitude</label>
              <div class="input-group input-group-merge">
                <span class="input-group-text"><i class="bx bx-compass"></i></span>
                <input
                  type="number"
                  step="any"
                  name="latitude"
                  value="{{ old('latitude', $city->latitude) }}"
                  class="form-control"
                  placeholder="-2.5337"
                  required>
              </div>
            </div>

            {{-- Longitude --}}
            <div class="mb-4">
              <label class="form-label fw-semibold">Longitude</label>
              <div class="input-group input-group-merge">
                <span class="input-group-text"><i class="bx bx-compass"></i></span>
                <input
                  type="number"
                  step="any"
                  name="longitude"
                  value="{{ old('longitude', $city->longitude) }}"
                  class="form-control"
                  placeholder="140.7181"
                  required>
              </div>
            </div>

            <button type="submit" class="btn btn-primary w-100">
              <i class="bx bx-save me-1"></i> Update Data Kota
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('footer')
@include('admin.layouts.footer')
@endsection
