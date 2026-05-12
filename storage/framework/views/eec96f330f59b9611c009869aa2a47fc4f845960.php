

<?php $__env->startSection('title', 'Data Sub Uraian'); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
<h3 class="fw-bold">Data Sub Uraian</h3>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>
<li class="breadcrumb-item">Master Data</li>
<li class="breadcrumb-item active">Sub Uraian</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="container-fluid">

    <div class="card border-0 shadow rounded-4 overflow-hidden">

        <!-- HEADER -->
        <div class="card-header bg-primary text-white p-4">

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                <div>

                    <h3 class="fw-bold mb-1">
                        Data Sub Uraian
                    </h3>

                    <small>
                        Kelola data sub uraian inspeksi rumah sakit
                    </small>

                </div>

                <a href="<?php echo e(route('master-data.sub-uraian.create')); ?>"
                   class="btn btn-light rounded-3 px-4 py-2 fw-semibold">

                    <i data-feather="plus-circle"></i>
                    Tambah Sub Uraian

                </a>

            </div>

        </div>

        <!-- BODY -->
        <div class="card-body p-4">

            <?php if(session('success')): ?>

                <div class="alert alert-success rounded-4 border-0 shadow-sm">
                    <?php echo e(session('success')); ?>

                </div>

            <?php endif; ?>

            <div class="mb-4">

                <input type="text"
                       id="searchSub"
                       class="form-control rounded-4"
                       placeholder="Cari sub uraian..."
                       style="padding:14px;">

            </div>

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-light">

                        <tr>

                            <th width="70">No</th>
                            <th>Kategori</th>
                            <th>Uraian</th>
                            <th>Sub Uraian</th>
                            <th width="220" class="text-center">
                                Aksi
                            </th>

                        </tr>

                    </thead>

                    <tbody id="subTable">

                        <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                            <tr>

                                <td>
                                    <?php echo e($loop->iteration); ?>

                                </td>

                                <td>

                                    <span class="badge bg-primary rounded-pill px-3 py-2">

                                        <?php echo e($item->uraian->kategori->nama_kategori ?? '-'); ?>


                                    </span>

                                </td>

                                <td>

                                    <?php echo e($item->uraian->nama_uraian ?? '-'); ?>


                                </td>

                                <td>

                                    <strong>
                                        <?php echo e($item->nama_sub_uraian); ?>

                                    </strong>

                                </td>

                                <td>

                                    <div class="d-flex justify-content-center gap-2">

                                        <!-- EDIT -->
                                        <button
                                            class="btn btn-warning rounded-3 d-flex align-items-center gap-1"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editModal<?php echo e($item->id); ?>">

                                            <i data-feather="edit-2"></i>
                                            Edit

                                        </button>

                                        <!-- DELETE -->
                                        <form action="<?php echo e(route('master-data.sub-uraian.destroy', $item->id)); ?>"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus data ini?')">

                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>

                                            <button type="submit"
                                                    class="btn btn-danger rounded-3 d-flex align-items-center gap-1">

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

                                    <div class="modal-content rounded-4 border-0">

                                        <div class="modal-header border-0">

                                            <h5 class="fw-bold">
                                                Edit Sub Uraian
                                            </h5>

                                            <button type="button"
                                                    class="btn-close"
                                                    data-bs-dismiss="modal"></button>

                                        </div>

                                        <form action="<?php echo e(route('master-data.sub-uraian.update', $item->id)); ?>"
                                              method="POST">

                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('PUT'); ?>

                                            <div class="modal-body">

                                                <div class="mb-3">

                                                    <label class="form-label">
                                                        Nama Sub Uraian
                                                    </label>

                                                    <input type="text"
                                                           name="nama_sub_uraian"
                                                           class="form-control rounded-3"
                                                           value="<?php echo e($item->nama_sub_uraian); ?>"
                                                           required>

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

                                <td colspan="5"
                                    class="text-center py-5 text-muted">

                                    <i data-feather="inbox"
                                       style="width:40px;height:40px;"></i>

                                    <p class="mt-2 mb-0">
                                        Belum ada data sub uraian
                                    </p>

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

    document.getElementById('searchSub')
    .addEventListener('keyup', function(){

        let value = this.value.toLowerCase();

        let rows = document.querySelectorAll('#subTable tr');

        rows.forEach(row => {

            row.style.display =
                row.innerText.toLowerCase().includes(value)
                ? ''
                : 'none';

        });

    });

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Downloads\simrsud-starterpack-main\resources\views/sub-uraian/index.blade.php ENDPATH**/ ?>