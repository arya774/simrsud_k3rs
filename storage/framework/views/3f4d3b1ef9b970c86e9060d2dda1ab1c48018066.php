

<?php $__env->startSection('title', 'Laporan Inspeksi'); ?>

<?php $__env->startSection('content'); ?>

<div class="container-fluid">

    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Laporan Inspeksi</h2>
            <p class="text-muted mb-0">
                Kelola dan cetak laporan inspeksi rumah sakit
            </p>
        </div>
    </div>

    
    <div class="card border-0 shadow-sm overflow-hidden mb-4">

        
        <div class="p-4 text-white"
             style="background: linear-gradient(90deg,#6c63ff,#6f4ef2);">

            <div class="d-flex justify-content-between align-items-center">

                <div>
                    <h3 class="fw-bold mb-1">
                        Filter Laporan
                    </h3>

                    <small>
                        Filter data laporan inspeksi rumah sakit
                    </small>
                </div>

                <div>
                    <i class="fas fa-file-alt fa-2x"></i>
                </div>

            </div>

        </div>

        
        <div class="card-body">

            <form method="GET"
                  action="<?php echo e(route('laporan.inspeksi')); ?>">

                <div class="row">

                    
                    <div class="col-md-3 mb-3">

                        <label class="form-label fw-semibold">
                            Dari Tanggal
                        </label>

                        <input type="date"
                               name="dari"
                               value="<?php echo e(request('dari')); ?>"
                               class="form-control">

                    </div>

                    
                    <div class="col-md-3 mb-3">

                        <label class="form-label fw-semibold">
                            Sampai Tanggal
                        </label>

                        <input type="date"
                               name="sampai"
                               value="<?php echo e(request('sampai')); ?>"
                               class="form-control">

                    </div>

                    
                    <div class="col-md-3 mb-3">

                        <label class="form-label fw-semibold">
                            Ruangan
                        </label>

                        <select name="ruangan_id"
                                class="form-control">

                            <option value="">
                                Semua
                            </option>

                            <?php $__currentLoopData = $ruangan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <option value="<?php echo e($r->id); ?>"
                                    <?php echo e(request('ruangan_id') == $r->id ? 'selected' : ''); ?>>

                                    <?php echo e($r->nama_ruangan); ?>


                                </option>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </select>

                    </div>

                    
                    <div class="col-md-3 mb-3">

                        <label class="form-label fw-semibold">
                            Kategori
                        </label>

                        <select name="kategori_id"
                                class="form-control">

                            <option value="">
                                Semua
                            </option>

                            <?php $__currentLoopData = $kategori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <option value="<?php echo e($k->id); ?>"
                                    <?php echo e(request('kategori_id') == $k->id ? 'selected' : ''); ?>>

                                    <?php echo e($k->nama_kategori); ?>


                                </option>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </select>

                    </div>

                </div>

                
                <div class="mt-2 d-flex gap-2">

                    <button type="submit"
                            class="btn text-white"
                            style="background:#6c63ff;">

                        <i class="fas fa-search"></i>
                        Filter

                    </button>

                    <a href="<?php echo e(route('laporan.inspeksi')); ?>"
                       class="btn btn-secondary">

                        <i class="fas fa-rotate-left"></i>
                        Reset

                    </a>

                    <a href="<?php echo e(route('laporan.inspeksi.pdf', request()->all())); ?>"
                       class="btn btn-danger">

                        <i class="fas fa-file-pdf"></i>
                        Cetak PDF

                    </a>

                </div>

            </form>

        </div>

    </div>

    
    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table align-middle">

                    <thead style="background:#f8f9fc;">
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Ruangan</th>
                            <th>Kategori</th>
                            <th class="text-center">Hasil</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php $__empty_1 = true; $__currentLoopData = $inspeksi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                        <tr>

                            <td>
                                <?php echo e($loop->iteration); ?>

                            </td>

                            <td>
                                <?php echo e(\Carbon\Carbon::parse($i->tanggal)->format('d-m-Y')); ?>

                            </td>

                            <td>
                                <?php echo e($i->ruangan->nama_ruangan ?? '-'); ?>

                            </td>

                            <td>

                                <span class="badge rounded-pill"
                                      style="background:#6c63ff;">

                                    <?php echo e($i->kategori->nama_kategori ?? '-'); ?>


                                </span>

                            </td>

                            <td class="text-center">

                                <span class="badge bg-success">

                                    <?php echo e($i->hasil ?? 0); ?>%

                                </span>

                            </td>

                        </tr>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                        <tr>

                            <td colspan="5"
                                class="text-center text-muted py-4">

                                Tidak ada data laporan inspeksi

                            </td>

                        </tr>

                        <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Downloads\simrsud-starterpack-main\resources\views/laporan/inspeksi.blade.php ENDPATH**/ ?>