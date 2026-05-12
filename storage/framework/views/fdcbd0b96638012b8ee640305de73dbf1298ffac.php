

<?php $__env->startSection('title', 'Form Inspeksi'); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
<h3>Form Inspeksi</h3>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>
<li class="breadcrumb-item">Inspeksi</li>
<li class="breadcrumb-item active">Form Inspeksi</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<style>
/* ❌ TIDAK DIUBAH SAMA SEKALI */
.inspection-card{border:none;border-radius:24px;overflow:hidden;box-shadow:0 4px 25px rgba(0,0,0,0.06);background:#fff;}
.inspection-header{background:linear-gradient(135deg,#0d6efd,#5b8cff);padding:30px;color:white;}
.inspection-header h3{font-weight:700;margin-bottom:6px;}
.filter-box{background:#f8fbff;border:1px solid #e8eef8;border-radius:20px;padding:24px;margin-bottom:30px;}
.form-label{font-weight:700;margin-bottom:10px;color:#1e293b;}
.form-select,.form-control{height:56px;border-radius:16px;border:1px solid #dbe4f0;font-size:15px;padding-left:18px;}
textarea.form-control{height:auto;padding-top:15px;}
.kategori-card{border:none;border-radius:24px;overflow:hidden;box-shadow:0 2px 15px rgba(0,0,0,0.05);margin-bottom:25px;}
.kategori-header{background:#f8fbff;padding:24px;border-bottom:1px solid #edf2f7;}
.kategori-title{margin:0;color:#0d6efd;font-weight:700;}
.uraian-box{border:1px solid #edf2f7;border-radius:18px;padding:22px;margin-bottom:25px;}
.uraian-title{font-size:18px;font-weight:700;margin-bottom:20px;color:#1e293b;}
.table{margin-bottom:0;}
.table thead th{background:#f8fafc;border:none;padding:16px;font-weight:700;color:#334155;}
.table tbody td{padding:18px 16px;vertical-align:middle;border-color:#eef2f7;}
.question-text{font-weight:600;color:#334155;}
.custom-radio{width:24px!important;height:24px!important;cursor:pointer;accent-color:#0d6efd;border:2px solid #0d6efd!important;opacity:1!important;display:block!important;}
.signature-card{border:1px solid #e2e8f0;border-radius:20px;padding:20px;background:#fafcff;}
.signature-card canvas{width:100%;height:220px;border-radius:16px;border:2px dashed #cbd5e1;background:#fff;cursor:crosshair;touch-action:none;}
.btn-simpan{height:56px;border-radius:16px;padding:0 35px;font-weight:700;}
.btn-reset{border-radius:14px;font-weight:600;}
</style>

<div class="container-fluid">
<div class="row justify-content-center">
<div class="col-xl-12">

<div class="card inspection-card">

<div class="inspection-header">
<h3>Form Inspeksi Rumah Sakit</h3>
<span>Pilih kategori untuk menampilkan checklist inspeksi</span>
</div>

<div class="card-body p-4">


<?php if($errors->any()): ?>
<div class="alert alert-danger rounded-4 border-0 shadow-sm">
<ul class="mb-0">
<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<li><?php echo e($error); ?></li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>
</div>
<?php endif; ?>

<?php if(session('success')): ?>
<div class="alert alert-success rounded-4 border-0 shadow-sm">
<?php echo e(session('success')); ?>

</div>
<?php endif; ?>

<form action="<?php echo e(route('inspeksi.store')); ?>" method="POST" id="formInspeksi">
<?php echo csrf_field(); ?>

<div class="filter-box">
<div class="row">

<div class="col-lg-4 mb-3">
<label class="form-label">Tanggal Inspeksi</label>
<input type="date" name="tanggal" class="form-control" value="<?php echo e(date('Y-m-d')); ?>" required>
</div>

<div class="col-lg-4 mb-3">
<label class="form-label">Pilih Ruangan</label>
<select name="ruangan_id" class="form-select" required>
<option value="">-- Pilih Ruangan --</option>
<?php $__currentLoopData = $ruangan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<option value="<?php echo e($item->id); ?>"><?php echo e($item->nama_ruangan); ?></option>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>
</div>

<div class="col-lg-4 mb-3">
<label class="form-label">Pilih Kategori</label>


<select id="kategoriSelect" name="kategori_id" class="form-select" required>
<option value="">-- Pilih Kategori --</option>
<?php $__currentLoopData = $kategori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<option value="<?php echo e($item->id); ?>"><?php echo e($item->nama_kategori); ?></option>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>

</div>

</div>
</div>


<?php $__currentLoopData = $kategori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategoriItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="kategori-group d-none" id="kategori-<?php echo e($kategoriItem->id); ?>">
<div class="kategori-card">

<div class="kategori-header">
<h4 class="kategori-title"><?php echo e($kategoriItem->nama_kategori); ?></h4>
</div>

<div class="card-body p-4">

<?php $__currentLoopData = $uraian->where('kategori_id', $kategoriItem->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $uraianItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="uraian-box">

<h5 class="uraian-title"><?php echo e($uraianItem->nama_uraian); ?></h5>

<div class="table-responsive">
<table class="table align-middle">
<thead>
<tr>
<th width="60%">Pertanyaan Inspeksi</th>
<th class="text-center">Baik</th>
<th class="text-center">Tidak Baik</th>
</tr>
</thead>

<tbody>
<?php $__currentLoopData = $subUraian->where('uraian_id', $uraianItem->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr>

<td>
<div class="question-text">
<?php echo e($sub->nama_sub_uraian); ?>

</div>
</td>

<td class="text-center">
<input class="form-check-input custom-radio"
type="radio"
name="jawaban[<?php echo e($sub->id); ?>]"
value="Baik"
required>
</td>

<td class="text-center">
<input class="form-check-input custom-radio"
type="radio"
name="jawaban[<?php echo e($sub->id); ?>]"
value="Tidak Baik"
required>
</td>

</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>

</table>
</div>

</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div>
</div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<div class="mb-4">
<label class="form-label">Catatan Inspeksi</label>
<textarea name="keterangan" rows="5" class="form-control"></textarea>
</div>


<div class="row">

<div class="col-lg-6 mb-4">
<div class="signature-card">
<label class="form-label">Nama Petugas K3RS</label>
<input type="text" name="nama_petugas_k3rs" class="form-control mb-3">

<label class="form-label">Tanda Tangan Petugas K3RS</label>
<canvas id="signature-pad-k3rs"></canvas>
<input type="hidden" name="ttd_k3rs" id="signature-k3rs">

<button type="button" id="clear-k3rs" class="btn btn-light btn-reset mt-3">
Hapus TTD
</button>
</div>
</div>

<div class="col-lg-6 mb-4">
<div class="signature-card">
<label class="form-label">Nama Petugas Ruangan</label>
<input type="text" name="nama_petugas_ruangan" class="form-control mb-3">

<label class="form-label">Tanda Tangan Petugas Ruangan</label>
<canvas id="signature-pad-ruangan"></canvas>
<input type="hidden" name="ttd_ruangan" id="signature-ruangan">

<button type="button" id="clear-ruangan" class="btn btn-light btn-reset mt-3">
Hapus TTD
</button>
</div>
</div>

</div>

<button type="submit"
class="btn btn-primary btn-simpan"
onclick="return confirm('Yakin simpan inspeksi?')">
Simpan Inspeksi
</button>

</form>

</div>
</div>

</div>
</div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>

/* KATEGORI */
const kategoriSelect = document.getElementById('kategoriSelect');
const kategoriGroups = document.querySelectorAll('.kategori-group');

kategoriSelect.addEventListener('change', function () {
kategoriGroups.forEach(g => g.classList.add('d-none'));
if(this.value){
document.getElementById('kategori-' + this.value).classList.remove('d-none');
}
});

/* SIGNATURE */
function initSignature(canvasId, inputId, clearId){
const canvas = document.getElementById(canvasId);
const ctx = canvas.getContext('2d');
const hiddenInput = document.getElementById(inputId);

canvas.width = canvas.offsetWidth;
canvas.height = 220;

let isDrawing = false;

canvas.addEventListener('mousedown', e=>{
isDrawing = true;
ctx.beginPath();
ctx.moveTo(e.offsetX, e.offsetY);
});

canvas.addEventListener('mousemove', e=>{
if(!isDrawing) return;
ctx.lineTo(e.offsetX, e.offsetY);
ctx.stroke();
});

canvas.addEventListener('mouseup', ()=>{
isDrawing = false;
hiddenInput.value = canvas.toDataURL();
});

document.getElementById(clearId).onclick = ()=>{
ctx.clearRect(0,0,canvas.width,canvas.height);
hiddenInput.value='';
};
}

initSignature('signature-pad-k3rs','signature-k3rs','clear-k3rs');
initSignature('signature-pad-ruangan','signature-ruangan','clear-ruangan');

/* 🔥 FIX WAJIB: PASTIKAN TTD KEKIRIM */
document.getElementById('formInspeksi').addEventListener('submit', function(){
document.getElementById('signature-k3rs').value =
document.getElementById('signature-pad-k3rs').toDataURL();

document.getElementById('signature-ruangan').value =
document.getElementById('signature-pad-ruangan').toDataURL();
});

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Downloads\simrsud-starterpack-main\resources\views/inspeksi/index.blade.php ENDPATH**/ ?>