@extends('pegawai.layouts.master')

@section('menu')
@include('pegawai.layouts.menu')
@endsection

@section('navbar')
@include('pegawai.layouts.navbar')
@endsection

@section('content')

<div class="container-md py-4">
  <div class="card shadow-sm mx-auto" style="max-width: 700px;">
    <div class="card-header bg-primary text-white">
      <h5 class="mb-0 text-center">Form Pengajuan Perjalanan Dinas</h5>
    </div>

    <div class="card-body">
      <form action="{{ route('pegawai.perdin.store') }}" method="POST" id="perdinForm">
        @csrf

        {{-- Kota Asal & Tujuan --}}
        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold">Kota Asal</label>
            <select name="from_city_id" id="from_city_id" class="form-select" required>
              <option value="">-- Pilih Kota Asal --</option>
              @foreach($cities as $city)
              <option
                value="{{ $city->id }}"
                data-lat="{{ $city->latitude }}"
                data-lon="{{ $city->longitude }}"
                data-provinsi="{{ $city->province }}"
                data-pulau="{{ $city->island }}"
                data-foreign="{{ $city->is_foreign ? 'ya' : 'tidak' }}">
                {{ $city->name }} ({{ $city->province }})
              </option>
              @endforeach
            </select>
          </div>

          <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold">Kota Tujuan</label>
            <select name="to_city_id" id="to_city_id" class="form-select" required>
              <option value="">-- Pilih Kota Tujuan --</option>
              @foreach($cities as $city)
              <option
                value="{{ $city->id }}"
                data-lat="{{ $city->latitude }}"
                data-lon="{{ $city->longitude }}"
                data-provinsi="{{ $city->province }}"
                data-pulau="{{ $city->island }}"
                data-foreign="{{ $city->is_foreign ? 'ya' : 'tidak' }}">
                {{ $city->name }} ({{ $city->province }})
              </option>
              @endforeach
            </select>
          </div>
        </div>

        {{-- Tanggal --}}
        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold">Tanggal Berangkat</label>
            <input type="date" name="start_date" id="start_date" class="form-control" required>
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold">Tanggal Pulang</label>
            <input type="date" name="end_date" id="end_date" class="form-control" required>
          </div>
        </div>

        {{-- Maksud Perjalanan --}}
        <div class="mb-3">
          <label class="form-label fw-semibold">Maksud / Tujuan Perdin</label>
          <textarea name="purpose" class="form-control" rows="3" required></textarea>
        </div>

        {{-- BOX TOTAL PERJALANAN --}}
        <div class="row mt-4 justify-content-center">
          <div class="col-12 col-md-6">
            <div class="card bg-light border-0 shadow-sm text-center py-3 h-100">
              <h6 class="fw-bold text-primary mb-1">Total Perjalanan Dinas</h6>
              <p class="mb-0 fs-6" id="total_days">0 hari</p>
            </div>
          </div>
        </div>

        {{-- Tombol Submit --}}
        <div class="text-end mt-4 d-flex justify-content-end gap-2">
          <a href="{{ route('pegawai.dashboard') }}" class="btn btn-outline-secondary">
            <i class="bx bx-arrow-back"></i> Kembali
          </a>
          <button type="submit" class="btn btn-primary">
            <i class="bx bx-send"></i> Tambah
          </button>
        </div>

      </form>
    </div>
  </div>
</div>

{{-- Script perhitungan total hari, jarak, dan estimasi biaya --}}
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const start = document.getElementById('start_date');
    const end = document.getElementById('end_date');
    const fromCity = document.getElementById('from_city_id');
    const toCity = document.getElementById('to_city_id');
    const totalDays = document.getElementById('total_days');
    const totalDistance = document.getElementById('total_distance');
    const totalAmount = document.getElementById('total_amount');

    function hitungJarak(lat1, lon1, lat2, lon2) {
      const R = 6371; // Radius bumi (km)
      const dLat = (lat2 - lat1) * Math.PI / 180;
      const dLon = (lon2 - lon1) * Math.PI / 180;
      const a =
        Math.sin(dLat / 2) * Math.sin(dLat / 2) +
        Math.cos(lat1 * Math.PI / 180) *
        Math.cos(lat2 * Math.PI / 180) *
        Math.sin(dLon / 2) * Math.sin(dLon / 2);
      const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
      return Math.round(R * c); // hasil km
    }

    function hitungPerjalanan() {
      // pastikan semua input ada
      if (!start.value || !end.value || !fromCity.value || !toCity.value) return;

      const startDate = new Date(start.value);
      const endDate = new Date(end.value);
      const diffDays = Math.floor((endDate - startDate) / (1000 * 60 * 60 * 24)) + 1;
      if (diffDays <= 0) return;

      // ambil data kota asal & tujuan
      const asal = fromCity.selectedOptions[0];
      const tujuan = toCity.selectedOptions[0];

      const lat1 = parseFloat(asal.dataset.lat);
      const lon1 = parseFloat(asal.dataset.lon);
      const lat2 = parseFloat(tujuan.dataset.lat);
      const lon2 = parseFloat(tujuan.dataset.lon);

      const provAsal = asal.dataset.provinsi;
      const provTujuan = tujuan.dataset.provinsi;
      const pulauAsal = asal.dataset.pulau;
      const pulauTujuan = tujuan.dataset.pulau;
      const foreign = tujuan.dataset.foreign === 'tidak';

      // hitung jarak antar kota
      const jarak = hitungJarak(lat1, lon1, lat2, lon2);
      let uangSakuPerHari = 0;
      let currency = 'Rp';

      // logika sesuai klasifikasi
      if (foreign) {
        uangSakuPerHari = 50;
        currency = 'USD';
      } else if (jarak <= 60) {
        uangSakuPerHari = 0;
      } else if (provAsal === provTujuan) {
        uangSakuPerHari = 200000;
      } else if (pulauAsal === pulauTujuan) {
        uangSakuPerHari = 250000;
      } else {
        uangSakuPerHari = 300000;
      }

      // tampilkan hasil
      totalDays.textContent = `${diffDays} hari`;
      totalDistance.textContent = `${jarak.toLocaleString('id-ID')} km`;
      totalAmount.textContent =
        currency === 'USD' ?
        `USD ${(diffDays * uangSakuPerHari).toLocaleString('en-US')}` :
        `Rp ${(diffDays * uangSakuPerHari).toLocaleString('id-ID')}`;
    }

    start.addEventListener('change', hitungPerjalanan);
    end.addEventListener('change', hitungPerjalanan);
    fromCity.addEventListener('change', hitungPerjalanan);
    toCity.addEventListener('change', hitungPerjalanan);
  });
</script>


@endsection

@section('footer')
@include('pegawai.layouts.footer')
@endsection