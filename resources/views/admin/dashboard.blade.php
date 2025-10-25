@extends('admin.layouts.master')

@section('menu')
@include('admin.layouts.menu')
@endsection

@section('navbar')
@include('admin.layouts.navbar')
@endsection

@section('content')
<!-- <div class="container">
        <h1>Data User</h1>
        <p>Ini isi konten halaman Data User</p>
    </div> -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">
            <span class="text-muted fw-light">Tables /</span> Data Kota
        </h4>
        <a href="{{ route('admin.kota.create') }}" class="btn btn-primary mt-2 mt-sm-0">
            <i class="bx bx-plus"></i> Tambah Data Kota
        </a>
    </div>

    <!-- Basic Bootstrap Table -->
    <div class="card">
        <h5 class="card-header">Daftar Kota</h5>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Kota</th>
                        <th>Provinsi</th>
                        <th>Pulau</th>
                        <th>Luar negeri</th>
                        <th>Latitude</th>
                        <th>Logtude</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($data as $no => $k)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $k->name }}</td>
                        <td>{{ $k->province }}</td>
                        <td>{{ $k->island }}</td>
                        <td>{{ $k->is_foreign }}</td>
                        <td>{{ $k->latitude }}</td>
                        <td>{{ $k->longitude }}</td>
                        <td class="text-center d-flex justify-content-center gap-1">
                            {{-- Tombol Edit --}}
                            <a href="{{ route ('admin.edit', $k->id) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bx bx-edit"></i> Edit
                            </a>
                            {{-- Tombol Hapus --}}
                            <form action="{{ route('admin.user.delete', $k->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="bx bx-trash"></i> Hapus
                                </button>
                            </form>
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
@include('admin.layouts.footer')
@endsection