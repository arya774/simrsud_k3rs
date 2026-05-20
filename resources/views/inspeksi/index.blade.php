@extends('layouts.dashboard.master')

@section('title', 'Form Inspeksi')

@section('breadcrumb-title')
<h3>Form Inspeksi</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Inspeksi</li>
<li class="breadcrumb-item active">Form Inspeksi</li>
@endsection

@section('content')

<div class="container-fluid">
<div class="card shadow-sm border-0 rounded-4">

<div class="card-header bg-primary text-white p-4">
    <h4 class="mb-0 fw-bold">Form Inspeksi Rumah Sakit</h4>
</div>

<div class="card-body p-4">

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

@if ($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form id="formInspeksi" action="{{ route('inspeksi.store') }}" method="POST">
@csrf

<div class="row mb-4">

    <div class="col-md-4">
        <label class="fw-bold">Tanggal</label>
        <input type="date" name="tanggal" class="form-control"
               value="{{ old('tanggal', date('Y-m-d')) }}" required>
    </div>

    <div class="col-md-4">
        <label class="fw-bold">Ruangan</label>
        <select name="ruangan_id" class="form-control" required>
            <option value="">-- pilih --</option>
            @foreach($ruangan as $r)
            <option value="{{ $r->id }}">{{ $r->nama_ruangan }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label class="fw-bold">Kategori</label>
        <input type="text" class="form-control" value="Semua Kategori Ditampilkan" readonly>
    </div>

</div>

{{-- KATEGORI --}}
@foreach($kategoris as $kategori)

<div class="card mb-4 border-0 shadow-sm">

    <div class="card-header bg-light fw-bold text-primary d-flex justify-content-between align-items-center"
         style="cursor:pointer"
         onclick="toggleKategori({{ $kategori->id }})">

        {{ $kategori->nama_kategori }}

        <span id="icon-{{ $kategori->id }}" style="transition:0.3s;">
            ▼
        </span>

    </div>

    <div class="card-body"
         id="kategori-body-{{ $kategori->id }}"
         style="display:none;">

        @foreach($kategori->subUraians->groupBy('uraian_id') as $subs)

        <div class="mb-4 p-3 border rounded-3">

            <h6 class="fw-bold mb-3">
                {{ optional($subs->first()->uraian)->nama_uraian }}
            </h6>

            <table class="table table-bordered align-middle">
                <thead>
                    <tr>
                        <th>Pertanyaan</th>
                        <th class="text-center">Baik</th>
                        <th class="text-center">Tidak</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($subs as $sub)
                    <tr>
                        <td>{{ $sub->nama_sub_uraian }}</td>

                        <td class="text-center">
                            <input type="radio"
                                   name="jawaban[{{ $sub->id }}]"
                                   value="Baik"
                                   checked>
                        </td>

                        <td class="text-center">
                            <input type="radio"
                                   name="jawaban[{{ $sub->id }}]"
                                   value="Tidak Baik">
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>

        </div>

        @endforeach

    </div>

</div>

@endforeach

<!-- CATATAN -->
<div class="mb-3">
    <label class="fw-bold">Catatan</label>
    <textarea name="keterangan" class="form-control"></textarea>
</div>

<!-- NAMA PETUGAS -->
<div class="row">

    <div class="col-md-6">
        <label>Nama Petugas K3RS</label>
        <input type="text" name="nama_petugas_k3rs" class="form-control">
    </div>

    <div class="col-md-6">
        <label>Nama Petugas Ruangan</label>
        <input type="text" name="nama_petugas_ruangan" class="form-control">
    </div>

</div>

<!-- TTD -->
<div class="row mt-4">

    <div class="col-md-6">
        <label class="fw-bold">TTD Petugas K3RS</label>
        <canvas id="ttd_k3rs" class="border rounded w-100" height="200"></canvas>
        <input type="hidden" name="ttd_k3rs" id="ttd_k3rs_input">
        <button type="button" class="btn btn-sm btn-danger mt-2"
                onclick="clearPad(padK3RS)">Hapus</button>
    </div>

    <div class="col-md-6">
        <label class="fw-bold">TTD Petugas Ruangan</label>
        <canvas id="ttd_ruangan" class="border rounded w-100" height="200"></canvas>
        <input type="hidden" name="ttd_ruangan" id="ttd_ruangan_input">
        <button type="button" class="btn btn-sm btn-danger mt-2"
                onclick="clearPad(padRuangan)">Hapus</button>
    </div>

</div>

<br>

<button class="btn btn-primary">Simpan</button>

</form>

</div>
</div>
</div>

@endsection

@section('script')

<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>

<script>

// TOGGLE
function toggleKategori(id){
    let body = document.getElementById('kategori-body-' + id);
    let icon = document.getElementById('icon-' + id);

    if(body.style.display === 'none'){
        body.style.display = 'block';
        icon.style.transform = 'rotate(180deg)';
    } else {
        body.style.display = 'none';
        icon.style.transform = 'rotate(0deg)';
    }
}

// INIT CANVAS SMOOTH
function initPad(canvasId){
    const canvas = document.getElementById(canvasId);

    function resizeCanvas() {
        const ratio = Math.max(window.devicePixelRatio || 1, 1);
        canvas.width = canvas.offsetWidth * ratio;
        canvas.height = 200 * ratio;
        canvas.getContext("2d").scale(ratio, ratio);
    }

    resizeCanvas();
    window.addEventListener("resize", resizeCanvas);

    return new SignaturePad(canvas, {
        minWidth: 1,
        maxWidth: 2.5,
        throttle: 16,
        velocityFilterWeight: 0.7,
        penColor: "#000",
    });
}

const padK3RS = initPad('ttd_k3rs');
const padRuangan = initPad('ttd_ruangan');

// CLEAR
function clearPad(pad){
    pad.clear();
}

// SUBMIT
document.getElementById('formInspeksi').addEventListener('submit', function (e) {

    if(padK3RS.isEmpty() || padRuangan.isEmpty()){
        e.preventDefault();
        alert('TTD wajib diisi!');
        return;
    }

    // Background putih biar tidak transparan
    function saveWithWhiteBg(pad){
        const canvas = pad.canvas;
        const ctx = canvas.getContext("2d");

        ctx.globalCompositeOperation = "destination-over";
        ctx.fillStyle = "#fff";
        ctx.fillRect(0, 0, canvas.width, canvas.height);

        return canvas.toDataURL("image/png");
    }

    document.getElementById('ttd_k3rs_input').value = saveWithWhiteBg(padK3RS);
    document.getElementById('ttd_ruangan_input').value = saveWithWhiteBg(padRuangan);
});

</script>

@endsection