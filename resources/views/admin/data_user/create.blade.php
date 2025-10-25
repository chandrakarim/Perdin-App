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
      <span class="text-muted fw-light">User Management /</span> Tambah Data User
    </h4>
  </div>

  {{-- Card Form --}}
  <div class="row justify-content-start">
    <div class="col-md-8 col-lg-6">
      <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white py-2 d-flex justify-content-between align-items-center">
          <h6 class="mb-0 fw-semibold">Form Tambah User</h6>
          
        </div>

        <div class="card-body p-4">

          {{-- Alert sukses --}}
          @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show small" role="alert">
              {{ session('success') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
          @endif

          {{-- Alert error --}}
          @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show small" role="alert">
              {{ session('error') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
          @endif

          <form action="{{ route('admin.user.store') }}" method="POST">
            @csrf

            {{-- Nama --}}
            <div class="mb-3">
              <label class="form-label fw-semibold">Nama Lengkap</label>
              <div class="input-group input-group-merge">
                <span class="input-group-text"><i class="bx bx-user"></i></span>
                <input
                  type="text"
                  name="name"
                  class="form-control"
                  value="{{ old('name') }}"
                  placeholder="John Doe"
                  required
                />
              </div>
            </div>

            {{-- Email --}}
            <div class="mb-3">
              <label class="form-label fw-semibold">Email</label>
              <div class="input-group input-group-merge">
                <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                <input
                  type="email"
                  name="email"
                  class="form-control"
                  value="{{ old('email') }}"
                  placeholder="john.doe@example.com"
                  required
                />
              </div>
              <small class="text-muted">Gunakan format email yang valid</small>
            </div>

            {{-- Nomor Telepon --}}
            <div class="mb-3">
              <label class="form-label fw-semibold">Nomor Telepon</label>
              <div class="input-group input-group-merge">
                <span class="input-group-text"><i class="bx bx-phone"></i></span>
                <input
                  type="text"
                  name="no_tlp"
                  class="form-control"
                  value="{{ old('no_tlp') }}"
                  placeholder="0812 3456 7890"
                />
              </div>
            </div>

            {{-- Jenis Kelamin --}}
            <div class="mb-3">
              <label class="form-label fw-semibold">Jenis Kelamin</label>
              <div class="input-group input-group-merge">
                <span class="input-group-text"><i class="bx bx-male-female"></i></span>
                <select
                  name="jk"
                  class="form-select"
                  required
                >
                  <option disabled selected>Pilih Jenis Kelamin</option>
                  <option value="Laki-laki" {{ old('jk') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                  <option value="Perempuan" {{ old('jk') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
              </div>
            </div>

            {{-- Role --}}
            <div class="mb-3">
              <label class="form-label fw-semibold">Role</label>
              <div class="input-group input-group-merge">
                <span class="input-group-text"><i class="bx bx-user-circle"></i></span>
                <select
                  name="role"
                  class="form-select"
                  required
                >
                  <option disabled selected>Pilih Role</option>
                  <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                  <option value="pegawai" {{ old('role') == 'pegawai' ? 'selected' : '' }}>Pegawai</option>
                  <option value="sdm" {{ old('role') == 'sdm' ? 'selected' : '' }}>SDM</option>
                </select>
              </div>
            </div>

            {{-- Password --}}
            <div class="mb-3">
              <label class="form-label fw-semibold">Password</label>
              <div class="input-group input-group-merge">
                <span class="input-group-text"><i class="bx bx-lock"></i></span>
                <input
                  type="password"
                  name="password"
                  class="form-control"
                  placeholder="••••••••"
                  required
                />
              </div>
              <small class="text-muted">Minimal 6 karakter</small>
            </div>

            {{-- Tombol Simpan --}}
            <button type="submit" class="btn btn-primary w-100 fw-semibold mt-3">
              <i class="bx bx-save"></i> Simpan Data
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