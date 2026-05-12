@extends('layouts.dashboard.master')

@section('title', 'Riwayat Inspeksi')

@section('breadcrumb-title')
<h3>Riwayat Inspeksi</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item active">
    Riwayat
</li>
@endsection

@section('content')

<div class="container-fluid">

    <div class="row">

        <div class="col-12">

            <div class="card shadow-sm">

                <div class="card-header bg-white">

                    <h5 class="mb-0">
                        Data Riwayat Inspeksi
                    </h5>

                </div>

                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table table-bordered table-hover">

                            <thead class="table-light">

                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Ruangan</th>
                                </tr>

                            </thead>

                            <tbody>

                                @forelse($inspeksi as $item)

                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->tanggal_inspeksi ?? '-' }}</td>
                                    <td>{{ $item->ruangan ?? '-' }}</td>
                                </tr>

                                @empty

                                <tr>
                                    <td colspan="3" class="text-center text-muted">
                                        Belum ada data inspeksi
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

</div>

@endsection