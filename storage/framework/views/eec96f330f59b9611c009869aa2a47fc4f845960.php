

<?php $__env->startSection('title', 'Data Sub Uraian'); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
<h3 class="fw-bold">Data Sub Uraian</h3>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>
<li class="breadcrumb-item">Master Data</li>
<li class="breadcrumb-item active">Sub Uraian</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

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
}
.btn-add{
    background:white;
    color:#2563eb;
    border:none;
    border-radius:16px;
    padding:12px 22px;
    font-weight:600;
}
.search-box{
    border:none;
    background:#eef2ff;
    border-radius:16px;
    padding:14px 18px;
}
.table-modern{
    border-collapse:separate;
    border-spacing:0 16px;
}
.table-modern tbody tr{
    background:#fff;
    box-shadow:0 5px 18px rgba(0,0,0,0.05);
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
.action-group{
    display:flex;
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
    text-decoration:none;
}
.btn-edit{
    background:#facc15;
    color:black !important;
}
.btn-delete{
    background:#ef4444;
    color:white;
}
</style>

<div class="container-fluid">

    <div class="main-card">

        <div class="header-gradient">

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                <div>
                    <h3>Data Sub Uraian</h3>
                    <small>Kelola data sub uraian inspeksi rumah sakit</small>
                </div>

                <a href="<?php echo e(route('master-data.sub-uraian.create')); ?>"
                   class="btn-add d-flex align-items-center gap-2">
                    <i data-feather="plus-circle"></i>
                    Tambah Sub Uraian
                </a>

            </div>

        </div>

        <div class="p-4">

            <?php if(session('success')): ?>
                <div class="alert alert-success border-0 rounded-4 shadow-sm">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

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
                            <th>No</th>
                            <th>Kategori</th>
                            <th>Uraian</th>
                            <th>Sub Uraian</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody id="tableBody">

                        <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                        <tr>

                            <td>
                                <div class="number-badge">
                                    <?php echo e($loop->iteration); ?>

                                </div>
                            </td>

                            <td>
                                <?php echo e($item->uraian->kategori->nama_kategori ?? '-'); ?>

                            </td>

                            <td>
                                <?php echo e($item->uraian->nama_uraian ?? '-'); ?>

                            </td>

                            <td>
                                <?php echo e($item->nama_sub_uraian); ?>

                            </td>

                            <td>
                                <div class="action-group">

                                    <a href="<?php echo e(route('master-data.sub-uraian.edit', $item->id)); ?>"
                                       class="btn-action btn-edit">

                                        <i data-feather="edit-2"></i>
                                        Edit

                                    </a>

                                    <form action="<?php echo e(route('master-data.sub-uraian.destroy', $item->id)); ?>"
                                          method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus data ini?')">

                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>

                                        <button type="submit"
                                                class="btn-action btn-delete">

                                            <i data-feather="trash-2"></i>
                                            Hapus

                                        </button>

                                    </form>

                                </div>
                            </td>

                        </tr>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                        <tr>
                            <td colspan="5" class="text-center py-5">
                                Belum Ada Data
                            </td>
                        </tr>

                        <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    feather.replace();

    const search = document.getElementById('searchInput');

    search.addEventListener('keyup', function(){

        let value = this.value.toLowerCase();

        document.querySelectorAll('#tableBody tr')
        .forEach(function(row){

            row.style.display =
                row.innerText.toLowerCase().includes(value)
                ? ''
                : 'none';

        });

    });

});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Downloads\simrsud-starterpack-main\resources\views/sub-uraian/index.blade.php ENDPATH**/ ?>