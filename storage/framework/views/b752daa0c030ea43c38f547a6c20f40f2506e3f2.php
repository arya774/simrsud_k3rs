

<?php $__env->startSection('title', 'Riwayat Inspeksi'); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
<h3>Riwayat Inspeksi</h3>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>
<li class="breadcrumb-item">Inspeksi</li>
<li class="breadcrumb-item active">Riwayat</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<style>
.history-card{
    border:none;
    border-radius:24px;
    overflow:hidden;
    box-shadow:0 4px 25px rgba(0,0,0,0.06);
    background:#fff;
}

.history-header{
    background:linear-gradient(135deg,#0d6efd,#5b8cff);
    padding:30px;
    color:white;
}

.history-header h3{
    font-weight:700;
    margin-bottom:6px;
}

.table thead th{
    background:#f8fafc;
    border:none;
    padding:18px;
    font-weight:700;
    color:#334155;
    white-space:nowrap;
}

.table tbody td{
    padding:18px;
    vertical-align:middle;
    border-color:#eef2f7;
    color:#334155;
}

.badge-custom{
    background:#e8f1ff;
    color:#0d6efd;
    padding:8px 14px;
    border-radius:12px;
    font-weight:600;
    font-size:13px;
}

.btn-detail{
    border-radius:12px;
    padding:8px 14px;
    font-weight:600;
}

.btn-edit{
    border-radius:12px;
    padding:8px 14px;
    font-weight:600;
    background:#facc15;
    color:#000;
    border:none;
}

.btn-delete{
    border-radius:12px;
    padding:8px 14px;
    font-weight:600;
    background:#ef4444;
    color:#fff;
    border:none;
}

.empty-box{
    padding:60px 20px;
    text-align:center;
}

.empty-title{
    font-size:20px;
    font-weight:700;
}

.empty-subtitle{
    color:#64748b;
}

/* 🔥 SEARCH STYLE UPGRADE */
.search-wrapper{
    display:flex;
    gap:10px;
    margin-bottom:20px;
    max-width:500px;
}

.search-input{
    border-radius:12px;
    padding:10px 15px;
    border:1px solid #e2e8f0;
}

</style>

<div class="container-fluid">
<div class="row">
<div class="col-12">

<div class="card history-card">

<div class="history-header">
    <h3>Riwayat Inspeksi</h3>
    <span>Seluruh data inspeksi yang sudah pernah dilakukan</span>
</div>

<div class="card-body p-4">

<?php if(session('success')): ?>
<div class="alert alert-success border-0 rounded-4 shadow-sm">
    <?php echo e(session('success')); ?>

</div>
<?php endif; ?>

<?php if($inspeksis->count() > 0): ?>


<div class="search-wrapper">
    <input type="text" id="searchInput" class="form-control search-input"
           placeholder="🔍 Cari data... tekan Enter">

    <button class="btn btn-primary" onclick="searchTable()">Cari</button>
    <button class="btn btn-secondary" onclick="resetTable()">Reset</button>
</div>

<div class="table-responsive">

<table class="table align-middle" id="tableInspeksi">

<thead>
<tr>
    <th>No</th>
    <th>Tanggal</th>
    <th>Ruangan</th>
    <th>Petugas K3RS</th>
    <th>Petugas Ruangan</th>
    <th>Total Checklist</th>
    <th class="text-center">Aksi</th>
</tr>
</thead>

<tbody>

<?php $__currentLoopData = $inspeksis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<tr>

<td><?php echo e($loop->iteration); ?></td>

<td>
    <span class="badge-custom">
        <?php echo e(\Carbon\Carbon::parse($item->tanggal)->format('d M Y')); ?>

    </span>
</td>

<td>
    <strong><?php echo e($item->ruangan->nama_ruangan ?? '-'); ?></strong>
</td>

<td><?php echo e($item->nama_petugas_k3rs ?? '-'); ?></td>

<td><?php echo e($item->nama_petugas_ruangan ?? '-'); ?></td>

<td>
    <?php
        $jumlahJawaban = is_array($item->jawaban) ? count($item->jawaban) : 0;
    ?>

    <span class="badge-custom">
        <?php echo e($jumlahJawaban); ?> Checklist
    </span>
</td>

<td class="text-center">

    <a href="<?php echo e(route('inspeksi.hasil', $item->id)); ?>"
       class="btn btn-sm btn-primary btn-detail">
        Detail
    </a>

    <a href="<?php echo e(route('inspeksi.edit', $item->id)); ?>"
       class="btn btn-sm btn-edit">
        Edit
    </a>

    <form action="<?php echo e(route('inspeksi.destroy', $item->id)); ?>"
          method="POST"
          style="display:inline-block"
          onsubmit="return confirm('Yakin ingin menghapus data ini?')">

        <?php echo csrf_field(); ?>
        <?php echo method_field('DELETE'); ?>

        <button type="submit" class="btn btn-sm btn-delete">
            Hapus
        </button>
    </form>

</td>

</tr>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</tbody>

</table>

</div>

<?php else: ?>

<div class="empty-box">
    <div class="empty-title">Belum Ada Riwayat Inspeksi</div>
    <div class="empty-subtitle">
        Data inspeksi yang sudah disimpan akan muncul di halaman ini
    </div>
</div>

<?php endif; ?>

</div>
</div>

</div>
</div>
</div>


<script>

function searchTable() {
    let value = document.getElementById("searchInput").value.toLowerCase();
    let rows = document.querySelectorAll("#tableInspeksi tbody tr");

    rows.forEach(row => {
        let text = row.innerText.toLowerCase();
        row.style.display = text.includes(value) ? "" : "none";
    });
}

function resetTable() {
    document.getElementById("searchInput").value = "";
    let rows = document.querySelectorAll("#tableInspeksi tbody tr");

    rows.forEach(row => {
        row.style.display = "";
    });
}

// 🔥 ENTER TRIGGER
document.getElementById("searchInput").addEventListener("keypress", function(e) {
    if (e.key === "Enter") {
        e.preventDefault();
        searchTable();
    }
});

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Downloads\simrsud-starterpack-main\resources\views/inspeksi/riwayat.blade.php ENDPATH**/ ?>