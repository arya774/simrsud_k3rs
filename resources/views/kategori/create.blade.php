@extends('layouts.dashboard.master')

@section('title', 'Tambah Kategori')

@section('breadcrumb-title')

<h3>Tambah Kategori</h3>

@endsection

@section('breadcrumb-items')

<li class="breadcrumb-item">
    Master Data
</li>

<li class="breadcrumb-item">

    <a href="{{ route('master-data.kategori.index') }}">

        Kategori

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

                <!-- HEADER -->
                <div class="card-header bg-primary border-0 p-4">

                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                        <div class="text-white">

                            <h3 class="fw-bold mb-1">

                                Tambah Kategori Inspeksi

                            </h3>

                            <span>

                                Tambahkan kategori baru untuk kebutuhan inspeksi rumah sakit

                            </span>

                        </div>

                        <!-- FIX ROUTE -->
                        <a href="{{ route('master-data.kategori.index') }}"
                           class="btn btn-light rounded-3 px-4 py-2 fw-semibold">

                            <i data-feather="arrow-left"></i>

                            Kembali

                        </a>

                    </div>

                </div>

                <!-- BODY -->
                <div class="card-body p-4">

                    <!-- ERROR VALIDATION -->
                    @if ($errors->any())

                        <div class="alert alert-danger border-0 shadow-sm rounded-3">

                            <div class="fw-semibold mb-2">

                                Terjadi kesalahan:

                            </div>

                            <ul class="mb-0 ps-3">

                                @foreach ($errors->all() as $error)

                                    <li>{{ $error }}</li>

                                @endforeach

                            </ul>

                        </div>

                    @endif

                    <!-- FORM -->
                    <form action="{{ route('master-data.kategori.store') }}"
                          method="POST">

                        @csrf

                        <div class="mb-4">

                            <label class="form-label fw-semibold">

                                Nama Kategori

                            </label>

                            <input type="text"
                                   name="nama_kategori"
                                   class="form-control form-control-lg rounded-3 @error('nama_kategori') is-invalid @enderror"
                                   placeholder="Contoh : Kondisi Fisik Bangunan"
                                   value="{{ old('nama_kategori') }}"
                                   autocomplete="off">

                            @error('nama_kategori')

                                <div class="invalid-feedback">

                                    {{ $message }}

                                </div>

                            @enderror

                        </div>

                        <!-- BUTTON -->
                        <div class="d-flex flex-wrap gap-2">

                            <button type="submit"
                                    class="btn btn-primary rounded-3 px-4 py-2 fw-semibold">

                                <i data-feather="save"></i>

                                Simpan

                            </button>

                            <a href="{{ route('master-data.kategori.index') }}"
                               class="btn btn-light border rounded-3 px-4 py-2 fw-semibold">

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