@extends('layouts.dashboard.master')

@section('title', 'Laporan Inspeksi')

@section('content')

<div class="container-fluid">

    <h3 class="mb-4">Laporan Inspeksi</h3>

    {{-- FILTER --}}
    <form method="GET"
          action="{{ route('laporan.inspeksi') }}"
          class="card p-3 mb-4"
          autocomplete="off">

        <div class="row">

            <div class="col-md-3 mb-2">
                <label>Dari Tanggal</label>
                <input type="date"
                       name="dari"
                       value="{{ request('dari') }}"
                       class="form-control">
            </div>

            <div class="col-md-3 mb-2">
                <label>Sampai Tanggal</label>
                <input type="date"
                       name="sampai"
                       value="{{ request('sampai') }}"
                       class="form-control">
            </div>

            <div class="col-md-3 mb-2">
                <label>Ruangan</label>
                <select name="ruangan_id" class="form-control">
                    <option value="">Semua</option>
                    @foreach($ruangan as $r)
                        <option value="{{ $r->id }}"
                            {{ request('ruangan_id') == $r->id ? 'selected' : '' }}>
                            {{ $r->nama_ruangan }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3 mb-2">
                <label>Kategori</label>
                <select name="kategori_id" class="form-control">
                    <option value="">Semua</option>
                    @foreach($kategori as $k)
                        <option value="{{ $k->id }}"
                            {{ request('kategori_id') == $k->id ? 'selected' : '' }}>
                            {{ $k->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

        </div>

        <div class="mt-3">
            <button type="submit"
                    class="btn btn-primary">
                Filter
            </button>

            <a href="{{ route('laporan.inspeksi') }}"
               class="btn btn-secondary">
                Reset
            </a>
        </div>

    </form>

    {{-- TABLE --}}
    <div class="card p-3">

        <div class="table-responsive">

            <table class="table table-bordered align-middle">

                <thead class="table-light">
                    <tr>
                        <th width="5%">No</th>
                        <th>Tanggal</th>
                        <th>Ruangan</th>
                        <th>Kategori</th>
                        <th class="text-center">Hasil</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($inspeksi as $i)

                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $i->tanggal }}</td>
                            <td>{{ $i->ruangan->nama_ruangan ?? '-' }}</td>
                            <td>{{ $i->kategori->nama_kategori ?? '-' }}</td>
                            <td class="text-center">
                                <span class="badge bg-success">
                                    {{ $i->hasil }}%
                                </span>
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                Tidak ada data laporan
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection