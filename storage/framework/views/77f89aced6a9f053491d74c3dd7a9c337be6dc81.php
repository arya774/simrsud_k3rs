

<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
<h3>Dashboard</h3>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="container-fluid">

    <div class="row g-3">

        <!-- KATEGORI -->
        <div class="col-xl-3 col-sm-6">

            <div class="card o-hidden border-0 shadow-sm">

                <div class="card-body bg-primary text-white">

                    <div class="d-flex align-items-center justify-content-between">

                        <div>
                            <span>Kategori</span>
                            <h3 class="mb-0">
                                <?php echo e($totalKategori ?? 0); ?>

                            </h3>
                        </div>

                        <div>
                            <i data-feather="layers" style="width:32px;height:32px;"></i>
                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- SUB URAIAN -->
        <div class="col-xl-3 col-sm-6">

            <div class="card o-hidden border-0 shadow-sm">

                <div class="card-body bg-secondary text-white">

                    <div class="d-flex align-items-center justify-content-between">

                        <div>
                            <span>Sub Uraian</span>
                            <h3 class="mb-0">
                                <?php echo e($totalSubUraian ?? 0); ?>

                            </h3>
                        </div>

                        <div>
                            <i data-feather="file-text" style="width:32px;height:32px;"></i>
                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- RUANGAN -->
        <div class="col-xl-3 col-sm-6">

            <div class="card o-hidden border-0 shadow-sm">

                <div class="card-body bg-success text-white">

                    <div class="d-flex align-items-center justify-content-between">

                        <div>
                            <span>Ruangan</span>
                            <h3 class="mb-0">
                                <?php echo e($totalRuangan ?? 0); ?>

                            </h3>
                        </div>

                        <div>
                            <i data-feather="map-pin" style="width:32px;height:32px;"></i>
                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- INSPEKSI -->
        <div class="col-xl-3 col-sm-6">

            <div class="card o-hidden border-0 shadow-sm">

                <div class="card-body bg-warning text-dark">

                    <div class="d-flex align-items-center justify-content-between">

                        <div>
                            <span>Inspeksi</span>
                            <h3 class="mb-0">
                                <?php echo e($totalInspeksi ?? 0); ?>

                            </h3>
                        </div>

                        <div>
                            <i data-feather="check-circle" style="width:32px;height:32px;"></i>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\simrsud_k3rs-main\simrsud_k3rs\resources\views/dashboard.blade.php ENDPATH**/ ?>