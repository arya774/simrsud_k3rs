

<?php $__env->startSection('title', 'Tambah Uraian'); ?>

<?php $__env->startSection('breadcrumb-title'); ?>

<h3>Tambah Uraian</h3>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>

<li class="breadcrumb-item">
    Master Data
</li>

<li class="breadcrumb-item">
    <a href="<?php echo e(route('master-data.uraian.index')); ?>">
        Uraian
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

                <div class="card-header bg-primary border-0 p-4">

                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                        <div class="text-white">

                            <h3 class="fw-bold mb-1">

                                Tambah Uraian Inspeksi

                            </h3>

                            <span>

                                Tambahkan uraian baru untuk kebutuhan inspeksi rumah sakit

                            </span>

                        </div>

                        <a href="<?php echo e(route('master-data.uraian.index')); ?>"
                           class="btn btn-light rounded-3 px-4 py-2 fw-semibold">

                            <i data-feather="arrow-left"></i>

                            Kembali

                        </a>

                    </div>

                </div>

                <div class="card-body p-4">

                    <?php if($errors->any()): ?>

                        <div class="alert alert-danger rounded-3 border-0 shadow-sm">

                            <ul class="mb-0">

                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <li><?php echo e($error); ?></li>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </ul>

                        </div>

                    <?php endif; ?>

                    <form action="<?php echo e(route('master-data.uraian.store')); ?>"
                          method="POST">

                        <?php echo csrf_field(); ?>

                        <div class="mb-4">

                            <label class="form-label fw-semibold">

                                Pilih Kategori

                            </label>

                            <select name="kategori_id"
                                    class="form-select form-select-lg rounded-3">

                                <option value="">
                                    -- Pilih Kategori --
                                </option>

                                <?php $__currentLoopData = $kategori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <option value="<?php echo e($item->id); ?>"
                                        <?php echo e(old('kategori_id') == $item->id ? 'selected' : ''); ?>>

                                        <?php echo e($item->nama_kategori); ?>


                                    </option>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </select>

                        </div>

                        <div class="mb-4">

                            <label class="form-label fw-semibold">

                                Nama Uraian

                            </label>

                            <input type="text"
                                   name="nama_uraian"
                                   class="form-control form-control-lg rounded-3"
                                   placeholder="Contoh : Kondisi Dinding"
                                   value="<?php echo e(old('nama_uraian')); ?>">

                        </div>

                        <div class="d-flex flex-wrap gap-2">

                            <button type="submit"
                                    class="btn btn-primary rounded-3 px-4 py-2 fw-semibold">

                                <i data-feather="save"></i>

                                Simpan

                            </button>

                            <a href="<?php echo e(route('master-data.uraian.index')); ?>"
                               class="btn btn-light rounded-3 px-4 py-2 fw-semibold">

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
<?php echo $__env->make('layouts.dashboard.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Downloads\simrsud-starterpack-main\resources\views/uraian/create.blade.php ENDPATH**/ ?>