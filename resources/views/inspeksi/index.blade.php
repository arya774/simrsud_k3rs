@extends('layouts.dashboard.master')

@section('title', 'Form Inspeksi')

@section('breadcrumb-title')
<h3 class="fw-bold text-dark">Form Inspeksi</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Inspeksi</li>
<li class="breadcrumb-item active">Form Inspeksi</li>
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
        background:#fff;
        box-shadow:0 10px 35px rgba(0,0,0,.06);
    }

    .main-header{
        background:linear-gradient(135deg,#2563eb,#3b82f6);
        padding:35px;
        color:white;
    }

    .main-header h4{
        margin:0;
        font-weight:800;
        font-size:28px;
    }

    .main-header p{
        margin:8px 0 0;
        opacity:.9;
    }

    .section-title{
        font-size:22px;
        font-weight:800;
        color:#1e293b;
        margin-bottom:25px;
    }

    .form-label{
        font-weight:700;
        margin-bottom:10px;
        color:#334155;
    }

    .form-control{
        border-radius:14px;
        border:1px solid #dbe2ea;
        min-height:48px;
        padding:12px 14px;
    }

    .form-control:focus{
        border-color:#2563eb;
        box-shadow:0 0 0 .15rem rgba(37,99,235,.15);
    }

    #digitalClock{
        background:#eff6ff;
        color:#1d4ed8;
        font-size:20px;
        font-weight:800;
        text-align:center;
        letter-spacing:2px;
    }

    .kategori-card{
        border:none;
        border-radius:24px;
        overflow:hidden;
        margin-bottom:35px;
        background:#fff;
        box-shadow:0 5px 25px rgba(0,0,0,.05);
        border:1px solid #e5edf6;
    }

    .kategori-header{
        background:linear-gradient(135deg,#eff6ff,#dbeafe);
        padding:22px 25px;
        cursor:pointer;
        display:flex;
        align-items:center;
        justify-content:space-between;
        transition:.3s;
    }

    .kategori-header:hover{
        background:linear-gradient(135deg,#dbeafe,#bfdbfe);
    }

    .kategori-header h5{
        margin:0;
        font-size:18px;
        font-weight:800;
        color:#1d4ed8;
        letter-spacing:.5px;
    }

    .kategori-icon{
        font-size:18px;
        transition:.3s;
    }

    .kategori-body{
        padding:25px;
        display:none;
        background:#fff;
    }

    .uraian-card{
        border:1px solid #e2e8f0;
        border-radius:18px;
        overflow:hidden;
        margin-bottom:25px;
        background:#fff;
    }

    .uraian-header{
        padding:16px 20px;
        background:#f8fafc;
        border-bottom:1px solid #e2e8f0;
    }

    .uraian-header h6{
        margin:0;
        font-weight:800;
        color:#334155;
    }

    .table{
        margin-bottom:0;
    }

    .table thead th{
        background:#f8fafc;
        border:1px solid #e2e8f0;
        padding:15px;
        font-weight:700;
        color:#334155;
        text-align:center;
        vertical-align:middle;
    }

    .table tbody td{
        border:1px solid #e2e8f0;
        padding:15px;
        vertical-align:middle;
    }

    .table tbody tr:hover{
        background:#fafcff;
    }

    .pertanyaan{
        font-weight:600;
        color:#0f172a;
        line-height:1.6;
    }

    .radio-wrapper{
        display:flex;
        justify-content:center;
        align-items:center;
    }

    .radio-wrapper input{
        width:18px;
        height:18px;
        cursor:pointer;
    }

    .catatan-kategori{
        margin-top:20px;
        background:#f8fafc;
        border:1px solid #e2e8f0;
        border-radius:18px;
        padding:20px;
    }

    .catatan-kategori h6{
        font-weight:800;
        margin-bottom:15px;
        color:#334155;
    }

    .catatan-kategori textarea{
        min-height:110px;
        resize:none;
    }

    .signature-box{
        border:1px solid #dbe2ea;
        border-radius:18px;
        padding:18px;
        background:#fff;
        box-shadow:0 3px 10px rgba(0,0,0,.03);
    }

    .signature-box label{
        font-weight:700;
        margin-bottom:12px;
        display:block;
        color:#334155;
    }

    canvas{
        background:#fff;
    }

    .btn-save{
        border:none;
        border-radius:16px;
        padding:15px 35px;
        font-weight:700;
        background:linear-gradient(135deg,#2563eb,#1d4ed8);
        transition:.3s;
    }

    .btn-save:hover{
        transform:translateY(-2px);
        box-shadow:0 10px 25px rgba(37,99,235,.25);
    }

    .btn-clear{
        border-radius:12px;
        padding:8px 18px;
        font-weight:600;
    }

</style>

<div class="container-fluid">

    <div class="card main-card">

        <div class="main-header">
            <h4>Form Inspeksi Rumah Sakit</h4>
            <p>Silahkan isi checklist inspeksi dan catatan pemeriksaan</p>
        </div>

        <div class="card-body p-4">

            @if(session('success'))
                <div class="alert alert-success rounded-4">
                    {{ session('success') }}
                </div>
            @endif

            <form id="formInspeksi"
                  action="{{ route('inspeksi.store') }}"
                  method="POST">

                @csrf

                <div class="row mb-4">

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Tanggal</label>
                        <input type="date"
                               name="tanggal"
                               class="form-control"
                               value="{{ old('tanggal', date('Y-m-d')) }}"
                               required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Ruangan</label>
                        <select name="ruangan_id"
                                class="form-control"
                                required>
                            <option value="">-- pilih --</option>

                            @foreach($ruangan as $r)
                                <option value="{{ $r->id }}">
                                    {{ $r->nama_ruangan }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Jam Digital</label>
                        <input type="text"
                               id="digitalClock"
                               class="form-control"
                               readonly>
                    </div>

                </div>

                @foreach($kategoris as $kategori)

                    <div class="kategori-card">

                        <div class="kategori-header"
                             onclick="toggleKategori({{ $kategori->id }})">

                            <h5>{{ strtoupper($kategori->nama_kategori) }}</h5>

                            <span id="icon-{{ $kategori->id }}"
                                  class="kategori-icon">▼</span>

                        </div>

                        <div class="kategori-body"
                             id="kategori-body-{{ $kategori->id }}">

                            @foreach($kategori->subUraians->groupBy('uraian_id') as $subs)

                                <div class="uraian-card">

                                    <div class="uraian-header">
                                        <h6>
                                            {{ optional($subs->first()->uraian)->nama_uraian }}
                                        </h6>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table align-middle">

                                            <thead>
                                                <tr>
                                                    <th>Pertanyaan</th>
                                                    <th width="12%">Baik</th>
                                                    <th width="12%">Tidak</th>
                                                </tr>
                                            </thead>

                                            <tbody>

                                                @foreach($subs as $sub)
                                                <tr>

                                                    <td>
                                                        <div class="pertanyaan">
                                                            {{ $sub->nama_sub_uraian }}
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="radio-wrapper">
                                                            <input type="radio"
                                                                   name="jawaban[{{ $sub->id }}]"
                                                                   value="Baik"
                                                                   checked>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="radio-wrapper">
                                                            <input type="radio"
                                                                   name="jawaban[{{ $sub->id }}]"
                                                                   value="Tidak Baik">
                                                        </div>
                                                    </td>

                                                </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            @endforeach

                            <div class="catatan-kategori">
                                <h6>Catatan {{ $kategori->nama_kategori }}</h6>

                                <textarea
                                    name="catatan_kategori[{{ $kategori->id }}]"
                                    class="form-control"
                                    placeholder="Masukkan catatan kategori"></textarea>
                            </div>

                        </div>
                    </div>

                @endforeach


                <div class="row mt-4">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Petugas K3RS</label>
                        <input type="text"
                               name="nama_petugas_k3rs"
                               class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Petugas Ruangan</label>
                        <input type="text"
                               name="nama_petugas_ruangan"
                               class="form-control">
                    </div>

                </div>


                <div class="row mt-4">

                    <div class="col-md-6 mb-4">
                        <div class="signature-box">
                            <label>TTD Petugas K3RS</label>
                            <canvas id="ttd_k3rs"
                                    class="border rounded w-100"
                                    height="200"></canvas>

                            <input type="hidden"
                                   name="ttd_k3rs"
                                   id="ttd_k3rs_input">

                            <button type="button"
                                    class="btn btn-danger btn-sm btn-clear mt-3"
                                    onclick="clearPad(padK3RS)">
                                Hapus
                            </button>
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <div class="signature-box">
                            <label>TTD Petugas Ruangan</label>
                            <canvas id="ttd_ruangan"
                                    class="border rounded w-100"
                                    height="200"></canvas>

                            <input type="hidden"
                                   name="ttd_ruangan"
                                   id="ttd_ruangan_input">

                            <button type="button"
                                    class="btn btn-danger btn-sm btn-clear mt-3"
                                    onclick="clearPad(padRuangan)">
                                Hapus
                            </button>
                        </div>
                    </div>

                </div>

                <button class="btn btn-primary btn-save">
                    Simpan Inspeksi
                </button>

            </form>

        </div>
    </div>
</div>

@endsection


@section('script')

<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>

<script>

function updateClock(){
    const now = new Date();

    const jam = String(now.getHours()).padStart(2,'0');
    const menit = String(now.getMinutes()).padStart(2,'0');
    const detik = String(now.getSeconds()).padStart(2,'0');

    document.getElementById('digitalClock').value =
        jam + ':' + menit + ':' + detik;
}

setInterval(updateClock,1000);
updateClock();


function toggleKategori(id){

    let body=document.getElementById('kategori-body-'+id);
    let icon=document.getElementById('icon-'+id);

    if(body.style.display==='none'||body.style.display===''){
        body.style.display='block';
        icon.style.transform='rotate(180deg)';
    }else{
        body.style.display='none';
        icon.style.transform='rotate(0deg)';
    }
}


function initPad(canvasId){

    const canvas=document.getElementById(canvasId);

    function resizeCanvas(){
        const ratio=Math.max(window.devicePixelRatio||1,1);

        canvas.width=canvas.offsetWidth*ratio;
        canvas.height=200*ratio;

        canvas.getContext("2d").scale(ratio,ratio);
    }

    resizeCanvas();

    window.addEventListener("resize",resizeCanvas);

    return new SignaturePad(canvas,{
        minWidth:1,
        maxWidth:2.5,
        penColor:"#000"
    });
}

const padK3RS=initPad('ttd_k3rs');
const padRuangan=initPad('ttd_ruangan');

function clearPad(pad){
    pad.clear();
}

document.getElementById('formInspeksi').addEventListener('submit',function(e){

    if(padK3RS.isEmpty() || padRuangan.isEmpty()){
        e.preventDefault();
        alert('TTD wajib diisi!');
        return;
    }

    function saveWithWhiteBg(pad){

        const canvas=pad.canvas;
        const ctx=canvas.getContext("2d");

        ctx.globalCompositeOperation="destination-over";
        ctx.fillStyle="#fff";
        ctx.fillRect(0,0,canvas.width,canvas.height);

        return canvas.toDataURL("image/png");
    }

    document.getElementById('ttd_k3rs_input').value=
        saveWithWhiteBg(padK3RS);

    document.getElementById('ttd_ruangan_input').value=
        saveWithWhiteBg(padRuangan);

});

</script>

@endsection