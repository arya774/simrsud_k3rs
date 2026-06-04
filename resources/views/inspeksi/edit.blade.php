@extends('layouts.dashboard.master')

@section('title', 'Edit Inspeksi')

@section('content')

<style>
.kategori-title{
    font-weight:700;
    color:#1d4ed8;
    font-size:16px;
}
.uraian-title{
    font-weight:600;
    color:#334155;
    font-size:15px;
    margin-bottom:10px;
}
.kategori-block{
    display:none;
}
.table td{
    color:#334155;
    vertical-align:middle;
}
</style>

<div class="container-fluid">

    <div class="card border-0 shadow-sm mb-3">
        <div class="card-body" style="background:#fef9c3;border-left:5px solid #eab308;">
            <h4 class="mb-0">Edit Inspeksi</h4>
            <small class="text-muted">Perbarui data inspeksi</small>
        </div>
    </div>

    <form action="{{ route('inspeksi.update', $inspeksi->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- INFO --}}
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-body">
                <div class="row g-3">

                    {{-- ✅ TANGGAL DIKUNCI --}}
                    <div class="col-md-4">
                        <label class="form-label">Tanggal</label>

                        <input type="date"
                               class="form-control"
                               value="{{ optional($inspeksi->tanggal)->format('Y-m-d') }}"
                               readonly>

                        <input type="hidden"
                               name="tanggal"
                               value="{{ optional($inspeksi->tanggal)->format('Y-m-d') }}">
                    </div>

                    {{-- RUANGAN --}}
                    <div class="col-md-4">
                        <label class="form-label">Ruangan</label>
                        <select name="ruangan_id" class="form-select">
                            @foreach($ruangan as $r)
                                <option value="{{ $r->id }}" {{ $inspeksi->ruangan_id == $r->id ? 'selected' : '' }}>
                                    {{ $r->nama_ruangan }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- ✅ FIX DI SINI (pakai $kategoris) --}}
                    <div class="col-md-4">
                        <label class="form-label">Kategori</label>
                        <select name="kategori_id" id="kategoriSelect" class="form-select">
                            @foreach($kategoris as $k)
                                <option value="{{ $k->id }}" {{ $inspeksi->kategori_id == $k->id ? 'selected' : '' }}>
                                    {{ $k->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>
            </div>
        </div>

        {{-- CHECKLIST --}}
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-body">
                <h5 class="mb-3 text-primary">Checklist Inspeksi</h5>

                @foreach($kategoris as $k)
                <div class="kategori-block" id="kategori-{{ $k->id }}">

                    <div class="p-3 border rounded bg-light mb-3">
                        <div class="kategori-title">{{ $k->nama_kategori }}</div>
                    </div>

                    @foreach($k->subUraians as $su)
                    <div class="mb-3 p-3 border rounded bg-white">

                        <div class="uraian-title">
                            {{ $su->uraian->nama_uraian ?? '-' }}
                        </div>

                        <table class="table table-sm">
                            <tr>
                                <td width="60%">
                                    {{ $su->nama_sub_uraian }}
                                </td>

                                @php
                                    $jawaban = $inspeksi->jawaban[$su->id] ?? 'Baik';
                                @endphp

                                <td>
                                    <input type="radio"
                                           name="jawaban[{{ $su->id }}]"
                                           value="Baik"
                                           {{ $jawaban === 'Baik' ? 'checked' : '' }}>
                                    Baik
                                </td>

                                <td>
                                    <input type="radio"
                                           name="jawaban[{{ $su->id }}]"
                                           value="Tidak Baik"
                                           {{ $jawaban === 'Tidak Baik' ? 'checked' : '' }}>
                                    Tidak Baik
                                </td>
                            </tr>
                        </table>

                    </div>
                    @endforeach

                </div>
                @endforeach

            </div>
        </div>

        {{-- KETERANGAN --}}
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-body">
                <label class="form-label">Keterangan</label>
                <textarea name="keterangan" class="form-control" rows="3">
                    {{ $inspeksi->keterangan }}
                </textarea>
            </div>
        </div>

        {{-- PETUGAS --}}
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label>Petugas K3RS</label>
                        <input type="text" name="nama_petugas_k3rs"
                               class="form-control"
                               value="{{ $inspeksi->nama_petugas_k3rs }}">
                    </div>
                    <div class="col-md-6">
                        <label>Petugas Ruangan</label>
                        <input type="text" name="nama_petugas_ruangan"
                               class="form-control"
                               value="{{ $inspeksi->nama_petugas_ruangan }}">
                    </div>
                </div>
            </div>
        </div>

        {{-- SUBMIT --}}
        <button class="btn btn-warning w-100">
            Update Inspeksi
        </button>

    </form>
</div>

<script>
const select = document.getElementById('kategoriSelect');
const blocks = document.querySelectorAll('.kategori-block');

function showKategori(id){
    blocks.forEach(b => b.style.display = 'none');
    const target = document.getElementById('kategori-' + id);
    if(target){ target.style.display = 'block'; }
}

if(select){
    showKategori(select.value);
    select.addEventListener('change', function () {
        showKategori(this.value);
    });
}
</script>

@endsection