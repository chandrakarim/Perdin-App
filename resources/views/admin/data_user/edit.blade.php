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
      <i class="bx bx-user-circle me-2"></i> Edit Data User
    </h4>
    <a href="{{ route('admin.data_user') }}" class="btn btn-outline-secondary btn-sm">
      <i class="bx bx-arrow-back"></i> Kembali
    </a>
  </div>

  <!-- Card -->
  <div class="row justify-content-start">
    <div class="col-md-8 col-lg-6">
      <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white py-2">
          <h6 class="mb-0"><i class="bx bx-edit me-1"></i> Formulir Edit User</h6>
        </div>

        <div class="card-body p-4">
          {{-- Alert sukses --}}
          @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
              <i class="bx bx-check-circle me-1"></i> {{ session('success') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
          @endif

          <form action="{{ route('admin.user.update', $data->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Nama --}}
            <div class="mb-3">
              <label class="form-label fw-semibold">Nama</label>
              <div class="input-group input-group-merge">
                <span class="input-group-text"><i class="bx bx-user"></i></span>
                <input
                  type="text"
                  name="name"
                  value="{{ old('name', $data->name) }}"
                  class="form-control"
                  placeholder="John Doe"
                  required>
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
                  value="{{ old('email', $data->email) }}"
                  class="form-control"
                  placeholder="john.doe@example.com"
                  required>
              </div>
              <div class="form-text">Gunakan format email yang valid.</div>
            </div>

            {{-- Nomor Telepon --}}
            <div class="mb-3">
              <label class="form-label fw-semibold">Nomor Telepon</label>
              <div class="input-group input-group-merge">
                <span class="input-group-text"><i class="bx bx-phone"></i></span>
                <input
                  type="text"
                  name="no_tlp"
                  value="{{ old('no_tlp', $data->no_tlp) }}"
                  class="form-control"
                  placeholder="0812 3456 7890">
              </div>
            </div>

            {{-- Jenis Kelamin --}}
            <div class="mb-3">
              <label class="form-label fw-semibold">Jenis Kelamin</label>
              <div class="input-group input-group-merge">
                <span class="input-group-text"><i class="bx bx-male-female"></i></span>
                <select name="jk" class="form-select" required>
                  <option value="">-- Pilih Jenis Kelamin --</option>
                  <option value="Laki-laki" {{ old('jk', $data->jk) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                  <option value="Perempuan" {{ old('jk', $data->jk) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
              </div>
            </div>

            {{-- Role --}}
            <div class="mb-3">
              <label class="form-label fw-semibold">Role</label>
              <div class="input-group input-group-merge">
                <span class="input-group-text"><i class="bx bx-user-pin"></i></span>
                <select name="role" class="form-select" required>
                  <option value="">-- Pilih Role --</option>
                  <option value="admin" {{ old('role', $data->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                  <option value="pegawai" {{ old('role', $data->role) == 'pegawai' ? 'selected' : '' }}>Pegawai</option>
                  <option value="sdm" {{ old('role', $data->role) == 'sdm' ? 'selected' : '' }}>SDM</option>
                </select>
              </div>
            </div>

            {{-- Password --}}
            <div class="mb-4">
              <label class="form-label fw-semibold">Password (opsional)</label>
              <div class="input-group input-group-merge">
                <span class="input-group-text"><i class="bx bx-lock"></i></span>
                <input
                  type="password"
                  name="password"
                  class="form-control"
                  placeholder="••••••••">
              </div>
              <div class="form-text">Kosongkan jika tidak ingin mengubah password.</div>
            </div>

            <button type="submit" class="btn btn-primary w-100">
              <i class="bx bx-save me-1"></i> Simpan Perubahan
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