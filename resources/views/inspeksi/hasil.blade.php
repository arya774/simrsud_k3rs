@extends('layouts.dashboard.master')

@section('title', 'Hasil Inspeksi')

@section('breadcrumb-title')

<h3>
    Hasil Inspeksi
</h3>

@endsection

@section('breadcrumb-items')

<li class="breadcrumb-item">
    Inspeksi
</li>

<li class="breadcrumb-item active">
    Hasil Inspeksi
</li>

@endsection

@section('content')

<style>

    .result-card{
        border:none;
        border-radius:24px;
        overflow:hidden;
        box-shadow:0 4px 25px rgba(0,0,0,0.06);
        background:#fff;
    }

    .result-header{
        background:linear-gradient(135deg,#0d6efd,#5b8cff);
        padding:35px;
        color:white;
    }

    .result-header h3{
        font-weight:700;
        margin-bottom:8px;
    }

    .info-card{
        border-radius:20px;
        border:1px solid #eef2f7;
        padding:24px;
        height:100%;
        background:#fff;
    }

    .info-label{
        font-size:13px;
        font-weight:700;
        color:#64748b;
        margin-bottom:8px;
        text-transform:uppercase;
    }

    .info-value{
        font-size:18px;
        font-weight:700;
        color:#1e293b;
    }

    .score-box{
        border-radius:24px;
        padding:35px;
        text-align:center;
        color:white;
        background:linear-gradient(135deg,#198754,#34c38f);
    }

    .score-value{
        font-size:58px;
        font-weight:800;
        line-height:1;
    }

    .score-label{
        margin-top:10px;
        font-size:16px;
        opacity:.9;
    }

    .status-badge{
        display:inline-block;
        padding:10px 18px;
        border-radius:14px;
        font-weight:700;
        font-size:14px;
    }

    .status-success{
        background:#d1fae5;
        color:#065f46;
    }

    .status-primary{
        background:#dbeafe;
        color:#1d4ed8;
    }

    .status-warning{
        background:#fef3c7;
        color:#92400e;
    }

    .status-danger{
        background:#fee2e2;
        color:#991b1b;
    }

    .table{
        margin-bottom:0;
    }

    .table thead th{
        background:#f8fafc;
        border:none;
        padding:16px;
        font-weight:700;
        color:#334155;
    }

    .table tbody td{
        padding:16px;
        vertical-align:middle;
        border-color:#eef2f7;
    }

    /*
    |--------------------------------------------------------------------------
    | HEADER KATEGORI
    |--------------------------------------------------------------------------
    */

   .kategori-row{
    background:#f8fafc;
    border-top:2px solid #e2e8f0;
}

.kategori-title{
    color:#0f172a;
    font-size:16px;
    font-weight:700;
    padding:16px !important;
    letter-spacing:.3px;
}
    /*
    |--------------------------------------------------------------------------
    | HEADER URAIAN
    |--------------------------------------------------------------------------
    */

    .uraian-row{
        background:#f1f5f9;
    }

    .uraian-title{
        font-size:15px;
        font-weight:700;
        color:#0f172a;
        padding:14px 16px !important;
    }

    .badge-baik{
        background:#dcfce7;
        color:#166534;
        padding:8px 14px;
        border-radius:12px;
        font-weight:700;
        display:inline-block;
    }

    .badge-tidak{
        background:#fee2e2;
        color:#991b1b;
        padding:8px 14px;
        border-radius:12px;
        font-weight:700;
        display:inline-block;
    }

    .signature-card{
        border-radius:20px;
        border:1px solid #eef2f7;
        padding:24px;
        text-align:center;
        background:#fff;
        height:100%;
    }

    .signature-card img{
        max-width:100%;
        height:180px;
        object-fit:contain;
        margin-top:15px;
        border-radius:12px;
        border:1px solid #e2e8f0;
        padding:10px;
        background:white;
    }

    .section-title{
        font-size:20px;
        font-weight:700;
        margin-bottom:20px;
        color:#1e293b;
    }

    .empty-data{
        text-align:center;
        padding:30px;
        color:#94a3b8;
        font-weight:600;
    }

    .catatan-box{
        background:#f8fafc;
        border-radius:16px;
        padding:20px;
        border:1px solid #e2e8f0;
        line-height:1.8;
        color:#475569;
    }

    @media(max-width:768px){

        .score-value{
            font-size:42px;
        }

        .table thead th,
        .table tbody td{
            font-size:13px;
            padding:12px 10px;
        }

    }

</style>

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="card result-card mb-4">

        <div class="result-header">

            <h3>
                Detail Hasil Inspeksi
            </h3>

            <span>
                Informasi lengkap hasil pemeriksaan inspeksi ruangan
            </span>

        </div>

    </div>

    {{-- INFO --}}
    <div class="row mb-4">

        <div class="col-lg-3 mb-3">

            <div class="info-card">

                <div class="info-label">
                    Tanggal
                </div>

                <div class="info-value">

                    {{ \Carbon\Carbon::parse($inspeksi->tanggal)->format('d M Y') }}

                </div>

            </div>

        </div>

        <div class="col-lg-3 mb-3">

            <div class="info-card">

                <div class="info-label">
                    Ruangan
                </div>

                <div class="info-value">

                    {{ $inspeksi->ruangan->nama_ruangan ?? '-' }}

                </div>

            </div>

        </div>

        <div class="col-lg-3 mb-3">

            <div class="info-card">

                <div class="info-label">
                    Petugas K3RS
                </div>

                <div class="info-value">

                    {{ $inspeksi->nama_petugas_k3rs ?? '-' }}

                </div>

            </div>

        </div>

        <div class="col-lg-3 mb-3">

            <div class="score-box">

                <div class="score-value">

                    {{ $inspeksi->hasil }}%

                </div>

                <div class="score-label">

                    Hasil Inspeksi

                </div>

                <div class="mt-3">

                    <span class="status-badge status-{{ $inspeksi->badge }}">

                        {{ $inspeksi->status }}

                    </span>

                </div>

            </div>

        </div>

    </div>

    {{-- CHECKLIST --}}
    <div class="card result-card mb-4">

        <div class="card-body p-4">

            <div class="section-title">

                Checklist Inspeksi

            </div>

            @php

                /*
                |--------------------------------------------------------------------------
                | FILTER YANG SUDAH DIISI SAJA
                |--------------------------------------------------------------------------
                */

                $filtered = $subUraian->filter(function ($item) use ($jawaban) {

                    return isset($jawaban[$item->id]);

                });

                /*
                |--------------------------------------------------------------------------
                | GROUP BERDASARKAN KATEGORI -> URAIAN
                |--------------------------------------------------------------------------
                */

                $grouped = $filtered->groupBy(function ($item) {

                    return $item->uraian->kategori->nama_kategori ?? 'Kategori';

                });

            @endphp

            <div class="table-responsive">

                <table class="table align-middle">

                    <thead>

                        <tr>

                            <th width="8%">
                                No
                            </th>

                            <th>
                                Pertanyaan
                            </th>

                            <th width="20%">
                                Jawaban
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($grouped as $namaKategori => $kategoriItems)

                            {{-- HEADER KATEGORI --}}
                            <tr class="kategori-row">

                                <td colspan="3" class="kategori-title">

                                    {{ $namaKategori }}

                                </td>

                            </tr>

                            @php

                                $groupUraian = $kategoriItems->groupBy(function ($item) {

                                    return $item->uraian->nama_uraian ?? 'Lainnya';

                                });

                            @endphp

                            @foreach($groupUraian as $namaUraian => $items)

                                {{-- HEADER URAIAN --}}
                                <tr class="uraian-row">

                                    <td colspan="3" class="uraian-title">

                                        {{ $namaUraian }}

                                    </td>

                                </tr>

                                {{-- ISI --}}
                                @foreach($items as $item)

                                    @php

                                        $value = $jawaban[$item->id] ?? '-';

                                    @endphp

                                    <tr>

                                        <td>

                                            {{ $loop->iteration }}

                                        </td>

                                        <td>

                                            {{ $item->nama_sub_uraian }}

                                        </td>

                                        <td>

                                            @if($value == 'Baik')

                                                <span class="badge-baik">

                                                    Baik

                                                </span>

                                            @elseif($value == 'Tidak Baik')

                                                <span class="badge-tidak">

                                                    Tidak Baik

                                                </span>

                                            @else

                                                -

                                            @endif

                                        </td>

                                    </tr>

                                @endforeach

                            @endforeach

                        @empty

                            <tr>

                                <td colspan="3" class="empty-data">

                                    Tidak ada data checklist inspeksi.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    {{-- CATATAN --}}
    <div class="card result-card mb-4">

        <div class="card-body p-4">

            <div class="section-title">

                Catatan Inspeksi

            </div>

            <div class="catatan-box">

                {{ $inspeksi->keterangan ?? 'Tidak ada catatan inspeksi.' }}

            </div>

        </div>

    </div>

    {{-- TTD --}}
    <div class="row">

        {{-- TTD K3RS --}}
        <div class="col-lg-6 mb-4">

            <div class="signature-card">

                <div class="section-title">

                    Tanda Tangan Petugas K3RS

                </div>

                <div class="fw-bold mb-3">

                    {{ $inspeksi->nama_petugas_k3rs ?? '-' }}

                </div>

                @if($inspeksi->ttd_k3rs)

                    <img
                        src="{{ $inspeksi->ttd_k3rs }}"
                        alt="TTD K3RS"
                    >

                @else

                    <div class="text-muted">

                        Tidak ada tanda tangan

                    </div>

                @endif

            </div>

        </div>

        {{-- TTD RUANGAN --}}
        <div class="col-lg-6 mb-4">

            <div class="signature-card">

                <div class="section-title">

                    Tanda Tangan Petugas Ruangan

                </div>

                <div class="fw-bold mb-3">

                    {{ $inspeksi->nama_petugas_ruangan ?? '-' }}

                </div>

                @if($inspeksi->ttd_ruangan)

                    <img
                        src="{{ $inspeksi->ttd_ruangan }}"
                        alt="TTD Ruangan"
                    >

                @else

                    <div class="text-muted">

                        Tidak ada tanda tangan

                    </div>

                @endif

            </div>

        </div>

    </div>

</div>

@endsection