@extends('layouts.dashboard.master')

@section('title', 'Dashboard')

@section('breadcrumb-title')
<h3>Dashboard</h3>
@endsection

@section('content')

<div class="container-fluid">

    <!-- WELCOME -->
    <div class="row mb-4">
        <div class="col-12">

            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body">

                    <h3 class="fw-bold mb-1">
                        Selamat Datang, {{ Auth::user()->name }} 👋
                    </h3>

                    <p class="text-muted mb-0">
                        Monitoring sistem inspeksi RSUD secara realtime.
                    </p>

                </div>
            </div>

        </div>
    </div>

    <!-- CARD STATISTIK -->
    <div class="row g-3">

        <!-- KATEGORI -->
        <div class="col-xl-3 col-sm-6">

            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

                <div class="card-body bg-primary text-white">

                    <div class="d-flex align-items-center justify-content-between">

                        <div>
                            <span>Kategori</span>

                            <h2 class="fw-bold mb-0 mt-2">
                                {{ $totalKategori ?? 0 }}
                            </h2>
                        </div>

                        <i data-feather="layers" style="width:40px;height:40px;"></i>

                    </div>

                </div>

            </div>

        </div>

        <!-- SUB URAIAN -->
        <div class="col-xl-3 col-sm-6">

            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

                <div class="card-body bg-secondary text-white">

                    <div class="d-flex align-items-center justify-content-between">

                        <div>
                            <span>Sub Uraian</span>

                            <h2 class="fw-bold mb-0 mt-2">
                                {{ $totalSubUraian ?? 0 }}
                            </h2>
                        </div>

                        <i data-feather="file-text" style="width:40px;height:40px;"></i>

                    </div>

                </div>

            </div>

        </div>

        <!-- RUANGAN -->
        <div class="col-xl-3 col-sm-6">

            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

                <div class="card-body bg-success text-white">

                    <div class="d-flex align-items-center justify-content-between">

                        <div>
                            <span>Ruangan</span>

                            <h2 class="fw-bold mb-0 mt-2">
                                {{ $totalRuangan ?? 0 }}
                            </h2>
                        </div>

                        <i data-feather="map-pin" style="width:40px;height:40px;"></i>

                    </div>

                </div>

            </div>

        </div>

        <!-- INSPEKSI -->
        <div class="col-xl-3 col-sm-6">

            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

                <div class="card-body bg-warning text-dark">

                    <div class="d-flex align-items-center justify-content-between">

                        <div>
                            <span>Inspeksi</span>

                            <h2 class="fw-bold mb-0 mt-2">
                                {{ $totalInspeksi ?? 0 }}
                            </h2>
                        </div>

                        <i data-feather="check-circle" style="width:40px;height:40px;"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- CHART + PROGRESS -->
    <div class="row mt-4">

        <!-- CHART -->
        <div class="col-xl-8">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-header bg-white border-0 pt-4">
                    <h5 class="fw-bold">
                        Statistik Inspeksi
                    </h5>
                </div>

                <div class="card-body">

                    <canvas id="inspeksiChart" height="100"></canvas>

                </div>

            </div>

        </div>

        <!-- PROGRESS -->
        <div class="col-xl-4">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-header bg-white border-0 pt-4">
                    <h5 class="fw-bold">
                        Progress Ruangan
                    </h5>
                </div>

                <div class="card-body">

                    <p class="mb-1">ICU</p>

                    <div class="progress mb-3" style="height:10px;">
                        <div class="progress-bar bg-success" style="width:90%"></div>
                    </div>

                    <p class="mb-1">IGD</p>

                    <div class="progress mb-3" style="height:10px;">
                        <div class="progress-bar bg-warning" style="width:70%"></div>
                    </div>

                    <p class="mb-1">Rawat Inap</p>

                    <div class="progress" style="height:10px;">
                        <div class="progress-bar bg-danger" style="width:40%"></div>
                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- AKTIVITAS + TABEL -->
    <div class="row mt-4">

        <!-- AKTIVITAS -->
        <div class="col-xl-6">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-header bg-white border-0 pt-4">
                    <h5 class="fw-bold">
                        Aktivitas Terbaru
                    </h5>
                </div>

                <div class="card-body">

                    <div class="d-flex justify-content-between mb-4">

                        <div>
                            <h6 class="mb-1">Arya</h6>

                            <small class="text-muted">
                                Melakukan inspeksi ICU
                            </small>
                        </div>

                        <small class="text-muted">
                            10 menit lalu
                        </small>

                    </div>

                    <div class="d-flex justify-content-between">

                        <div>
                            <h6 class="mb-1">Admin</h6>

                            <small class="text-muted">
                                Menambahkan ruangan baru
                            </small>
                        </div>

                        <small class="text-muted">
                            1 jam lalu
                        </small>

                    </div>

                </div>

            </div>

        </div>

        <!-- TABEL -->
        <div class="col-xl-6">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-header bg-white border-0 pt-4">
                    <h5 class="fw-bold">
                        Inspeksi Terbaru
                    </h5>
                </div>

                <div class="card-body table-responsive">

                    <table class="table align-middle">

                        <thead>
                            <tr>
                                <th>Ruangan</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>

                            <tr>
                                <td>ICU</td>
                                <td>12 Mei 2026</td>
                                <td>
                                    <span class="badge bg-success">
                                        Selesai
                                    </span>
                                </td>
                            </tr>

                            <tr>
                                <td>IGD</td>
                                <td>12 Mei 2026</td>
                                <td>
                                    <span class="badge bg-warning">
                                        Pending
                                    </span>
                                </td>
                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- CHART JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx = document.getElementById('inspeksiChart');

new Chart(ctx, {
    type: 'line',

    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],

        datasets: [{
            label: 'Jumlah Inspeksi',
            data: [12, 19, 10, 15, 22, 30],
            borderWidth: 3,
            tension: 0.4,
            fill: true
        }]
    },

    options: {
        responsive: true
    }
});

</script>

@endsection