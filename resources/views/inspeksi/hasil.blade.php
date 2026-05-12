@extends('layouts.dashboard.master')

@section('title', 'Hasil Inspeksi')

@section('breadcrumb-title')
<h3>Hasil Inspeksi</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Inspeksi</li>
<li class="breadcrumb-item active">Hasil</li>
@endsection

@section('content')

<div class="container-fluid">

    <div class="row justify-content-center">

        <div class="col-xl-12">

            <div class="card hasil-card">

                <div class="hasil-header">

                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                        <div>
                            <h3>Hasil Inspeksi</h3>
                            <span>Detail hasil checklist inspeksi rumah sakit</span>
                        </div>

                        <a href="{{ route('inspeksi.index') }}"
                           class="btn btn-light rounded-4 px-4">
                            Kembali
                        </a>

                    </div>

                </div>

                <div class="card-body p-4">

                    {{-- INFO --}}
                    <div class="row mb-4">

                        <div class="col-lg-4 mb-3">
                            <div class="info-box">
                                <div class="info-title">Tanggal</div>
                                <div class="info-value">
                                    {{ $inspeksi->tanggal ?? '-' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 mb-3">
                            <div class="info-box">
                                <div class="info-title">Ruangan</div>
                                <div class="info-value">
                                    {{ $inspeksi->ruangan->nama_ruangan ?? '-' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 mb-3">
                            <div class="info-box">
                                <div class="info-title">Catatan</div>
                                <div class="info-value">
                                    {{ $inspeksi->keterangan ?? '-' }}
                                </div>
                            </div>
                        </div>

                    </div>

                    {{-- TABLE --}}
                    <div class="table-responsive mb-4">

                        <table class="table table-bordered align-middle">

                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Uraian</th>
                                    <th>Sub Uraian</th>
                                    <th>Hasil</th>
                                </tr>
                            </thead>

                            <tbody>

                                @php
                                    $no = 1;
                                @endphp

                                @forelse($subUraian as $item)

                                    @php
                                        $hasil = $jawaban[$item->id] ?? null;
                                    @endphp

                                    <tr>

                                        <td>{{ $no++ }}</td>

                                        <td>{{ $item->uraian->nama_uraian ?? '-' }}</td>

                                        <td>{{ $item->nama_sub_uraian }}</td>

                                        <td>

                                            @if($hasil === 'Baik')
                                                <span class="badge-baik">Baik</span>
                                            @elseif($hasil === 'Tidak Baik')
                                                <span class="badge-tidak">Tidak Baik</span>
                                            @else
                                                <span class="text-muted">Belum diisi</span>
                                            @endif

                                        </td>

                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="4" class="text-center text-muted">
                                            Tidak ada data inspeksi
                                        </td>
                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                    {{-- PETUGAS --}}
                    <div class="row">

                        <div class="col-lg-6 mb-4">
                            <div class="signature-box">
                                <h5>Petugas K3RS</h5>
                                <p class="fw-bold">{{ $inspeksi->nama_petugas_k3rs ?? '-' }}</p>

                                @if(!empty($inspeksi->ttd_k3rs))
                                    <img src="{{ $inspeksi->ttd_k3rs }}">
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-6 mb-4">
                            <div class="signature-box">
                                <h5>Petugas Ruangan</h5>
                                <p class="fw-bold">{{ $inspeksi->nama_petugas_ruangan ?? '-' }}</p>

                                @if(!empty($inspeksi->ttd_ruangan))
                                    <img src="{{ $inspeksi->ttd_ruangan }}">
                                @endif
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection