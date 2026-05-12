

<?php $__env->startSection('title', 'Riwayat Inspeksi'); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
<h3>Riwayat Inspeksi</h3>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>
<li class="breadcrumb-item active">
    Riwayat
</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="container-fluid">

    <div class="row">

        <div class="col-12">

            <div class="card shadow-sm">

                <div class="card-header bg-white">

                    <h5 class="mb-0">
                        Data Riwayat Inspeksi
                    </h5>

                </div>

                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table table-bordered table-hover">

                            <thead class="table-light">

                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Ruangan</th>
                                </tr>

                            </thead>

                            <tbody>

                                <?php $__empty_1 = true; $__currentLoopData = $inspeksi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($item->tanggal_inspeksi ?? '-'); ?></td>
                                    <td><?php echo e($item->ruangan ?? '-'); ?></td>
                                </tr>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                                <tr>
                                    <td colspan="3" class="text-center text-muted">
                                        Belum ada data inspeksi
                                    </td>
                                </tr>

                                <?php endif; ?>

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\simrsud_k3rs-main\simrsud_k3rs\resources\views/inspeksi/riwayat.blade.php ENDPATH**/ ?>