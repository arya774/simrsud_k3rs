@extends('layouts.dashboard.master')

@section('title', 'Tambah Sub Uraian')

@section('breadcrumb-title')

<h3 class="fw-bold">
    Tambah Sub Uraian
</h3>

@endsection

@section('breadcrumb-items')

<li class="breadcrumb-item">
    Master Data
</li>

<li class="breadcrumb-item">
    <a href="{{ route('master-data.sub-uraian.index') }}">
        Sub Uraian
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

            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

                {{-- HEADER --}}

                <div class="card-header bg-primary border-0 p-4">

                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                        <div class="text-white">

                            <h3 class="fw-bold mb-1">

                                Tambah Sub Uraian

                            </h3>

                            <span>

                                Tambahkan detail sub uraian inspeksi rumah sakit

                            </span>

                        </div>

                        <a href="{{ route('master-data.sub-uraian.index') }}"
                           class="btn btn-light rounded-3 px-4 py-2 fw-semibold">

                            <i data-feather="arrow-left"></i>

                            Kembali

                        </a>

                    </div>

                </div>

                {{-- BODY --}}

                <div class="card-body p-4 p-lg-5">

                    {{-- ERROR VALIDATION --}}

                    @if($errors->any())

                        <div class="alert alert-danger border-0 rounded-3 shadow-sm">

                            <div class="fw-bold mb-2">

                                Terjadi kesalahan:

                            </div>

                            <ul class="mb-0 ps-3">

                                @foreach($errors->all() as $error)

                                    <li>{{ $error }}</li>

                                @endforeach

                            </ul>

                        </div>

                    @endif

                    {{-- FORM --}}

                    <form action="{{ route('master-data.sub-uraian.store') }}"
                          method="POST">

                        @csrf

                        {{-- PILIH URAIAN --}}

                        <div class="mb-4">

                            <label class="form-label fw-semibold">

                                Pilih Uraian

                            </label>

                            <select name="uraian_id"
                                    class="form-select form-select-lg rounded-3 @error('uraian_id') is-invalid @enderror">

                                <option value="">
                                    -- Pilih Uraian --
                                </option>

                                @foreach($uraian as $u)

                                    <option value="{{ $u->id }}"
                                        {{ old('uraian_id') == $u->id ? 'selected' : '' }}>

                                        {{ $u->nama_uraian }}
                                        -
                                        {{ $u->kategori->nama_kategori ?? '-' }}

                                    </option>

                                @endforeach

                            </select>

                            @error('uraian_id')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>

                        {{-- NAMA SUB URAIAN --}}

                        <div class="mb-4">

                            <label class="form-label fw-semibold">

                                Nama Sub Uraian

                            </label>

                            <input type="text"
                                   name="nama_sub_uraian"
                                   class="form-control form-control-lg rounded-3 @error('nama_sub_uraian') is-invalid @enderror"
                                   placeholder="Contoh : Dinding Bersih dan Tidak Retak"
                                   value="{{ old('nama_sub_uraian') }}">

                            @error('nama_sub_uraian')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>

                        {{-- BUTTON --}}

                        <div class="d-flex flex-wrap gap-2">

                            <button type="submit"
                                    class="btn btn-primary rounded-3 px-4 py-2 fw-semibold">

                                <i data-feather="save"></i>

                                Simpan Data

                            </button>

                            <a href="{{ route('master-data.sub-uraian.index') }}"
                               class="btn btn-light rounded-3 px-4 py-2 fw-semibold border">

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