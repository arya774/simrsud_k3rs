@extends('layouts.dashboard.master')

@section('title', 'Tambah Inspeksi')

@section('content')

<style>

    body{
        background:#f8fafc;
    }

    .inspection-card{
        border:none;
        border-radius:26px;
        overflow:hidden;
        background:#fff;
        box-shadow:0 5px 30px rgba(0,0,0,.05);
    }

    .inspection-header{
        background:linear-gradient(135deg,#0d6efd,#5b8cff);
        padding:35px;
        color:white;
    }

    .inspection-header h4{
        margin:0;
        font-weight:800;
        font-size:28px;
    }

    .inspection-header p{
        margin-top:8px;
        opacity:.9;
    }

    .section-title{
        font-size:22px;
        font-weight:800;
        color:#1e293b;
        margin-bottom:25px;
    }

    .form-label{
        font-weight:700;
        margin-bottom:10px;
        color:#334155;
    }

    .form-control{
        border-radius:14px;
        border:1px solid #dbe2ea;
        min-height:48px;
        padding:12px 14px;
    }

    .form-control:focus{
        border-color:#0d6efd;
        box-shadow:0 0 0 .15rem rgba(13,110,253,.15);
    }

    .kategori-card{
        border:none;
        border-radius:24px;
        overflow:hidden;
        background:#fff;
        margin-bottom:35px;
        box-shadow:0 5px 20px rgba(0,0,0,.05);
        border:1px solid #eef2f7;
    }

    .kategori-header{
        background:linear-gradient(135deg,#eff6ff,#dbeafe);
        padding:22px 25px;
        border-bottom:1px solid #dbeafe;
    }

    .kategori-header h5{
        margin:0;
        font-size:19px;
        font-weight:800;
        color:#1d4ed8;
        letter-spacing:.5px;
    }

    .kategori-body{
        padding:25px;
    }

    .table{
        margin-bottom:0;
    }

    .table thead th{
        background:#f8fafc;
        border:1px solid #e2e8f0;
        padding:15px;
        font-weight:700;
        color:#334155;
        vertical-align:middle;
    }

    .table tbody td{
        border:1px solid #e2e8f0;
        padding:15px;
        vertical-align:middle;
    }

    .table tbody tr:hover{
        background:#fafcff;
    }

    .uraian-badge{
        display:inline-block;
        background:#eff6ff;
        color:#1d4ed8;
        padding:7px 14px;
        border-radius:12px;
        font-size:12px;
        font-weight:700;
    }

    .sub-uraian{
        font-weight:600;
        color:#0f172a;
        line-height:1.6;
    }

    /*
    |--------------------------------------------------------------------------
    | CATATAN DI DALAM CARD
    |--------------------------------------------------------------------------
    */
    .catatan-wrapper{
        margin-top:22px;
        background:#f8fafc;
        border:1px solid #e2e8f0;
        border-radius:20px;
        padding:22px;
    }

    .catatan-wrapper h6{
        font-size:16px;
        font-weight:800;
        color:#1e293b;
        margin-bottom:15px;
    }

    .catatan-textarea{
        width:100%;
        border-radius:16px;
        border:1px solid #dbe2ea;
        min-height:110px;
        padding:15px;
        resize:none;
        background:white;
    }

    .catatan-textarea:focus{
        outline:none;
        border-color:#0d6efd;
        box-shadow:0 0 0 .15rem rgba(13,110,253,.15);
    }

    .btn-save{
        border:none;
        border-radius:16px;
        padding:14px 32px;
        font-weight:700;
        font-size:15px;
        background:linear-gradient(135deg,#0d6efd,#2563eb);
        transition:.3s ease;
    }

    .btn-save:hover{
        transform:translateY(-2px);
        box-shadow:0 10px 25px rgba(37,99,235,.25);
    }

    .alert{
        border-radius:18px;
    }

    @media(max-width:768px){

        .inspection-header{
            padding:25px;
        }

        .inspection-header h4{
            font-size:22px;
        }

        .kategori-body{
            padding:18px;
        }

        .table thead th,
        .table tbody td{
            padding:10px;
            font-size:13px;
        }

    }

</style>

<div class="container-fluid">

    {{-- ERROR --}}
    @if ($errors->any())

        <div class="alert alert-danger">

            <strong>Terjadi kesalahan:</strong>

            <ul class="mb-0 mt-2">

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

        {{-- FORM UTAMA --}}
        <div class="card inspection-card mb-4">

            <div class="inspection-header">

                <h4>Form Tambah Inspeksi</h4>

                <p>
                    Silahkan isi data inspeksi dan checklist pemeriksaan
                </p>

            </div>

            <div class="card-body p-4">

                <div class="row">

                    <div class="col-md-4 mb-3">

                        <label class="form-label">
                            Tanggal *
                        </label>

                        <input type="date"
                               name="tanggal"
                               class="form-control"
                               value="{{ old('tanggal') }}"
                               required>

                    </div>

                    <div class="col-md-4 mb-3">

                        <label class="form-label">
                            Ruangan *
                        </label>

                        <select name="ruangan_id"
                                class="form-control"
                                required>

                            <option value="">
                                -- Pilih Ruangan --
                            </option>

                            @foreach($ruangan as $r)

                                <option value="{{ $r->id }}"
                                    {{ old('ruangan_id') == $r->id ? 'selected' : '' }}>

                                    {{ $r->nama_ruangan }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="col-md-4 mb-3">

                        <label class="form-label">
                            Catatan Umum
                        </label>

                        <input type="text"
                               name="keterangan"
                               class="form-control"
                               value="{{ old('keterangan') }}"
                               placeholder="Masukkan catatan umum inspeksi">

                    </div>

                </div>

                <div class="row mt-2">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Petugas K3RS
                        </label>

                        <input type="text"
                               name="nama_petugas_k3rs"
                               class="form-control"
                               value="{{ old('nama_petugas_k3rs') }}">

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Petugas Ruangan
                        </label>

                        <input type="text"
                               name="nama_petugas_ruangan"
                               class="form-control"
                               value="{{ old('nama_petugas_ruangan') }}">

                    </div>

                </div>

            </div>

        </div>

        {{-- CHECKLIST --}}
        <div class="card inspection-card mb-4">

            <div class="card-body p-4">

                <div class="section-title">
                    Checklist Inspeksi
                </div>

                @php
                    $no = 1;
                @endphp

                @foreach($kategoris as $kat)

                    <div class="kategori-card">

                        {{-- HEADER --}}
                        <div class="kategori-header">

                            <h5>
                                {{ strtoupper($kat->nama_kategori) }}
                            </h5>

                        </div>

                        {{-- BODY --}}
                        <div class="kategori-body">

                            {{-- TABLE --}}
                            <div class="table-responsive">

                                <table class="table align-middle">

                                    <thead>

                                        <tr>

                                            <th width="5%">
                                                No
                                            </th>

                                            <th width="25%">
                                                Uraian
                                            </th>

                                            <th>
                                                Sub Uraian
                                            </th>

                                            <th width="18%">
                                                Jawaban
                                            </th>

                                        </tr>

                                    </thead>

                                    <tbody>

                                        @foreach($kat->subUraians as $item)

                                            <tr>

                                                <td>
                                                    {{ $no++ }}
                                                </td>

                                                <td>

                                                    <span class="uraian-badge">
                                                        {{ $item->uraian->nama_uraian ?? '-' }}
                                                    </span>

                                                </td>

                                                <td>

                                                    <div class="sub-uraian">
                                                        {{ $item->nama_sub_uraian }}
                                                    </div>

                                                </td>

                                                <td>

                                                    <select
                                                        name="jawaban[{{ $item->id }}]"
                                                        class="form-control">

                                                        <option value="">
                                                            -- Pilih --
                                                        </option>

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

                            {{-- CATATAN WAJIB DI DALAM kategori-body --}}
                            <div class="catatan-wrapper">

                                <h6>
                                    Catatan {{ $kat->nama_kategori }}
                                </h6>

                                <textarea
                                    name="catatan_kategori[{{ $kat->id }}]"
                                    class="catatan-textarea"
                                    placeholder="Masukkan catatan khusus kategori {{ $kat->nama_kategori }}">{{ old('catatan_kategori.' . $kat->id) }}</textarea>

                            </div>

                        </div> {{-- END kategori-body --}}

                    </div> {{-- END kategori-card --}}

                @endforeach

            </div>

        </div>

        <button type="submit" class="btn btn-primary btn-save">

            Simpan Inspeksi

        </button>

    </form>

</div>

@endsection