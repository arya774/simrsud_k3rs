@extends('layouts.dashboard.master')

@section('title', 'Tambah Inspeksi')

@section('content')

<div class="container-fluid">

    {{-- ALERT --}}
    @include('components.alert')

    <form action="{{ route('inspeksi.store') }}" method="POST">
        @csrf

        {{-- =========================
        | FORM UTAMA
        ========================== --}}
        <div class="card shadow-sm border-0 mb-4 rounded-4">

            <div class="card-header bg-primary text-white rounded-top-4">
                <h5 class="mb-0 fw-bold">Form Tambah Inspeksi</h5>
                <small>Isi data inspeksi dengan lengkap</small>
            </div>

            <div class="card-body">

                <div class="row">

                    {{-- TANGGAL --}}
                    <div class="col-md-4 mb-3">
                        <label class="fw-semibold">Tanggal *</label>
                        <input type="date"
                               name="tanggal"
                               class="form-control @error('tanggal') is-invalid @enderror"
                               value="{{ old('tanggal') }}"
                               required>

                        @error('tanggal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- RUANGAN --}}
                    <div class="col-md-4 mb-3">
                        <label class="fw-semibold">Ruangan *</label>

                        <select name="ruangan_id"
                                class="form-control @error('ruangan_id') is-invalid @enderror"
                                required>

                            <option value="">-- Pilih --</option>

                            @foreach($ruangan as $r)
                                <option value="{{ $r->id }}"
                                    {{ old('ruangan_id') == $r->id ? 'selected' : '' }}>
                                    {{ $r->nama_ruangan }}
                                </option>
                            @endforeach

                        </select>

                        @error('ruangan_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- KETERANGAN --}}
                    <div class="col-md-4 mb-3">
                        <label class="fw-semibold">Catatan Umum</label>

                        <input type="text"
                               name="keterangan"
                               class="form-control"
                               value="{{ old('keterangan') }}"
                               placeholder="Catatan tambahan">
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="fw-semibold">Petugas K3RS</label>
                        <input type="text"
                               name="nama_petugas_k3rs"
                               class="form-control"
                               value="{{ old('nama_petugas_k3rs') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="fw-semibold">Petugas Ruangan</label>
                        <input type="text"
                               name="nama_petugas_ruangan"
                               class="form-control"
                               value="{{ old('nama_petugas_ruangan') }}">
                    </div>

                </div>

            </div>
        </div>

        {{-- =========================
        | CHECKLIST
        ========================== --}}
        <div class="card shadow-sm border-0 rounded-4 mb-4">

            <div class="card-body">

                <h5 class="fw-bold mb-4">Checklist Inspeksi</h5>

                @foreach($kategoris as $kat)

                    <div class="card mb-4 border-0 shadow-sm rounded-4">

                        {{-- HEADER --}}
                        <div class="card-header bg-light fw-bold text-primary">
                            {{ strtoupper($kat->nama_kategori) }}
                        </div>

                        {{-- BODY --}}
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-bordered align-middle">

                                    <thead class="table-light">
                                        <tr>
                                            <th width="5%">No</th>
                                            <th width="25%">Uraian</th>
                                            <th>Sub Uraian</th>
                                           <th width="15%">Jawaban</th>
                                        <th width="25%">Catatan</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        @foreach($kat->subUraians as $index => $item)

                                            <tr>
                                                <td>{{ $loop->iteration }}</td>

                                                <td>
                                                    <span class="badge bg-primary">
                                                        {{ $item->uraian->nama_uraian ?? '-' }}
                                                    </span>
                                                </td>

                                                <td>
                                                    {{ $item->nama_sub_uraian }}
                                                </td>

                                                <td>
                                                    <select name="jawaban[{{ $item->id }}]"
                                                            class="form-control">

                                                        <option value="">-- Pilih --</option>

                                                        <option value="Baik"
                                                            {{ old('jawaban.' . $item->id) == 'Baik' ? 'selected' : '' }}>
                                                            Baik
                                                        </option>

                                                        <option value="Tidak"
                                                            {{ old('jawaban.' . $item->id) == 'Tidak' ? 'selected' : '' }}>
                                                            Tidak
                                                        </option>

                                                    </select>
                                                </td>
                                            </tr>

                                        @endforeach

                                    </tbody>

                                </table>
                            </div>

                            {{-- CATATAN --}}
                            <div class="mt-3">
                                <label class="fw-semibold">
                                    Catatan {{ $kat->nama_kategori }}
                                </label>

                                <textarea
                                    name="catatan_kategori[{{ $kat->id }}]"
                                    class="form-control"
                                    rows="3"
                                    placeholder="Catatan khusus kategori...">{{ old('catatan_kategori.' . $kat->id) }}</textarea>
                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        </div>

        {{-- BUTTON --}}
        <button class="btn btn-primary px-4 py-2 rounded-3">
            💾 Simpan Inspeksi
        </button>

    </form>

</div>

@endsection