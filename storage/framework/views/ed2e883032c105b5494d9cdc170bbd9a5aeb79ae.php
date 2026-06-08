

<?php $__env->startSection('title', 'Edit Inspeksi'); ?>

<?php $__env->startSection('content'); ?>

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

    <form action="<?php echo e(route('inspeksi.update', $inspeksi->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-body">
                <div class="row g-3">

                    
                    <div class="col-md-4">
                        <label class="form-label">Tanggal</label>

                        <input type="date"
                               class="form-control"
                               value="<?php echo e(optional($inspeksi->tanggal)->format('Y-m-d')); ?>"
                               readonly>

                        <input type="hidden"
                               name="tanggal"
                               value="<?php echo e(optional($inspeksi->tanggal)->format('Y-m-d')); ?>">
                    </div>

                    
                    <div class="col-md-4">
                        <label class="form-label">Ruangan</label>
                        <select name="ruangan_id" class="form-select">
                            <?php $__currentLoopData = $ruangan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($r->id); ?>" <?php echo e($inspeksi->ruangan_id == $r->id ? 'selected' : ''); ?>>
                                    <?php echo e($r->nama_ruangan); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    
                    <div class="col-md-4">
                        <label class="form-label">Kategori</label>
                        <select name="kategori_id" id="kategoriSelect" class="form-select">
                            <?php $__currentLoopData = $kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($k->id); ?>" <?php echo e($inspeksi->kategori_id == $k->id ? 'selected' : ''); ?>>
                                    <?php echo e($k->nama_kategori); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                </div>
            </div>
        </div>

        
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-body">
                <h5 class="mb-3 text-primary">Checklist Inspeksi</h5>

                <?php $__currentLoopData = $kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="kategori-block" id="kategori-<?php echo e($k->id); ?>">

                    <div class="p-3 border rounded bg-light mb-3">
                        <div class="kategori-title"><?php echo e($k->nama_kategori); ?></div>
                    </div>

                    <?php $__currentLoopData = $k->subUraians; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $su): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="mb-3 p-3 border rounded bg-white">

                        <div class="uraian-title">
                            <?php echo e($su->uraian->nama_uraian ?? '-'); ?>

                        </div>

                        <table class="table table-sm">
                            <tr>
                                <td width="60%">
                                    <?php echo e($su->nama_sub_uraian); ?>

                                </td>

                                <?php
                                    $jawaban = $inspeksi->jawaban[$su->id] ?? 'Baik';
                                ?>

                                <td>
                                    <input type="radio"
                                           name="jawaban[<?php echo e($su->id); ?>]"
                                           value="Baik"
                                           <?php echo e($jawaban === 'Baik' ? 'checked' : ''); ?>>
                                    Baik
                                </td>

                                <td>
                                    <input type="radio"
                                           name="jawaban[<?php echo e($su->id); ?>]"
                                           value="Tidak Baik"
                                           <?php echo e($jawaban === 'Tidak Baik' ? 'checked' : ''); ?>>
                                    Tidak Baik
                                </td>
                            </tr>
                        </table>

                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>
        </div>

        
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-body">
                <label class="form-label">Keterangan</label>
                <textarea name="keterangan" class="form-control" rows="3">
                    <?php echo e($inspeksi->keterangan); ?>

                </textarea>
            </div>
        </div>

        
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label>Petugas K3RS</label>
                        <input type="text" name="nama_petugas_k3rs"
                               class="form-control"
                               value="<?php echo e($inspeksi->nama_petugas_k3rs); ?>">
                    </div>
                    <div class="col-md-6">
                        <label>Petugas Ruangan</label>
                        <input type="text" name="nama_petugas_ruangan"
                               class="form-control"
                               value="<?php echo e($inspeksi->nama_petugas_ruangan); ?>">
                    </div>
                </div>
            </div>
        </div>

        
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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Administrator\Documents\Project\RSUD\belajar ni\simrsud_k3rs\resources\views/inspeksi/edit.blade.php ENDPATH**/ ?>