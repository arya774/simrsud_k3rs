

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

    .ruangan-header::after{
        content:'';
        position:absolute;
        width:140px;
        height:140px;
        border-radius:50%;
        background:rgba(255,255,255,0.05);
        bottom:-60px;
        left:-40px;
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
        position:relative;
        z-index:2;
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
        transform:translateY(-2px);
        color:#1d4ed8;
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
        transition:.3s;
    }

    .form-control:focus{
        border-color:#6366f1;
        box-shadow:0 0 0 5px rgba(99,102,241,0.12);
    }

    .form-control.is-invalid{
        border-color:#dc3545;
    }

    .invalid-feedback{
        display:block;
        margin-top:8px;
        font-size:13px;
    }

    .btn-simpan{
        height:56px;
        border:none;
        border-radius:18px;
        padding:0 32px;
        font-weight:700;
        background:linear-gradient(135deg,#2563eb,#7c3aed);
        transition:.3s;
    }

    .btn-simpan:hover{
        transform:translateY(-2px);
        box-shadow:0 12px 25px rgba(37,99,235,0.25);
    }

    .btn-batal{
        height:56px;
        border-radius:18px;
        padding:0 32px;
        font-weight:700;
        border:1px solid #dbe2ea;
        background:#fff;
        color:#475569;
        transition:.3s;
    }

    .btn-batal:hover{
        background:#f8fafc;
    }

    .alert{
        border:none;
        border-radius:18px;
    }

    @media(max-width:768px){

        .ruangan-header{
            padding:28px;
        }

        .ruangan-body{
            padding:28px;
        }

        .btn-kembali,
        .btn-simpan,
        .btn-batal{
            width:100%;
        }

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

                            <i data-feather="arrow-left"></i>

                            Kembali

                        </a>

                    </div>

                </div>

                

                <div class="ruangan-body">

                    <?php if($errors->any()): ?>

                        <div class="alert alert-danger shadow-sm">

                            <div class="fw-bold mb-2">

                                Terjadi kesalahan:

                            </div>

                            <ul class="mb-0 ps-3">

                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <li><?php echo e($error); ?></li>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </ul>

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
                                   class="form-control <?php $__errorArgs = ['nama_ruangan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                   placeholder="Contoh : Ruang Tulip"
                                   value="<?php echo e(old('nama_ruangan')); ?>">

                            <?php $__errorArgs = ['nama_ruangan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>

                                <div class="invalid-feedback">
                                    <?php echo e($message); ?>

                                </div>

                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                        </div>

                        

                        <div class="mb-4">

                            <label class="form-label">

                                Lokasi Ruangan

                            </label>

                            <input type="text"
                                   name="lokasi"
                                   class="form-control <?php $__errorArgs = ['lokasi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                   placeholder="Contoh : Lantai 2 Gedung A"
                                   value="<?php echo e(old('lokasi')); ?>">

                            <?php $__errorArgs = ['lokasi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>

                                <div class="invalid-feedback">
                                    <?php echo e($message); ?>

                                </div>

                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                        </div>

                        

                        <div class="d-flex flex-wrap gap-3">

                            <button type="submit"
                                    class="btn btn-primary btn-simpan">

                                <i data-feather="save"></i>

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
<?php echo $__env->make('layouts.dashboard.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\simrsud_k3rs-main\simrsud_k3rs\resources\views/ruangan/create.blade.php ENDPATH**/ ?>