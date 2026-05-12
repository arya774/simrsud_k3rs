

<?php $__env->startSection('title', 'Tambah Ruangan'); ?>

<?php $__env->startSection('breadcrumb-title'); ?>

<h3 class="fw-bold">
    Tambah Ruangan
</h3>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>

<li class="breadcrumb-item">
    Master Data
</li>

<li class="breadcrumb-item">
    <a href="<?php echo e(route('master-data.ruangan.index')); ?>">
        Ruangan
    </a>
</li>

<li class="breadcrumb-item active">
    Tambah
</li>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<style>

    .ruangan-card{
        border:none;
        border-radius:28px;
        overflow:hidden;
        background:#ffffff;
        box-shadow:0 15px 40px rgba(15,23,42,0.08);
    }

    .ruangan-header{
        background:linear-gradient(135deg,#2563eb,#7c3aed);
        padding:40px;
        position:relative;
        overflow:hidden;
    }

    .ruangan-header::before{
        content:'';
        position:absolute;
        width:220px;
        height:220px;
        border-radius:50%;
        background:rgba(255,255,255,0.08);
        top:-80px;
        right:-70px;
    }

    .ruangan-title{
        position:relative;
        z-index:2;
    }

    .ruangan-title h3{
        color:#fff;
        font-weight:700;
        margin-bottom:8px;
    }

    .ruangan-title p{
        color:rgba(255,255,255,0.88);
        margin-bottom:0;
    }

    .btn-kembali{
        background:#fff;
        color:#2563eb;
        border:none;
        border-radius:16px;
        padding:12px 22px;
        font-weight:600;
        transition:.3s;
    }

    .btn-kembali:hover{
        background:#f8fafc;
        color:#1d4ed8;
        transform:translateY(-2px);
    }

    .ruangan-body{
        padding:40px;
    }

    .form-label{
        font-weight:700;
        color:#334155;
        margin-bottom:10px;
    }

    .form-control{
        height:58px;
        border-radius:18px;
        border:1px solid #dbe2ea;
        padding:0 18px;
        font-size:15px;
    }

    .form-control:focus{
        border-color:#6366f1;
        box-shadow:0 0 0 5px rgba(99,102,241,0.12);
    }

    .btn-simpan{
        height:56px;
        border:none;
        border-radius:18px;
        padding:0 32px;
        font-weight:700;
        background:linear-gradient(135deg,#2563eb,#7c3aed);
    }

    .btn-batal{
        height:56px;
        border-radius:18px;
        padding:0 32px;
        font-weight:700;
        border:1px solid #dbe2ea;
        background:#fff;
        color:#475569;
    }

    .alert{
        border:none;
        border-radius:18px;
    }

</style>

<div class="container-fluid">

    <div class="row justify-content-center">

        <div class="col-xl-8 col-lg-10">

            <div class="card ruangan-card">

                
                <div class="ruangan-header">

                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                        <div class="ruangan-title">

                            <h3>
                                Tambah Ruangan
                            </h3>

                            <p>
                                Tambahkan data ruangan inspeksi rumah sakit
                            </p>

                        </div>

                        <a href="<?php echo e(route('master-data.ruangan.index')); ?>"
                           class="btn btn-kembali">

                            ← Kembali

                        </a>

                    </div>

                </div>

                
                <div class="ruangan-body">

                    
                    <?php if($errors->any()): ?>

                        <div class="alert alert-danger mb-4">

                            <strong>
                                Terjadi Error:
                            </strong>

                            <ul class="mb-0 mt-2">

                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <li><?php echo e($error); ?></li>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </ul>

                        </div>

                    <?php endif; ?>

                    
                    <?php if(session('success')): ?>

                        <div class="alert alert-success mb-4">

                            <?php echo e(session('success')); ?>


                        </div>

                    <?php endif; ?>

                    
                    <form action="<?php echo e(route('master-data.ruangan.store')); ?>"
                          method="POST">

                        <?php echo csrf_field(); ?>

                        
                        <div class="mb-4">

                            <label class="form-label">
                                Nama Ruangan
                            </label>

                            <input type="text"
                                   name="nama_ruangan"
                                   class="form-control"
                                   placeholder="Contoh : Ruang Tulip"
                                   value="<?php echo e(old('nama_ruangan')); ?>"
                                   required>

                        </div>

                        
                        <div class="mb-4">

                            <label class="form-label">
                                Lokasi Ruangan
                            </label>

                            <input type="text"
                                   name="lokasi"
                                   class="form-control"
                                   placeholder="Contoh : Lantai 2 Gedung A"
                                   value="<?php echo e(old('lokasi')); ?>"
                                   required>

                        </div>

                        
                        <div class="d-flex flex-wrap gap-3">

                            <button type="submit"
                                    class="btn btn-primary btn-simpan">

                                Simpan Data

                            </button>

                            <a href="<?php echo e(route('master-data.ruangan.index')); ?>"
                               class="btn btn-batal">

                                Batal

                            </a>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Downloads\simrsud-starterpack-main\resources\views/ruangan/create.blade.php ENDPATH**/ ?>