@extends('layouts.dashboard.master')

@section('title', 'Data Uraian')

@section('breadcrumb-title')
<h3 class="fw-bold">Data Uraian</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Master Data</li>
<li class="breadcrumb-item active">Uraian</li>
@endsection

@section('content')

<div class="container-fluid">

    <div class="card border-0 shadow rounded-4 overflow-hidden">

        <!-- HEADER -->
        <div class="card-header bg-primary text-white p-4">

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                <div>

                    <h3 class="fw-bold mb-1">
                        Data Uraian Inspeksi
                    </h3>

                    <small>
                        Kelola data uraian inspeksi rumah sakit
                    </small>

                </div>

                <a href="{{ route('master-data.uraian.create') }}"
                   class="btn btn-light rounded-3 px-4 py-2 fw-semibold">

                    <i data-feather="plus-circle"></i>
                    Tambah Uraian

                </a>

            </div>

        </div>

        <!-- BODY -->
        <div class="card-body p-4">

            @if(session('success'))

                <div class="alert alert-success rounded-4 border-0 shadow-sm">
                    {{ session('success') }}
                </div>

            @endif

            <!-- SEARCH -->
            <div class="mb-4">

                <input type="text"
                       id="searchUraian"
                       class="form-control rounded-4"
                       placeholder="Cari uraian..."
                       style="padding:14px;">

            </div>

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-light">

                        <tr>

                            <th width="70">No</th>
                            <th>Kategori</th>
                            <th>Nama Uraian</th>
                            <th width="220" class="text-center">
                                Aksi
                            </th>

                        </tr>

                    </thead>

                    <tbody id="uraianTable">

                        @forelse($data as $item)

                            <tr>

                                <td>
                                    {{ $loop->iteration }}
                                </td>

                                <td>

                                    <span class="badge bg-primary rounded-pill px-3 py-2">

                                        {{ $item->kategori->nama_kategori ?? '-' }}

                                    </span>

                                </td>

                                <td>

                                    <strong>
                                        {{ $item->nama_uraian }}
                                    </strong>

                                </td>

                                <td>

                                    <div class="d-flex justify-content-center gap-2">

                                        <!-- EDIT -->
                                        <button
                                            class="btn btn-warning rounded-3 d-flex align-items-center gap-1"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $item->id }}">

                                            <i data-feather="edit-2"></i>
                                            Edit

                                        </button>

                                        <!-- DELETE -->
                                        <form action="{{ route('master-data.uraian.destroy', $item->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus data ini?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-danger rounded-3 d-flex align-items-center gap-1">

                                                <i data-feather="trash-2"></i>
                                                Hapus

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                            <!-- MODAL EDIT -->
                            <div class="modal fade"
                                 id="editModal{{ $item->id }}"
                                 tabindex="-1">

                                <div class="modal-dialog modal-dialog-centered">

                                    <div class="modal-content rounded-4 border-0">

                                        <div class="modal-header border-0">

                                            <h5 class="fw-bold">
                                                Edit Uraian
                                            </h5>

                                            <button type="button"
                                                    class="btn-close"
                                                    data-bs-dismiss="modal"></button>

                                        </div>

                                        <form action="{{ route('master-data.uraian.update', $item->id) }}"
                                              method="POST">

                                            @csrf
                                            @method('PUT')

                                            <div class="modal-body">

                                                <div class="mb-3">

                                                    <label class="form-label">
                                                        Nama Uraian
                                                    </label>

                                                    <input type="text"
                                                           name="nama_uraian"
                                                           class="form-control rounded-3"
                                                           value="{{ $item->nama_uraian }}"
                                                           required>

                                                </div>

                                            </div>

                                            <div class="modal-footer border-0">

                                                <button type="button"
                                                        class="btn btn-light rounded-3"
                                                        data-bs-dismiss="modal">

                                                    Batal

                                                </button>

                                                <button type="submit"
                                                        class="btn btn-primary rounded-3">

                                                    Update Data

                                                </button>

                                            </div>

                                        </form>

                                    </div>

                                </div>

                            </div>

                        @empty

                            <tr>

                                <td colspan="4"
                                    class="text-center py-5 text-muted">

                                    <i data-feather="inbox"
                                       style="width:40px;height:40px;"></i>

                                    <p class="mt-2 mb-0">
                                        Belum ada data uraian
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

<script>

    feather.replace();

    document.getElementById('searchUraian')
    .addEventListener('keyup', function(){

        let value = this.value.toLowerCase();

        let rows = document.querySelectorAll('#uraianTable tr');

        rows.forEach(row => {

            row.style.display =
                row.innerText.toLowerCase().includes(value)
                ? ''
                : 'none';

        });

    });

</script>

@endsection