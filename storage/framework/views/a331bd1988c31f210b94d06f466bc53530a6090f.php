

<?php $__env->startSection('title', 'Edit Sub Uraian'); ?>

<?php $__env->startSection('content'); ?>

<div class="container mt-4">

    <div class="card p-4">

        <h3>Edit Sub Uraian</h3>

        <form action="<?php echo e(route('master-data.sub-uraian.update', $subUraian->id)); ?>"
              method="POST">

            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="mb-3">
                <label>Uraian</label>

                <select name="uraian_id" class="form-control" required>
                    <?php $__currentLoopData = $uraian; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($u->id); ?>"
                            <?php echo e($subUraian->uraian_id == $u->id ? 'selected' : ''); ?>>
                            <?php echo e($u->nama_uraian); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="mb-3">
                <label>Sub Uraian</label>

                <input type="text"
                       name="nama_sub_uraian"
                       class="form-control"
                       value="<?php echo e($subUraian->nama_sub_uraian); ?>"
                       required>
            </div>

            <button type="submit" class="btn btn-primary">
                Update
            </button>

            <a href="<?php echo e(route('master-data.sub-uraian.index')); ?>"
               class="btn btn-secondary">
                Kembali
            </a>

        </form>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Downloads\simrsud-starterpack-main\resources\views/sub-uraian/edit.blade.php ENDPATH**/ ?>