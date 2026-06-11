

<?php $__env->startSection('title', 'Tambah Kategori'); ?>

<?php $__env->startSection('breadcrumb-title'); ?>

<h3>Tambah Kategori</h3>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>

<li class="breadcrumb-item">
    Master Data
</li>

<li class="breadcrumb-item">

    <a href="<?php echo e(route('master-data.kategori.index')); ?>">

        Kategori

    </a>

</li>

<li class="breadcrumb-item active">
    Tambah
</li>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="container-fluid">

    <div class="row justify-content-center">

        <div class="col-xl-8 col-lg-10">

            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

                <!-- HEADER -->
                <div class="card-header bg-primary border-0 p-4">

                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                        <div class="text-white">

                            <h3 class="fw-bold mb-1">

                                Tambah Kategori Inspeksi

                            </h3>

                            <span>

                                Tambahkan kategori baru untuk kebutuhan inspeksi rumah sakit

                            </span>

                        </div>

                        <!-- FIX ROUTE -->
                        <a href="<?php echo e(route('master-data.kategori.index')); ?>"
                           class="btn btn-light rounded-3 px-4 py-2 fw-semibold">

                            <i data-feather="arrow-left"></i>

                            Kembali

                        </a>

                    </div>

                </div>

                <!-- BODY -->
                <div class="card-body p-4">

                    <!-- ERROR VALIDATION -->
                    <?php if($errors->any()): ?>

                        <div class="alert alert-danger border-0 shadow-sm rounded-3">

                            <div class="fw-semibold mb-2">

                                Terjadi kesalahan:

                            </div>

                            <ul class="mb-0 ps-3">

                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <li><?php echo e($error); ?></li>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </ul>

                        </div>

                    <?php endif; ?>

                    <!-- FORM -->
                    <form action="<?php echo e(route('master-data.kategori.store')); ?>"
                          method="POST">

                        <?php echo csrf_field(); ?>

                        <div class="mb-4">

                            <label class="form-label fw-semibold">

                                Nama Kategori

                            </label>

                            <input type="text"
                                   name="nama_kategori"
                                   class="form-control form-control-lg rounded-3 <?php $__errorArgs = ['nama_kategori'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                   placeholder="Contoh : Kondisi Fisik Bangunan"
                                   value="<?php echo e(old('nama_kategori')); ?>"
                                   autocomplete="off">

                            <?php $__errorArgs = ['nama_kategori'];
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

                        <!-- BUTTON -->
                        <div class="d-flex flex-wrap gap-2">

                            <button type="submit"
                                    class="btn btn-primary rounded-3 px-4 py-2 fw-semibold">

                                <i data-feather="save"></i>

                                Simpan

                            </button>

                            <a href="<?php echo e(route('master-data.kategori.index')); ?>"
                               class="btn btn-light border rounded-3 px-4 py-2 fw-semibold">

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
<?php echo $__env->make('layouts.dashboard.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Administrator\Documents\Project\RSUD\belajar ni\simrsud_k3rs\resources\views/kategori/create.blade.php ENDPATH**/ ?>