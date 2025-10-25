@extends('admin.layouts.master')

@section('menu')
@include('admin.layouts.menu')
@endsection

@section('navbar')
@include('admin.layouts.navbar')
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

  {{-- Header --}}
  <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">
      <span class="text-muted fw-light">Kota Management /</span> Tambah Data Kota
    </h4>
  </div>

  {{-- Form Tambah Kota --}}
  <div class="row justify-content-start">
    <div class="col-md-8 col-lg-6">
      <div class="card shadow-sm mb-4">

        {{-- Card Header --}}
        <div class="card-header d-flex justify-content-between align-items-center py-2">
          <h6 class="mb-0">Form Input Kota</h6>
          <small class="text-muted">Data wilayah dan koordinat</small>
        </div>

        {{-- Alert Success --}}
        @if(session('success'))
          <div class="alert alert-success m-3" role="alert">
            {{ session('success') }}
          </div>
        @endif

        {{-- Card Body --}}
        <div class="card-body p-3">
          <form action="{{ route('admin.store') }}" method="POST">
            @csrf

            {{-- Nama Kota --}}
            <div class="mb-3">
              <label for="basic-icon-default-city" class="form-label">Nama Kota</label>
              <div class="input-group input-group-merge">
                <span class="input-group-text" id="basic-icon-default-city2">
                  <i class="bx bx-building-house"></i>
                </span>
                <input
                  type="text"
                  id="basic-icon-default-city"
                  name="name"
                  class="form-control"
                  value="{{ old('name') }}"
                  placeholder="Contoh: Yogyakarta"
                  aria-label="Nama Kota"
                  aria-describedby="basic-icon-default-city2"
                  required
                >
              </div>
            </div>

            {{-- Provinsi --}}
            <div class="mb-3">
              <label for="basic-icon-default-province" class="form-label">Provinsi</label>
              <div class="input-group input-group-merge">
                <span class="input-group-text" id="basic-icon-default-province2">
                  <i class="bx bx-map"></i>
                </span>
                <input
                  type="text"
                  id="basic-icon-default-province"
                  name="province"
                  class="form-control"
                  value="{{ old('province') }}"
                  placeholder="Contoh: DI Yogyakarta"
                  aria-label="Provinsi"
                  aria-describedby="basic-icon-default-province2"
                  required
                >
              </div>
            </div>

            {{-- Pulau --}}
            <div class="mb-3">
              <label for="basic-icon-default-island" class="form-label">Pulau</label>
              <div class="input-group input-group-merge">
                <span class="input-group-text" id="basic-icon-default-island2">
                  <i class="bx bx-globe"></i>
                </span>
                <input
                  type="text"
                  id="basic-icon-default-island"
                  name="island"
                  class="form-control"
                  value="{{ old('island') }}"
                  placeholder="Contoh: Jawa"
                  aria-label="Pulau"
                  aria-describedby="basic-icon-default-island2"
                  required
                >
              </div>
            </div>

            {{-- Luar Negeri --}}
            <div class="mb-3">
              <label for="basic-icon-default-foreign" class="form-label">Luar Negeri</label>
              <div class="input-group input-group-merge">
                <span class="input-group-text" id="basic-icon-default-foreign2">
                  <i class="bx bx-flag"></i>
                </span>
                <select
                  id="basic-icon-default-foreign"
                  name="is_foreign"
                  class="form-select"
                  aria-label="Luar Negeri"
                  aria-describedby="basic-icon-default-foreign2"
                >
                  <option value="Tidak" {{ old('is_foreign') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                  <option value="Ya" {{ old('is_foreign') == 'Ya' ? 'selected' : '' }}>Ya</option>
                </select>
              </div>
            </div>

            {{-- Latitude --}}
            <div class="mb-3">
              <label for="basic-icon-default-latitude" class="form-label">Latitude</label>
              <div class="input-group input-group-merge">
                <span class="input-group-text" id="basic-icon-default-latitude2">
                  <i class="bx bx-navigation"></i>
                </span>
                <input
                  type="number"
                  step="any"
                  id="basic-icon-default-latitude"
                  name="latitude"
                  class="form-control"
                  value="{{ old('latitude') }}"
                  placeholder="-2.5337"
                  aria-label="Latitude"
                  aria-describedby="basic-icon-default-latitude2"
                  required
                >
              </div>
            </div>

            {{-- Longitude --}}
            <div class="mb-3">
              <label for="basic-icon-default-longitude" class="form-label">Longitude</label>
              <div class="input-group input-group-merge">
                <span class="input-group-text" id="basic-icon-default-longitude2">
                  <i class="bx bx-navigation"></i>
                </span>
                <input
                  type="number"
                  step="any"
                  id="basic-icon-default-longitude"
                  name="longitude"
                  class="form-control"
                  value="{{ old('longitude') }}"
                  placeholder="140.7181"
                  aria-label="Longitude"
                  aria-describedby="basic-icon-default-longitude2"
                  required
                >
              </div>
            </div>

            {{-- Tombol Submit --}}
            <button type="submit" class="btn btn-primary w-100">
              Simpan Data Kota
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
