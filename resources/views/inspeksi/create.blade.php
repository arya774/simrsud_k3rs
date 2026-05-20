@extends('layouts.dashboard.master')

@section('title', 'Tambah Inspeksi')

@section('content')

<div class="container-fluid">

    {{-- ERROR --}}
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

    {{-- SUCCESS --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('inspeksi.store') }}" method="POST">
        @csrf

        {{-- ================= FORM UTAMA ================= --}}
        <div class="card mb-4">
            <div class="card-body">

                <h4 class="mb-4">Form Tambah Inspeksi</h4>

                <div class="row">

                    <div class="col-md-4 mb-3">
                        <label>Tanggal *</label>
                        <input type="date"
                               name="tanggal"
                               class="form-control"
                               value="{{ old('tanggal') }}"
                               required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Ruangan *</label>
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

                    {{-- ❌ KATEGORI DIHAPUS --}}
                    
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

        {{-- ================= CHECKLIST ================= --}}
        <div class="card mb-4">
            <div class="card-body">

                <h5 class="mb-3">Checklist Inspeksi</h5>

                @php $no = 1; @endphp

                {{-- 🔥 LOOP PER KATEGORI --}}
                @foreach($kategoris as $kat)
                    
                    <h5 class="mt-4 text-primary">
                        {{ strtoupper($kat->nama_kategori) }}
                    </h5>

                    <div class="table-responsive mb-4">
                        <table class="table table-bordered">

                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Uraian</th>
                                    <th>Sub Uraian</th>
                                    <th width="20%">Jawaban</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($kat->subUraians as $item)
                                <tr>
                                    <td>{{ $no++ }}</td>

                                    <td>
                                        {{ $item->uraian->nama_uraian ?? '-' }}
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

                @endforeach

            </div>
        </div>

        <button type="submit" class="btn btn-primary px-4">
            Simpan Inspeksi
        </button>

    </form>

</div>

@endsection