@extends('layouts.dashboard.master')

@section('title', 'Tambah Uraian')

@section('breadcrumb-title')

<h3>Tambah Uraian</h3>

@endsection

@section('breadcrumb-items')

<li class="breadcrumb-item">
    Master Data
</li>

<li class="breadcrumb-item">
    <a href="{{ route('master-data.uraian.index') }}">
        Uraian
    </a>
</li>

<li class="breadcrumb-item active">
    Tambah
</li>

@endsection

@section('content')

<div class="container-fluid">

    <div class="row justify-content-center">

        <div class="col-xl-8 col-lg-10">

            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

                <div class="card-header bg-primary border-0 p-4">

                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                        <div class="text-white">

                            <h3 class="fw-bold mb-1">

                                Tambah Uraian Inspeksi

                            </h3>

                            <span>

                                Tambahkan uraian baru untuk kebutuhan inspeksi rumah sakit

                            </span>

                        </div>

                        <a href="{{ route('master-data.uraian.index') }}"
                           class="btn btn-light rounded-3 px-4 py-2 fw-semibold">

                            <i data-feather="arrow-left"></i>

                            Kembali

                        </a>

                    </div>

                </div>

                <div class="card-body p-4">

                    @if ($errors->any())

                        <div class="alert alert-danger rounded-3 border-0 shadow-sm">

                            <ul class="mb-0">

                                @foreach ($errors->all() as $error)

                                    <li>{{ $error }}</li>

                                @endforeach

                            </ul>

                        </div>

                    @endif

                    <form action="{{ route('master-data.uraian.store') }}"
                          method="POST">

                        @csrf

                        <div class="mb-4">

                            <label class="form-label fw-semibold">

                                Pilih Kategori

                            </label>

                            <select name="kategori_id"
                                    class="form-select form-select-lg rounded-3">

                                <option value="">
                                    -- Pilih Kategori --
                                </option>

                                @foreach($kategori as $item)

                                    <option value="{{ $item->id }}"
                                        {{ old('kategori_id') == $item->id ? 'selected' : '' }}>

                                        {{ $item->nama_kategori }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="mb-4">

                            <label class="form-label fw-semibold">

                                Nama Uraian

                            </label>

                            <input type="text"
                                   name="nama_uraian"
                                   class="form-control form-control-lg rounded-3"
                                   placeholder="Contoh : Kondisi Dinding"
                                   value="{{ old('nama_uraian') }}">

                        </div>

                        <div class="d-flex flex-wrap gap-2">

                            <button type="submit"
                                    class="btn btn-primary rounded-3 px-4 py-2 fw-semibold">

                                <i data-feather="save"></i>

                                Simpan

                            </button>

                            <a href="{{ route('master-data.uraian.index') }}"
                               class="btn btn-light rounded-3 px-4 py-2 fw-semibold">

                                Batal

                            </a>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection