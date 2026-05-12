

<?php $__env->startSection('title', 'Riwayat Inspeksi'); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
<h3>Riwayat Inspeksi</h3>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>
<li class="breadcrumb-item">Inspeksi</li>
<li class="breadcrumb-item active">Riwayat</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<style>
    .history-card{
        border:none;
        border-radius:24px;
        overflow:hidden;
        box-shadow:0 4px 25px rgba(0,0,0,0.06);
        background:#fff;
    }

    .history-header{
        background:linear-gradient(135deg,#0d6efd,#5b8cff);
        padding:30px;
        color:white;
    }

    .history-header h3{
        font-weight:700;
        margin-bottom:6px;
    }

    .table{
        margin-bottom:0;
    }

    .table thead th{
        background:#f8fafc;
        border:none;
        padding:18px;
        font-weight:700;
        color:#334155;
        white-space:nowrap;
    }

    .table tbody td{
        padding:18px;
        vertical-align:middle;
        border-color:#eef2f7;
        color:#334155;
    }

    .badge-custom{
        background:#e8f1ff;
        color:#0d6efd;
        padding:8px 14px;
        border-radius:12px;
        font-weight:600;
        font-size:13px;
    }

    .btn-detail{
        border-radius:12px;
        padding:8px 18px;
        font-weight:600;
    }

    .empty-box{
        padding:60px 20px;
        text-align:center;
    }

    .empty-box img{
        width:120px;
        opacity:.7;
        margin-bottom:20px;
    }

    .empty-title{
        font-size:20px;
        font-weight:700;
        color:#334155;
    }

    .empty-subtitle{
        color:#64748b;
        margin-top:8px;
    }

    @media(max-width:768px){
        .table thead th,
        .table tbody td{
            font-size:13px;
            padding:12px 10px;
        }
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">

            <div class="card history-card">

                <div class="history-header">
                    <h3>Riwayat Inspeksi</h3>
                    <span>Seluruh data inspeksi yang sudah pernah dilakukan</span>
                </div>

                <div class="card-body p-4">

                    <?php if(session('success')): ?>
                        <div class="alert alert-success border-0 rounded-4 shadow-sm">
                            <?php echo e(session('success')); ?>

                        </div>
                    <?php endif; ?>

                    <?php if($inspeksis->count() > 0): ?>

                        <div class="table-responsive">

                            <table class="table align-middle">

                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th>Tanggal</th>
                                        <th>Ruangan</th>
                                        <th>Petugas K3RS</th>
                                        <th>Petugas Ruangan</th>
                                        <th>Total Checklist</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <?php $__currentLoopData = $inspeksis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <tr>

                                            <td><?php echo e($loop->iteration); ?></td>

                                            <td>
                                                <span class="badge-custom">
                                                    <?php echo e(\Carbon\Carbon::parse($item->tanggal)->format('d M Y')); ?>

                                                </span>
                                            </td>

                                            <td>
                                                <strong>
                                                    <?php echo e($item->ruangan->nama_ruangan ?? '-'); ?>

                                                </strong>
                                            </td>

                                            <td>
                                                <?php echo e($item->nama_petugas_k3rs ?? '-'); ?>

                                            </td>

                                            <td>
                                                <?php echo e($item->nama_petugas_ruangan ?? '-'); ?>

                                            </td>

                                            <td>
                                                <?php
                                                    $jumlahJawaban = is_array($item->jawaban)
                                                        ? count($item->jawaban)
                                                        : 0;
                                                ?>

                                                <span class="badge-custom">
                                                    <?php echo e($jumlahJawaban); ?> Checklist
                                                </span>
                                            </td>

                                            <td class="text-center">
                                                <a href="<?php echo e(route('inspeksi.hasil', $item->id)); ?>"
                                                   class="btn btn-primary btn-detail">
                                                    <i data-feather="eye"></i>
                                                    Detail
                                                </a>
                                            </td>

                                        </tr>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </tbody>

                            </table>

                        </div>

                    <?php else: ?>

                        <div class="empty-box">
                            <img src="<?php echo e(asset('assets/images/dashboard/no-data.png')); ?>" alt="No Data">

                            <div class="empty-title">
                                Belum Ada Riwayat Inspeksi
                            </div>

                            <div class="empty-subtitle">
                                Data inspeksi yang sudah disimpan akan muncul di halaman ini
                            </div>
                        </div>

                    <?php endif; ?>

                </div>

            </div>

        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Downloads\simrsud-starterpack-main\resources\views/inspeksi/riwayat.blade.php ENDPATH**/ ?>