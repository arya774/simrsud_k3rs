

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

    .sub-title{
        font-weight:500;
        color:#0f172a;
        font-size:14px;
    }

    .kategori-block{
        display:none;
    }

    .table td{
        color:#334155;
        vertical-align:middle;
    }

    .signature-box{
        border:2px dashed #cbd5e1;
        border-radius:16px;
        background:#fff;
        height:220px;
        position:relative;
        overflow:hidden;
    }

    .signature-box canvas{
        width:100% !important;
        height:220px !important;
    }

    .ttd-preview{
        margin-top:15px;
    }

    .ttd-preview img{
        max-width:100%;
        height:120px;
        object-fit:contain;
        border:1px solid #e2e8f0;
        border-radius:12px;
        padding:10px;
        background:#fff;
    }

</style>

<div class="container-fluid">

    
    <div class="card border-0 shadow-sm mb-3">

        <div class="card-body"
             style="background:#fef9c3;border-left:5px solid #eab308;">

            <h4 class="mb-0">
                Edit Inspeksi
            </h4>

            <small class="text-muted">
                Perbarui data inspeksi dengan checklist sesuai kategori
            </small>

        </div>

    </div>

    <form action="<?php echo e(route('inspeksi.update', $inspeksi->id)); ?>"
          method="POST">

        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        
        <div class="card border-0 shadow-sm mb-3">

            <div class="card-body">

                <div class="row g-3">

                    <div class="col-md-4">

                        <label class="form-label">
                            Tanggal
                        </label>

                        <input type="date"
                               name="tanggal"
                               class="form-control"
                               value="<?php echo e(optional($inspeksi->tanggal)->format('Y-m-d')); ?>">

                    </div>

                    <div class="col-md-4">

                        <label class="form-label">
                            Ruangan
                        </label>

                        <select name="ruangan_id"
                                class="form-select">

                            <?php $__currentLoopData = $ruangan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <option value="<?php echo e($r->id); ?>"
                                    <?php echo e($inspeksi->ruangan_id == $r->id ? 'selected' : ''); ?>>

                                    <?php echo e($r->nama_ruangan); ?>


                                </option>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </select>

                    </div>

                    <div class="col-md-4">

                        <label class="form-label">
                            Kategori
                        </label>

                        <select name="kategori_id"
                                id="kategoriSelect"
                                class="form-select">

                            <?php $__currentLoopData = $kategori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <option value="<?php echo e($k->id); ?>"
                                    <?php echo e($inspeksi->kategori_id == $k->id ? 'selected' : ''); ?>>

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

                <h5 class="mb-3 text-primary">
                    Checklist Inspeksi
                </h5>

                <?php $__currentLoopData = $kategori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <div class="kategori-block"
                         id="kategori-<?php echo e($k->id); ?>">

                        <div class="p-3 border rounded bg-light mb-3">

                            <div class="kategori-title">

                                <?php echo e($k->nama_kategori); ?>


                            </div>

                        </div>

                        <?php $__currentLoopData = $uraian->where('kategori_id', $k->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <div class="mb-3 p-3 border rounded bg-white">

                                <div class="uraian-title">

                                    <?php echo e($u->nama_uraian); ?>


                                </div>

                                <table class="table table-sm">

                                    <?php $__currentLoopData = $subUraian->where('uraian_id', $u->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <?php
                                            $jawaban = $inspeksi->jawaban[$s->id] ?? 'Baik';
                                        ?>

                                        <tr>

                                            <td width="60%">

                                                <span class="sub-title">

                                                    <?php echo e($s->nama_sub_uraian); ?>


                                                </span>

                                            </td>

                                            <td>

                                                <input type="radio"
                                                       name="jawaban[<?php echo e($s->id); ?>]"
                                                       value="Baik"
                                                       <?php echo e($jawaban === 'Baik' ? 'checked' : ''); ?>>

                                                Baik

                                            </td>

                                            <td>

                                                <input type="radio"
                                                       name="jawaban[<?php echo e($s->id); ?>]"
                                                       value="Tidak Baik"
                                                       <?php echo e($jawaban === 'Tidak Baik' ? 'checked' : ''); ?>>

                                                Tidak Baik

                                            </td>

                                        </tr>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </table>

                            </div>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </div>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>

        </div>

        
        <div class="card border-0 shadow-sm mb-3">

            <div class="card-body">

                <label class="form-label">
                    Keterangan
                </label>

                <textarea name="keterangan"
                          class="form-control"
                          rows="3"><?php echo e($inspeksi->keterangan); ?></textarea>

            </div>

        </div>

        
        <div class="card border-0 shadow-sm mb-3">

            <div class="card-body">

                <div class="row g-3">

                    <div class="col-md-6">

                        <label>
                            Petugas K3RS
                        </label>

                        <input type="text"
                               name="nama_petugas_k3rs"
                               class="form-control"
                               value="<?php echo e($inspeksi->nama_petugas_k3rs); ?>">

                    </div>

                    <div class="col-md-6">

                        <label>
                            Petugas Ruangan
                        </label>

                        <input type="text"
                               name="nama_petugas_ruangan"
                               class="form-control"
                               value="<?php echo e($inspeksi->nama_petugas_ruangan); ?>">

                    </div>

                </div>

            </div>

        </div>

        
        <div class="card border-0 shadow-sm mb-4">

            <div class="card-body">

                <h5 class="mb-4 text-primary">
                    Tanda Tangan
                </h5>

                <div class="row">

                    
                    <div class="col-md-6 mb-4">

                        <label class="form-label fw-bold">

                            TTD Petugas K3RS

                        </label>

                        <input type="hidden"
                               name="ttd_k3rs"
                               id="ttd_k3rs">

                        <div class="signature-box"
                             id="signature-k3rs">
                        </div>

                        <button type="button"
                                class="btn btn-danger btn-sm mt-3"
                                id="clear-k3rs">

                            Hapus TTD

                        </button>

                        <?php if($inspeksi->ttd_k3rs): ?>

                            <div class="ttd-preview">

                                <small class="text-muted">
                                    TTD Lama
                                </small>

                                <br>

                                <img src="<?php echo e($inspeksi->ttd_k3rs); ?>">

                            </div>

                        <?php endif; ?>

                    </div>

                    
                    <div class="col-md-6 mb-4">

                        <label class="form-label fw-bold">

                            TTD Petugas Ruangan

                        </label>

                        <input type="hidden"
                               name="ttd_ruangan"
                               id="ttd_ruangan">

                        <div class="signature-box"
                             id="signature-ruangan">
                        </div>

                        <button type="button"
                                class="btn btn-danger btn-sm mt-3"
                                id="clear-ruangan">

                            Hapus TTD

                        </button>

                        <?php if($inspeksi->ttd_ruangan): ?>

                            <div class="ttd-preview">

                                <small class="text-muted">
                                    TTD Lama
                                </small>

                                <br>

                                <img src="<?php echo e($inspeksi->ttd_ruangan); ?>">

                            </div>

                        <?php endif; ?>

                    </div>

                </div>

            </div>

        </div>

        <button class="btn btn-warning w-100">

            Update Inspeksi

        </button>

    </form>

</div>

<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>

<script>

    /*
    |--------------------------------------------------------------------------
    | FILTER KATEGORI
    |--------------------------------------------------------------------------
    */

    const select = document.getElementById('kategoriSelect');

    const blocks = document.querySelectorAll('.kategori-block');

    function showKategori(id){

        blocks.forEach(b => b.style.display = 'none');

        const target = document.getElementById('kategori-' + id);

        if(target){

            target.style.display = 'block';

        }

    }

    showKategori(select.value);

    select.addEventListener('change', function () {

        showKategori(this.value);

    });

    /*
    |--------------------------------------------------------------------------
    | SIGNATURE PAD K3RS
    |--------------------------------------------------------------------------
    */

    const canvasK3RS = document.createElement('canvas');

    document.getElementById('signature-k3rs')
        .appendChild(canvasK3RS);

    canvasK3RS.width =
        document.getElementById('signature-k3rs').offsetWidth;

    canvasK3RS.height = 220;

    const signaturePadK3RS = new SignaturePad(canvasK3RS);

    document.getElementById('clear-k3rs')
        .addEventListener('click', function () {

            signaturePadK3RS.clear();

            document.getElementById('ttd_k3rs').value = '';

        });

    /*
    |--------------------------------------------------------------------------
    | SIGNATURE PAD RUANGAN
    |--------------------------------------------------------------------------
    */

    const canvasRuangan = document.createElement('canvas');

    document.getElementById('signature-ruangan')
        .appendChild(canvasRuangan);

    canvasRuangan.width =
        document.getElementById('signature-ruangan').offsetWidth;

    canvasRuangan.height = 220;

    const signaturePadRuangan = new SignaturePad(canvasRuangan);

    document.getElementById('clear-ruangan')
        .addEventListener('click', function () {

            signaturePadRuangan.clear();

            document.getElementById('ttd_ruangan').value = '';

        });

    /*
    |--------------------------------------------------------------------------
    | SUBMIT
    |--------------------------------------------------------------------------
    */

    document.querySelector('form')
        .addEventListener('submit', function () {

            if (!signaturePadK3RS.isEmpty()) {

                document.getElementById('ttd_k3rs').value =
                    signaturePadK3RS.toDataURL();

            }

            if (!signaturePadRuangan.isEmpty()) {

                document.getElementById('ttd_ruangan').value =
                    signaturePadRuangan.toDataURL();

            }

        });

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Downloads\simrsud-starterpack-main\resources\views/inspeksi/edit.blade.php ENDPATH**/ ?>