

<?php $__env->startSection('title', 'Edit Uraian'); ?>

<?php $__env->startSection('content'); ?>

<div class="container mt-4">

    <div class="card p-4">

        <h3>Edit Uraian</h3>

        <form action="<?php echo e(route('master-data.uraian.update', $uraian->id)); ?>"
              method="POST">

            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="mb-3">
                <label>Kategori</label>

                <select name="kategori_id"
                        class="form-control"
                        required>

                    <?php $__currentLoopData = $kategori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($k->id); ?>"
                            <?php echo e($uraian->kategori_id == $k->id ? 'selected' : ''); ?>>
                            <?php echo e($k->nama_kategori); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </select>
            </div>

            <div class="mb-3">
                <label>Nama Uraian</label>

                <input type="text"
                       name="nama_uraian"
                       class="form-control"
                       value="<?php echo e($uraian->nama_uraian); ?>"
                       required>
            </div>

            <button type="submit" class="btn btn-primary">
                Update
            </button>

            <a href="<?php echo e(route('master-data.uraian.index')); ?>"
               class="btn btn-secondary">
                Kembali
            </a>

        </form>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Administrator\Documents\Project\RSUD\belajar ni\simrsud_k3rs\resources\views/uraian/edit.blade.php ENDPATH**/ ?>