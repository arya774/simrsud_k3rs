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

                    <div class="row align-items-center">

                        <div class="col-lg-8">

                            <span class="badge bg-light text-primary px-3 py-2 rounded-pill mb-3">
                                Sistem Monitoring RSUD
                            </span>

                            <h2 class="fw-bold text-white mb-2">
                                Selamat Datang,
                                {{ Auth::user()->name }} 👋
                            </h2>

                            <p class="text-white-50 mb-0">
                                Monitoring sistem inspeksi rumah sakit
                                secara realtime dengan dashboard modern.
                            </p>

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

            <div class="card border-0 rounded-4 shadow dashboard-card card-purple text-white">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <p class="small opacity-75 mb-2">
                                Kategori
                            </p>

                            <h1 class="fw-bold mb-0">
                                {{ $totalKategori ?? 0 }}
                            </h1>

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

            <div class="card border-0 rounded-4 shadow dashboard-card card-pink text-white">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <p class="small opacity-75 mb-2">
                                Sub Uraian
                            </p>

                            <h1 class="fw-bold mb-0">
                                {{ $totalSubUraian ?? 0 }}
                            </h1>

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

            <div class="card border-0 rounded-4 shadow dashboard-card card-blue text-white">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <p class="small opacity-75 mb-2">
                                Ruangan
                            </p>

                            <h1 class="fw-bold mb-0">
                                {{ $totalRuangan ?? 0 }}
                            </h1>

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

            <div class="card border-0 rounded-4 shadow dashboard-card card-green text-white">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <p class="small opacity-75 mb-2">
                                Inspeksi
                            </p>

                            <h1 class="fw-bold mb-0">
                                {{ $totalInspeksi ?? 0 }}
                            </h1>

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

        <!-- GRAFIK -->
        <div class="col-xl-8">

            <div class="card border-0 rounded-4 shadow-lg h-100">

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

                <div class="card-body">

                    <canvas id="inspeksiChart" height="110"></canvas>

                </div>

            </div>

        </div>

        <!-- STATUS -->
        <div class="col-xl-4">

            <div class="card border-0 rounded-4 shadow-lg h-100">

                <div class="card-header bg-white border-0 p-4">

                    <h5 class="fw-bold mb-1">
                        Status Jawaban
                    </h5>

                    <small class="text-muted">
                        Persentase hasil inspeksi
                    </small>

                </div>

                <div class="card-body d-flex flex-column justify-content-center">

                    <!-- DOUGHNUT -->
                    <div class="text-center mb-4">

                        <canvas id="statusChart" height="240"></canvas>

                    </div>

                    <!-- LEGEND -->
                    <div>

                        <!-- BAIK -->
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

                        <!-- TIDAK BAIK -->
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

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <h5 class="fw-bold mb-1">
                                Inspeksi Terbaru
                            </h5>

                            <small class="text-muted">
                                Data inspeksi terbaru rumah sakit
                            </small>

                        </div>

                        <a href="{{ route('inspeksi.index') }}"
                           class="btn btn-primary rounded-pill px-4">
                            Lihat Semua
                        </a>

                    </div>

                </div>

                <div class="card-body table-responsive">

                    <table class="table table-hover align-middle">

                        <thead class="table-light">

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
                                       style="width:40px;height:40px;"></i>

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
    background:#f5f7fb;
}

/* WELCOME */
.welcome-card{
    background:linear-gradient(135deg,#7c3aed,#6366f1);
}

.welcome-icon{
    width:120px;
    height:120px;
    border-radius:30px;
    background:rgba(255,255,255,.15);

    display:flex;
    align-items:center;
    justify-content:center;

    backdrop-filter:blur(10px);
}

.welcome-icon svg{
    width:55px;
    height:55px;
    color:white;
}

/* CARD */
.dashboard-card{
    transition:.3s;
    cursor:pointer;
    overflow:hidden;
}

.dashboard-card:hover{
    transform:translateY(-8px);
    box-shadow:0 20px 40px rgba(0,0,0,.15)!important;
}

/* GRADIENT */
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
}

/* STATUS */
.status-item{
    display:flex;
    align-items:center;
    justify-content:space-between;

    padding:14px 16px;
    border-radius:16px;

    background:#f8fafc;
}

.legend-dot{
    width:14px;
    height:14px;
    border-radius:50%;
}

/* TABLE */
.table tbody tr{
    transition:.2s;
}

.table tbody tr:hover{
    transform:scale(1.01);
}

/* CARD */
.card{
    border:none!important;
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

            borderRadius: 15,
            borderSkipped: false,
            barThickness: 35,

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
            hoverOffset:12

        }]
    },

    options: {

        responsive:true,

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