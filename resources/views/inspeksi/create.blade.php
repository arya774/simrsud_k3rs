@extends('layouts.dashboard.master')

@section('title', 'Tambah Inspeksi')

@section('content')

<div class="container-fluid">

    {{-- ERROR DISPLAY --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- SUCCESS (JIKA ADA) --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('inspeksi.store') }}" method="POST" id="form-inspeksi">
        @csrf

        <div class="card mb-4">
            <div class="card-body">

                <h4 class="mb-4">Form Tambah Inspeksi</h4>

                <div class="row">

                    <div class="col-md-4 mb-3">
                        <label>Tanggal <span class="text-danger">*</span></label>
                        <input type="date"
                               name="tanggal"
                               class="form-control"
                               value="{{ old('tanggal') }}"
                               required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Ruangan <span class="text-danger">*</span></label>
                        <select name="ruangan_id" class="form-control" required>
                            <option value="">-- Pilih Ruangan --</option>
                            @foreach($ruangan as $r)
                                <option value="{{ $r->id }}"
                                    {{ old('ruangan_id') == $r->id ? 'selected' : '' }}>
                                    {{ $r->nama_ruangan }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Kategori <span class="text-danger">*</span></label>
                        <select name="kategori_id" class="form-control" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($kategori as $k)
                                <option value="{{ $k->id }}"
                                    {{ old('kategori_id') == $k->id ? 'selected' : '' }}>
                                    {{ $k->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label>Catatan</label>
                        <input type="text"
                               name="keterangan"
                               class="form-control"
                               value="{{ old('keterangan') }}">
                    </div>

                </div>

                <div class="row mt-3">

                    <div class="col-md-6">
                        <label>Petugas K3RS</label>
                        <input type="text"
                               name="nama_petugas_k3rs"
                               class="form-control"
                               value="{{ old('nama_petugas_k3rs') }}">
                    </div>

                    <div class="col-md-6">
                        <label>Petugas Ruangan</label>
                        <input type="text"
                               name="nama_petugas_ruangan"
                               class="form-control"
                               value="{{ old('nama_petugas_ruangan') }}">
                    </div>

                </div>

            </div>
        </div>

        {{-- CHECKLIST --}}
        <div class="card mb-4">
            <div class="card-body">

                <h5 class="mb-3">Checklist Inspeksi</h5>

                <div class="table-responsive">
                    <table class="table table-bordered">

                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Uraian</th>
                                <th>Sub Uraian</th>
                                <th>Jawaban</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php $no = 1; @endphp

                            @foreach($subUraian as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->uraian->nama_uraian ?? '-' }}</td>
                                <td>{{ $item->nama_sub_uraian }}</td>
                                <td>
                                    <select name="jawaban[{{ $item->id }}]"
                                            class="form-control">
                                        <option value="">-- Pilih --</option>
                                        <option value="Baik"
                                            {{ old('jawaban.' . $item->id) == 'Baik' ? 'selected' : '' }}>
                                            Baik
                                        </option>
                                        <option value="Tidak Baik"
                                            {{ old('jawaban.' . $item->id) == 'Tidak Baik' ? 'selected' : '' }}>
                                            Tidak Baik
                                        </option>
                                    </select>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>

                    </table>
                </div>

            </div>
        </div>

        <button type="submit" class="btn btn-primary px-4">
            Simpan Inspeksi
        </button>

    </form>

</div>

@endsection