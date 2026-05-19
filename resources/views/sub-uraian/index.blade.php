@extends('layouts.dashboard.master')

@section('title', 'Data Sub Uraian')

@section('breadcrumb-title')
<h3 class="fw-bold">Data Sub Uraian</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Master Data</li>
<li class="breadcrumb-item active">Sub Uraian</li>
@endsection

@section('content')

<style>

    body{
        background:#f4f7fb;
    }

    .main-card{
        border:none;
        border-radius:28px;
        overflow:hidden;
        background:#ffffff;
        box-shadow:0 10px 40px rgba(0,0,0,0.08);
    }

    .header-gradient{
        background:linear-gradient(135deg,#4f46e5,#2563eb);
        padding:32px;
        color:white;
    }

    .header-gradient h3{
        font-weight:700;
        margin-bottom:6px;
    }

    .header-gradient small{
        opacity:0.8;
    }

    .btn-add{
        background:white;
        color:#2563eb;
        border:none;
        border-radius:16px;
        padding:12px 22px;
        font-weight:600;
        transition:0.3s;
    }

    .btn-add:hover{
        transform:translateY(-2px);
        background:#f8fafc;
    }

    .search-box{
        border:none;
        background:#eef2ff;
        border-radius:16px;
        padding:14px 18px;
        font-size:15px;
    }

    .search-box:focus{
        background:#e0e7ff;
        box-shadow:none;
    }

    .table-modern{
        border-collapse:separate;
        border-spacing:0 16px;
    }

    .table-modern thead th{
        border:none;
        color:#64748b;
        font-size:14px;
        font-weight:700;
        padding:0 18px;
    }

    .table-modern tbody tr{
        background:#fff;
        border-radius:18px;
        box-shadow:0 5px 18px rgba(0,0,0,0.05);
        transition:0.3s;
    }

    .table-modern tbody tr:hover{
        transform:translateY(-3px);
        box-shadow:0 10px 24px rgba(0,0,0,0.08);
    }

    .table-modern td{
        border:none !important;
        vertical-align:middle;
        padding:20px 18px;
        color:#0f172a;
        font-weight:600;
    }

    .number-badge{
        width:40px;
        height:40px;
        border-radius:14px;
        background:#eef2ff;
        color:#4338ca;
        display:flex;
        align-items:center;
        justify-content:center;
        font-weight:700;
    }

    .sub-title{
        font-size:16px;
        font-weight:700;
        color:#0f172a;
    }

    .action-group{
        display:flex;
        justify-content:center;
        gap:10px;
    }

    .btn-action{
        border:none;
        border-radius:14px;
        padding:10px 16px;
        font-weight:600;
        display:flex;
        align-items:center;
        gap:6px;
        transition:0.3s;
    }

    .btn-action:hover{
        transform:translateY(-2px);
    }

    .btn-edit{
        background:#facc15;
        color:#000;
    }

    .btn-delete{
        background:#ef4444;
        color:white;
    }

    .btn-save{
        background:#2563eb;
        color:white;
        border:none;
        border-radius:14px;
        padding:10px 20px;
        font-weight:600;
    }

    .modal-content{
        border:none;
        border-radius:24px;
    }

    .modal-header{
        border:none;
        padding-bottom:0;
    }

    .modal-footer{
        border:none;
    }

    .form-control{
        border-radius:14px;
        padding:12px 14px;
    }

    .form-control:focus{
        box-shadow:none;
        border-color:#4f46e5;
    }

    @media(max-width:768px){

        .header-gradient{
            padding:22px;
        }

        .btn-add{
            width:100%;
        }

        .table-modern td{
            padding:14px;
        }

        .btn-action{
            width:100%;
            justify-content:center;
        }

        .action-group{
            flex-direction:column;
        }

    }

</style>

<div class="container-fluid">

    <div class="main-card">

        <div class="header-gradient">

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                <div>

                    <h3>Data Sub Uraian</h3>

                    <small>
                        Kelola data sub uraian inspeksi rumah sakit
                    </small>

                </div>

                <a href="{{ route('master-data.sub-uraian.create') }}"
                   class="btn-add d-flex align-items-center gap-2">

                    <i data-feather="plus-circle"></i>

                    Tambah Sub Uraian

                </a>

            </div>

        </div>

        <div class="p-4">

            @if(session('success'))

                <div class="alert alert-success border-0 rounded-4 shadow-sm">

                    {{ session('success') }}

                </div>

            @endif

            <div class="mb-4">

                <input type="text"
                       id="searchInput"
                       class="form-control search-box"
                       placeholder="Cari sub uraian...">

            </div>

            <div class="table-responsive">

                <table class="table table-modern">

                    <thead>

                        <tr>

                            <th width="80">No</th>

                            <th>Kategori</th>

                            <th>Uraian</th>

                            <th>Sub Uraian</th>

                            <th width="260" class="text-center">
                                Aksi
                            </th>

                        </tr>

                    </thead>

                    <tbody id="tableBody">

                        @forelse($data as $item)

                            <tr>

                                <td>

                                    <div class="number-badge">

                                        {{ $loop->iteration }}

                                    </div>

                                </td>

                                <td>

                                    {{ $item->uraian->kategori->nama_kategori ?? '-' }}

                                </td>

                                <td>

                                    {{ $item->uraian->nama_uraian ?? '-' }}

                                </td>

                                <td>

                                    <div class="sub-title">

                                        {{ $item->nama_sub_uraian }}

                                    </div>

                                </td>

                                <td>

                                    <div class="action-group">

                                        <button
                                            class="btn-action btn-edit"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $item->id }}">

                                            <i data-feather="edit-2"></i>

                                            Edit

                                        </button>

                                        <form action="{{ route('master-data.sub-uraian.destroy', $item->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus data ini?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn-action btn-delete">

                                                <i data-feather="trash-2"></i>

                                                Hapus

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="5">

                                    <div class="text-center py-5 text-muted">

                                        <h5 class="fw-bold">
                                            Belum Ada Data
                                        </h5>

                                    </div>

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

document.addEventListener('DOMContentLoaded', function () {

    feather.replace();

    const searchInput = document.getElementById('searchInput');

    if(searchInput){

        searchInput.addEventListener('keyup', function(){

            const value = this.value.toLowerCase();

            const rows = document.querySelectorAll('#tableBody tr');

            rows.forEach(function(row){

                const text = row.innerText.toLowerCase();

                if(text.includes(value)){
                    row.style.display = '';
                }else{
                    row.style.display = 'none';
                }

            });

        });

    }

});

</script>

@endsection
