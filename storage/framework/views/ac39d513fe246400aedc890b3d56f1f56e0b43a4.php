

<?php $__env->startSection('title', 'Tambah Sub Uraian'); ?>

<?php $__env->startSection('breadcrumb-title'); ?>

<h3 class="fw-bold">
    Tambah Sub Uraian
</h3>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>

<li class="breadcrumb-item">
    Master Data
</li>

<li class="breadcrumb-item">
    <a href="<?php echo e(route('master-data.sub-uraian.index')); ?>">
        Sub Uraian
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

            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

                

                <div class="card-header bg-primary border-0 p-4">

                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                        <div class="text-white">

                            <h3 class="fw-bold mb-1">

                                Tambah Sub Uraian

                            </h3>

                            <span>

                                Tambahkan detail sub uraian inspeksi rumah sakit

                            </span>

                        </div>

                        <a href="<?php echo e(route('master-data.sub-uraian.index')); ?>"
                           class="btn btn-light rounded-3 px-4 py-2 fw-semibold">

                            <i data-feather="arrow-left"></i>

                            Kembali

                        </a>

                    </div>

                </div>

                

                <div class="card-body p-4 p-lg-5">

                    

                    <?php if($errors->any()): ?>

                        <div class="alert alert-danger border-0 rounded-3 shadow-sm">

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

                    

                    <form action="<?php echo e(route('master-data.sub-uraian.store')); ?>"
                          method="POST">

                        <?php echo csrf_field(); ?>

                        

                        <div class="mb-4">

                            <label class="form-label fw-semibold">

                                Pilih Uraian

                            </label>

                            <select name="uraian_id"
                                    class="form-select form-select-lg rounded-3 <?php $__errorArgs = ['uraian_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">

                                <option value="">
                                    -- Pilih Uraian --
                                </option>

                                <?php $__currentLoopData = $uraian; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <option value="<?php echo e($u->id); ?>"
                                        <?php echo e(old('uraian_id') == $u->id ? 'selected' : ''); ?>>

                                        <?php echo e($u->nama_uraian); ?>

                                        -
                                        <?php echo e($u->kategori->nama_kategori ?? '-'); ?>


                                    </option>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </select>

                            <?php $__errorArgs = ['uraian_id'];
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

                            <label class="form-label fw-semibold">

                                Nama Sub Uraian

                            </label>

                            <input type="text"
                                   name="nama_sub_uraian"
                                   class="form-control form-control-lg rounded-3 <?php $__errorArgs = ['nama_sub_uraian'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                   placeholder="Contoh : Dinding Bersih dan Tidak Retak"
                                   value="<?php echo e(old('nama_sub_uraian')); ?>">

                            <?php $__errorArgs = ['nama_sub_uraian'];
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

                        

                        <div class="d-flex flex-wrap gap-2">

                            <button type="submit"
                                    class="btn btn-primary rounded-3 px-4 py-2 fw-semibold">

                                <i data-feather="save"></i>

                                Simpan Data

                            </button>

                            <a href="<?php echo e(route('master-data.sub-uraian.index')); ?>"
                               class="btn btn-light rounded-3 px-4 py-2 fw-semibold border">

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
<?php echo $__env->make('layouts.dashboard.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Administrator\Documents\Project\RSUD\belajar ni\simrsud_k3rs\resources\views/sub-uraian/create.blade.php ENDPATH**/ ?>