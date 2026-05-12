@extends('layouts.dashboard.master')

@section('title', 'Riwayat Inspeksi')

@section('breadcrumb-title')
<h3>Riwayat Inspeksi</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Inspeksi</li>
<li class="breadcrumb-item active">Riwayat</li>
@endsection

@section('content')

<style>
    .history-card{
        border:none;
        border-radius:24px;
        overflow:hidden;
        box-shadow:0 4px 25px rgba(0,0,0,0.06);
        background:#fff;
    }

    .history-header{
        background:linear-gradient(135deg,#0d6efd,#5b8cff);
        padding:30px;
        color:white;
    }

    .history-header h3{
        font-weight:700;
        margin-bottom:6px;
    }

    .table{
        margin-bottom:0;
    }

    .table thead th{
        background:#f8fafc;
        border:none;
        padding:18px;
        font-weight:700;
        color:#334155;
        white-space:nowrap;
    }

    .table tbody td{
        padding:18px;
        vertical-align:middle;
        border-color:#eef2f7;
        color:#334155;
    }

    .badge-custom{
        background:#e8f1ff;
        color:#0d6efd;
        padding:8px 14px;
        border-radius:12px;
        font-weight:600;
        font-size:13px;
    }

    .btn-detail{
        border-radius:12px;
        padding:8px 18px;
        font-weight:600;
    }

    .empty-box{
        padding:60px 20px;
        text-align:center;
    }

    .empty-box img{
        width:120px;
        opacity:.7;
        margin-bottom:20px;
    }

    .empty-title{
        font-size:20px;
        font-weight:700;
        color:#334155;
    }

    .empty-subtitle{
        color:#64748b;
        margin-top:8px;
    }

    @media(max-width:768px){
        .table thead th,
        .table tbody td{
            font-size:13px;
            padding:12px 10px;
        }
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">

            <div class="card history-card">

                <div class="history-header">
                    <h3>Riwayat Inspeksi</h3>
                    <span>Seluruh data inspeksi yang sudah pernah dilakukan</span>
                </div>

                <div class="card-body p-4">

                    @if(session('success'))
                        <div class="alert alert-success border-0 rounded-4 shadow-sm">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($inspeksis->count() > 0)

                        <div class="table-responsive">

                            <table class="table align-middle">

                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th>Tanggal</th>
                                        <th>Ruangan</th>
                                        <th>Petugas K3RS</th>
                                        <th>Petugas Ruangan</th>
                                        <th>Total Checklist</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach($inspeksis as $item)

                                        <tr>

                                            <td>{{ $loop->iteration }}</td>

                                            <td>
                                                <span class="badge-custom">
                                                    {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                                                </span>
                                            </td>

                                            <td>
                                                <strong>
                                                    {{ $item->ruangan->nama_ruangan ?? '-' }}
                                                </strong>
                                            </td>

                                            <td>
                                                {{ $item->nama_petugas_k3rs ?? '-' }}
                                            </td>

                                            <td>
                                                {{ $item->nama_petugas_ruangan ?? '-' }}
                                            </td>

                                            <td>
                                                @php
                                                    $jumlahJawaban = is_array($item->jawaban)
                                                        ? count($item->jawaban)
                                                        : 0;
                                                @endphp

                                                <span class="badge-custom">
                                                    {{ $jumlahJawaban }} Checklist
                                                </span>
                                            </td>

                                            <td class="text-center">
                                                <a href="{{ route('inspeksi.hasil', $item->id) }}"
                                                   class="btn btn-primary btn-detail">
                                                    <i data-feather="eye"></i>
                                                    Detail
                                                </a>
                                            </td>

                                        </tr>

                                    @endforeach

                                </tbody>

                            </table>

                        </div>

                    @else

                        <div class="empty-box">
                            <img src="{{ asset('assets/images/dashboard/no-data.png') }}" alt="No Data">

                            <div class="empty-title">
                                Belum Ada Riwayat Inspeksi
                            </div>

                            <div class="empty-subtitle">
                                Data inspeksi yang sudah disimpan akan muncul di halaman ini
                            </div>
                        </div>

                    @endif

                </div>

            </div>

        </div>
    </div>
</div>

@endsection