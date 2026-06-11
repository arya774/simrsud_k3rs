

<?php $__env->startSection('title', 'Data Ruangan'); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
<h3 class="fw-bold">Data Ruangan</h3>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>
<li class="breadcrumb-item">Master Data</li>
<li class="breadcrumb-item active">Ruangan</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<style>

    .main-card{
        border:none;
        border-radius:24px;
        overflow:hidden;
        background:#fff;
        box-shadow:0 10px 30px rgba(0,0,0,0.08);
    }

    .header-gradient{
        background:linear-gradient(135deg,#4f46e5,#2563eb);
        padding:30px;
        color:white;
    }

    .header-gradient h3{
        font-weight:700;
        margin-bottom:5px;
    }

    .btn-modern{
        border-radius:14px;
        padding:10px 18px;
        font-weight:600;
        transition:0.3s;
    }

    .btn-modern:hover{
        transform:translateY(-2px);
    }

    .search-box{
        border:none;
        background:#f1f5f9;
        border-radius:14px;
        padding:14px 16px;
    }

    .search-box:focus{
        background:#e2e8f0;
        box-shadow:none;
    }

    .table-modern{
        border-collapse:separate;
        border-spacing:0 14px;
    }

    .table-modern tbody tr{
        background:#fff;
        box-shadow:0 4px 15px rgba(0,0,0,0.05);
        border-radius:16px;
        transition:0.3s;
    }

    .table-modern tbody tr:hover{
        transform:translateY(-3px);
        box-shadow:0 8px 25px rgba(0,0,0,0.08);
    }

    .table-modern td,
    .table-modern th{
        border:none !important;
        vertical-align:middle;
        padding:18px;
    }

    .badge-number{
        width:36px;
        height:36px;
        border-radius:12px;
        background:#eef2ff;
        color:#4f46e5;
        display:flex;
        align-items:center;
        justify-content:center;
        font-weight:700;
    }

    .room-title{
        font-weight:700;
        color:#0f172a;
    }

    .action-group{
        display:flex;
        justify-content:center;
        gap:10px;
    }

    .btn-action{
        border:none;
        border-radius:12px;
        padding:10px 16px;
        display:flex;
        align-items:center;
        gap:6px;
        font-weight:600;
        transition:0.3s;
    }

    .btn-action:hover{
        transform:translateY(-2px);
    }

    .btn-edit{
        background:#facc15;
        color:#000;
    }

    .btn-delete{
        background:#ef4444;
        color:#fff;
    }

    .empty-state img{
        opacity:0.7;
    }

    .modal-content{
        border:none;
        border-radius:24px;
    }

    .form-control{
        border-radius:14px;
        padding:12px 14px;
    }

    .form-control:focus{
        box-shadow:none;
        border-color:#4f46e5;
    }

    @media(max-width:768px){

        .header-gradient{
            padding:22px;
        }

        .btn-modern{
            width:100%;
        }

        .action-group{
            flex-direction:column;
        }

        .btn-action{
            width:100%;
            justify-content:center;
        }

    }

</style>

<div class="container-fluid">

    <div class="main-card">

        <!-- HEADER -->
        <div class="header-gradient">

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                <div>

                    <h3>Data Ruangan</h3>

                    <small>
                        Kelola data ruangan inspeksi rumah sakit
                    </small>

                </div>

                <a href="<?php echo e(route('master-data.ruangan.create')); ?>"
                   class="btn btn-light btn-modern">

                    <i data-feather="plus-circle"></i>

                    Tambah Ruangan

                </a>

            </div>

        </div>

        <!-- BODY -->
        <div class="p-4">

            <?php if(session('success')): ?>

                <div class="alert alert-success border-0 rounded-4 shadow-sm alert-dismissible fade show">

                    <?php echo e(session('success')); ?>


                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="alert"></button>

                </div>

            <?php endif; ?>

            <!-- SEARCH -->
            <div class="mb-4">

                <input type="text"
                       id="searchRuangan"
                       class="form-control search-box"
                       placeholder="Cari ruangan atau lokasi...">

            </div>

            <!-- TABLE -->
            <div class="table-responsive">

                <table class="table table-modern align-middle">

                    <thead class="table-light">

                        <tr>

                            <th width="70">No</th>

                            <th>Nama Ruangan</th>

                            <th>Lokasi</th>

                            <th width="240" class="text-center">
                                Aksi
                            </th>

                        </tr>

                    </thead>

                    <tbody id="ruanganTable">

                        <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                            <tr>

                                <td>

                                    <div class="badge-number">

                                        <?php echo e($loop->iteration); ?>


                                    </div>

                                </td>

                                <td>

                                    <div class="room-title">

                                        <?php echo e($item->nama_ruangan); ?>


                                    </div>

                                </td>

                                <td>

                                    <?php echo e($item->lokasi ?? '-'); ?>


                                </td>

                                <td>

                                    <div class="action-group">

                                        <!-- EDIT -->
                                        <button
                                            class="btn-action btn-edit"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editModal<?php echo e($item->id); ?>">

                                            <i data-feather="edit-2"></i>

                                            Edit

                                        </button>

                                        <!-- DELETE -->
                                        <form action="<?php echo e(route('master-data.ruangan.destroy', $item->id)); ?>"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus data ini?')">

                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>

                                            <button type="submit"
                                                    class="btn-action btn-delete">

                                                <i data-feather="trash-2"></i>

                                                Hapus

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                            <!-- MODAL EDIT -->
                            <div class="modal fade"
                                 id="editModal<?php echo e($item->id); ?>"
                                 tabindex="-1">

                                <div class="modal-dialog modal-dialog-centered">

                                    <div class="modal-content">

                                        <div class="modal-header border-0">

                                            <h5 class="fw-bold">
                                                Edit Ruangan
                                            </h5>

                                            <button type="button"
                                                    class="btn-close"
                                                    data-bs-dismiss="modal"></button>

                                        </div>

                                        <form action="<?php echo e(route('master-data.ruangan.update', $item->id)); ?>"
                                              method="POST">

                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('PUT'); ?>

                                            <div class="modal-body">

                                                <div class="mb-3">

                                                    <label class="form-label fw-semibold">
                                                        Nama Ruangan
                                                    </label>

                                                    <input type="text"
                                                           name="nama_ruangan"
                                                           class="form-control"
                                                           value="<?php echo e($item->nama_ruangan); ?>"
                                                           required>

                                                </div>

                                                <div class="mb-3">

                                                    <label class="form-label fw-semibold">
                                                        Lokasi
                                                    </label>

                                                    <input type="text"
                                                           name="lokasi"
                                                           class="form-control"
                                                           value="<?php echo e($item->lokasi); ?>">

                                                </div>

                                            </div>

                                            <div class="modal-footer border-0">

                                                <button type="button"
                                                        class="btn btn-light rounded-3"
                                                        data-bs-dismiss="modal">

                                                    Batal

                                                </button>

                                                <button type="submit"
                                                        class="btn btn-primary rounded-3">

                                                    Update Data

                                                </button>

                                            </div>

                                        </form>

                                    </div>

                                </div>

                            </div>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                            <tr>

                                <td colspan="4">

                                    <div class="text-center py-5 text-muted empty-state">

                                        <i data-feather="inbox"
                                           style="width:50px;height:50px;"></i>

                                        <h5 class="mt-3 fw-bold">
                                            Belum Ada Data Ruangan
                                        </h5>

                                        <p class="mb-0">
                                            Silakan tambahkan ruangan terlebih dahulu
                                        </p>

                                    </div>

                                </td>

                            </tr>

                        <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<script>

    feather.replace();

    // SEARCH FILTER
    document.getElementById('searchRuangan')
    .addEventListener('keyup', function(){

        let value = this.value.toLowerCase();

        let rows = document.querySelectorAll('#ruanganTable tr');

        rows.forEach(row => {

            row.style.display =
                row.innerText.toLowerCase().includes(value)
                ? ''
                : 'none';

        });

    });

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Administrator\Documents\Project\RSUD\belajar ni\simrsud_k3rs\resources\views/ruangan/index.blade.php ENDPATH**/ ?>