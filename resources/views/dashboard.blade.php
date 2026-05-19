@extends('layouts.dashboard.master')

@section('title', 'Dashboard')

@section('breadcrumb-title')
<h3 class="fw-bold text-dark">Dashboard</h3>
@endsection

@section('content')

<div class="container-fluid">

    <!-- WELCOME -->
    <div class="row mb-4">

        <div class="col-12">

            <div class="card border-0 shadow-lg rounded-4 overflow-hidden welcome-card">

                <div class="card-body p-4 position-relative">

                    <!-- SHAPE -->
                    <div class="welcome-shape shape-1"></div>
                    <div class="welcome-shape shape-2"></div>

                    <div class="row align-items-center position-relative">

                        <div class="col-lg-8">

                            <span class="badge bg-light text-primary px-3 py-2 rounded-pill mb-3 fw-semibold">
                                Sistem Monitoring RSUD
                            </span>

                            <h2 class="fw-bold text-white mb-2">
                                Selamat Datang,
                                {{ Auth::user()->name }} 👋
                            </h2>

                            <p class="text-white-50 mb-0 fs-6">
                                Monitoring sistem inspeksi rumah sakit
                                secara realtime dengan dashboard modern
                                dan analisa data inspeksi.
                            </p>

                            <div class="mt-4 d-flex gap-3 flex-wrap">

                                <div class="mini-badge">
                                    <i data-feather="activity"></i>
                                    Realtime Monitoring
                                </div>

                                <div class="mini-badge">
                                    <i data-feather="shield"></i>
                                    Sistem Aman
                                </div>

                            </div>

                        </div>

                        <div class="col-lg-4 text-end d-none d-lg-block">

                            <div class="welcome-icon">

                                <i data-feather="activity"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- STATISTIK -->
    <div class="row g-4">

        <!-- KATEGORI -->
        <div class="col-xl-3 col-md-6">

            <div class="card dashboard-card card-purple">

                <div class="card-body p-4">

                    <div class="card-circle"></div>

                    <div class="d-flex justify-content-between align-items-start position-relative">

                        <div>

                            <p class="small text-white-50 mb-2">
                                Total Kategori
                            </p>

                            <h1 class="fw-bold text-white mb-1">
                                {{ $totalKategori ?? 0 }}
                            </h1>

                            <small class="text-white-50">
                                Data kategori inspeksi
                            </small>

                        </div>

                        <div class="dashboard-icon">
                            <i data-feather="layers"></i>
                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- SUB URAIAN -->
        <div class="col-xl-3 col-md-6">

            <div class="card dashboard-card card-pink">

                <div class="card-body p-4">

                    <div class="card-circle"></div>

                    <div class="d-flex justify-content-between align-items-start position-relative">

                        <div>

                            <p class="small text-white-50 mb-2">
                                Sub Uraian
                            </p>

                            <h1 class="fw-bold text-white mb-1">
                                {{ $totalSubUraian ?? 0 }}
                            </h1>

                            <small class="text-white-50">
                                Detail pemeriksaan
                            </small>

                        </div>

                        <div class="dashboard-icon">
                            <i data-feather="file-text"></i>
                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- RUANGAN -->
        <div class="col-xl-3 col-md-6">

            <div class="card dashboard-card card-blue">

                <div class="card-body p-4">

                    <div class="card-circle"></div>

                    <div class="d-flex justify-content-between align-items-start position-relative">

                        <div>

                            <p class="small text-white-50 mb-2">
                                Total Ruangan
                            </p>

                            <h1 class="fw-bold text-white mb-1">
                                {{ $totalRuangan ?? 0 }}
                            </h1>

                            <small class="text-white-50">
                                Ruangan rumah sakit
                            </small>

                        </div>

                        <div class="dashboard-icon">
                            <i data-feather="map-pin"></i>
                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- INSPEKSI -->
        <div class="col-xl-3 col-md-6">

            <div class="card dashboard-card card-green">

                <div class="card-body p-4">

                    <div class="card-circle"></div>

                    <div class="d-flex justify-content-between align-items-start position-relative">

                        <div>

                            <p class="small text-white-50 mb-2">
                                Total Inspeksi
                            </p>

                            <h1 class="fw-bold text-white mb-1">
                                {{ $totalInspeksi ?? 0 }}
                            </h1>

                            <small class="text-white-50">
                                Pemeriksaan selesai
                            </small>

                        </div>

                        <div class="dashboard-icon">
                            <i data-feather="check-circle"></i>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- CHART -->
    <div class="row mt-4">

        <!-- BAR CHART -->
        <div class="col-xl-7">

            <div class="card border-0 rounded-4 shadow-lg chart-card h-100">

                <div class="card-header bg-white border-0 p-4">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <h5 class="fw-bold mb-1">
                                Statistik Inspeksi
                            </h5>

                            <small class="text-muted">
                                Statistik inspeksi bulanan
                            </small>

                        </div>

                        <span class="badge bg-primary rounded-pill px-3 py-2">
                            Realtime
                        </span>

                    </div>

                </div>

                <div class="card-body pt-0">

                    <div class="chart-wrapper">
                        <canvas id="inspeksiChart"></canvas>
                    </div>

                </div>

            </div>

        </div>

        <!-- DONUT -->
        <div class="col-xl-5">

            <div class="card border-0 rounded-4 shadow-lg chart-card h-100">

                <div class="card-header bg-white border-0 p-4">

                    <div>

                        <h5 class="fw-bold mb-1">
                            Status Jawaban
                        </h5>

                        <small class="text-muted">
                            Persentase hasil inspeksi
                        </small>

                    </div>

                </div>

                <div class="card-body pt-0">

                    <div class="chart-donut-wrapper">
                        <canvas id="statusChart"></canvas>
                    </div>

                    <!-- STATUS -->
                    <div class="mt-4">

                        <div class="status-item mb-3">

                            <div class="d-flex align-items-center gap-2">

                                <div class="legend-dot bg-success"></div>

                                <span class="fw-semibold">
                                    Baik
                                </span>

                            </div>

                            <strong class="text-success">
                                {{ $totalBaik }}
                            </strong>

                        </div>

                        <div class="status-item">

                            <div class="d-flex align-items-center gap-2">

                                <div class="legend-dot bg-danger"></div>

                                <span class="fw-semibold">
                                    Tidak Baik
                                </span>

                            </div>

                            <strong class="text-danger">
                                {{ $totalTidakBaik }}
                            </strong>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- TABEL -->
    <div class="row mt-4">

        <div class="col-12">

            <div class="card border-0 rounded-4 shadow-lg">

                <div class="card-header bg-white border-0 p-4">

                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                        <div>

                            <h5 class="fw-bold mb-1">
                                Inspeksi Terbaru
                            </h5>

                            <small class="text-muted">
                                Data inspeksi terbaru rumah sakit
                            </small>

                        </div>

                        <a href="{{ route('inspeksi.index') }}"
                           class="btn btn-primary rounded-pill px-4 shadow-sm">
                            Lihat Semua
                        </a>

                    </div>

                </div>

                <div class="card-body table-responsive">

                    <table class="table align-middle modern-table">

                        <thead>

                            <tr>
                                <th>No</th>
                                <th>Ruangan</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                            </tr>

                        </thead>

                        <tbody>

                            @forelse($inspeksi as $item)

                            <tr>

                                <td>
                                    {{ $loop->iteration }}
                                </td>

                                <td class="fw-semibold">
                                    {{ $item->ruangan->nama_ruangan ?? '-' }}
                                </td>

                                <td>
                                    {{ $item->created_at->format('d M Y') }}
                                </td>

                                <td>

                                    @php
                                        $jawaban = $item->jawaban ?? [];
                                        $adaTidakBaik = in_array('Tidak Baik', $jawaban);
                                    @endphp

                                    @if($adaTidakBaik)

                                        <span class="badge bg-danger rounded-pill px-3 py-2">
                                            Tidak Baik
                                        </span>

                                    @else

                                        <span class="badge bg-success rounded-pill px-3 py-2">
                                            Baik
                                        </span>

                                    @endif

                                </td>

                            </tr>

                            @empty

                            <tr>

                                <td colspan="4" class="text-center py-5 text-muted">

                                    <i data-feather="database"
                                       style="width:45px;height:45px;"></i>

                                    <p class="mt-3 mb-0">
                                        Belum ada data inspeksi
                                    </p>

                                </td>

                            </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>

<style>

body{
    background:#f4f7fe;
}

/* CARD */
.card{
    border:none!important;
}

/* WELCOME */
.welcome-card{
    background:linear-gradient(135deg,#7c3aed,#6366f1);
    position:relative;
}

.welcome-shape{
    position:absolute;
    border-radius:50%;
    background:rgba(255,255,255,.08);
}

.shape-1{
    width:250px;
    height:250px;
    top:-80px;
    right:-50px;
}

.shape-2{
    width:180px;
    height:180px;
    bottom:-80px;
    right:180px;
}

.welcome-icon{
    width:120px;
    height:120px;
    border-radius:35px;
    background:rgba(255,255,255,.15);

    display:flex;
    align-items:center;
    justify-content:center;

    backdrop-filter:blur(12px);
}

.welcome-icon svg{
    width:55px;
    height:55px;
    color:white;
}

.mini-badge{
    padding:10px 16px;
    border-radius:14px;
    background:rgba(255,255,255,.12);
    color:white;

    display:flex;
    align-items:center;
    gap:8px;

    backdrop-filter:blur(10px);

    font-size:13px;
}

.mini-badge svg{
    width:16px;
    height:16px;
}

/* DASHBOARD CARD */
.dashboard-card{
    border:none;
    overflow:hidden;
    position:relative;

    transition:.35s ease;
}

.dashboard-card:hover{
    transform:translateY(-10px);
    box-shadow:0 25px 50px rgba(0,0,0,.18)!important;
}

.card-circle{
    position:absolute;
    width:140px;
    height:140px;
    border-radius:50%;
    background:rgba(255,255,255,.08);

    top:-40px;
    right:-30px;
}

.card-purple{
    background:linear-gradient(135deg,#8b5cf6,#6366f1);
}

.card-pink{
    background:linear-gradient(135deg,#ff6cab,#ff417d);
}

.card-blue{
    background:linear-gradient(135deg,#36d1dc,#5b86e5);
}

.card-green{
    background:linear-gradient(135deg,#00c9a7,#00e4d0);
}

/* ICON */
.dashboard-icon{
    width:75px;
    height:75px;
    border-radius:24px;
    background:rgba(255,255,255,.15);

    display:flex;
    align-items:center;
    justify-content:center;

    backdrop-filter:blur(10px);
}

.dashboard-icon svg{
    width:35px;
    height:35px;
    color:white;
}

/* CHART */
.chart-wrapper{
    position:relative;
    height:280px;
}

.chart-donut-wrapper{
    position:relative;
    width:240px;
    height:240px;
    margin:auto;
}

/* STATUS */
.status-item{
    display:flex;
    align-items:center;
    justify-content:space-between;

    padding:15px 18px;
    border-radius:18px;

    background:#f8fafc;
}

.legend-dot{
    width:14px;
    height:14px;
    border-radius:50%;
}

/* TABLE */
.modern-table thead tr{
    background:#f8fafc;
}

.modern-table th{
    border:none;
    padding:18px;
    color:#64748b;
}

.modern-table td{
    padding:18px;
    border-top:1px solid #f1f5f9;
}

.modern-table tbody tr{
    transition:.2s;
}

.modern-table tbody tr:hover{
    transform:scale(1.01);
    background:#fafafa;
}

/* RESPONSIVE */
@media(max-width:768px){

    .welcome-icon{
        display:none;
    }

    .chart-donut-wrapper{
        width:210px;
        height:210px;
    }

}

</style>

<!-- CHART JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

/* BAR CHART */
const ctx = document.getElementById('inspeksiChart');

new Chart(ctx, {

    type: 'bar',

    data: {

        labels: {!! json_encode(
            $chart->pluck('bulan')->map(function($bulan){
                return DateTime::createFromFormat('!m', $bulan)->format('M');
            })
        ) !!},

        datasets: [{

            label: 'Jumlah Inspeksi',

            data: {!! json_encode($chart->pluck('total')) !!},

            borderRadius: 18,
            borderSkipped: false,
            barThickness: 32,

            backgroundColor: [
                '#8b5cf6',
                '#6366f1',
                '#ec4899',
                '#06b6d4',
                '#10b981',
                '#f59e0b'
            ]

        }]
    },

    options: {

        responsive: true,
        maintainAspectRatio:false,

        plugins: {

            legend: {
                display:false
            }

        },

        scales: {

            y: {

                beginAtZero:true,

                grid:{
                    color:'rgba(0,0,0,.05)'
                }

            },

            x: {

                grid:{
                    display:false
                }

            }

        }

    }

});

/* DOUGHNUT */
const statusCtx = document.getElementById('statusChart');

new Chart(statusCtx, {

    type:'doughnut',

    data: {

        labels:['Baik', 'Tidak Baik'],

        datasets:[{

            data:[
                {{ $totalBaik }},
                {{ $totalTidakBaik }}
            ],

            backgroundColor:[
                '#22c55e',
                '#ef4444'
            ],

            borderWidth:0,
            hoverOffset:10

        }]
    },

    options: {

        responsive:true,
        maintainAspectRatio:false,

        cutout:'72%',

        plugins:{

            legend:{
                display:false
            }

        }

    }

});

</script>

@endsection