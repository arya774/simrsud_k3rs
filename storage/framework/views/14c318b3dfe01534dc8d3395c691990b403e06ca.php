<?php $__env->startSection('title', 'NAMA APLIKASI - RSUD Kota Bogor'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid p-0">
    <div class="row m-0">
        <div class="col-12 p-0">
            <div class="login-card" style="min-height: 100vh; display:flex; align-items:center; justify-content:center; background: linear-gradient(135deg,#e9f2ff,#f7f9fc);">
                
                <div style="width:100%; max-width:420px; padding:30px; background:#fff; border-radius:16px; box-shadow:0 10px 30px rgba(0,0,0,0.08);">

                    <div style="text-align:center; margin-bottom:20px;">
                        <img class="img-fluid mb-3" style="max-width:90px;" src="<?php echo e(asset('assets/images/logo/logo-rsud.png')); ?>" alt="logorsud">

                        <h4 style="margin:0;">NAMA APLIKASI</h4>
                        <small style="color:#666;">RSUD KOTA BOGOR</small>
                    </div>

                    <div class="login-main">

                        <form class="theme-form" action="<?php echo e(route('login.store')); ?>" method="post">

                            <?php echo csrf_field(); ?>

                            <h4 style="text-align:center; margin-bottom:20px;">Masuk ke Sistem</h4>

                            <?php if(session('status')): ?>
                                <div style="background:#e6ffed; color:#1b7f3b; padding:10px; border-radius:8px; margin-bottom:10px;">
                                    <?php echo e(session('status')); ?>

                                </div>
                            <?php endif; ?>

                            <?php if($errors->any()): ?>
                                <div style="background:#ffe6e6; color:#a30000; padding:10px; border-radius:8px; margin-bottom:10px;">
                                    <ul style="margin:0; padding-left:18px;">
                                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li><?php echo e($e); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            <?php endif; ?>

                            <div class="form-group" style="margin-bottom:15px;">
                                <label style="font-weight:600;">Username</label>
                                <input class="form-control" type="text" name="email" placeholder="Masukkan username" required
                                    style="padding:10px; border-radius:8px;">
                            </div>

                            <div class="form-group" style="margin-bottom:20px;">
                                <label style="font-weight:600;">Password</label>
                                <input class="form-control" type="password" name="password" placeholder="Masukkan password" required
                                    style="padding:10px; border-radius:8px;">
                            </div>

                            <button type="submit"
                                style="width:100%; padding:12px; border:none; border-radius:8px; background:#0d6efd; color:#fff; font-weight:600;">
                                Masuk
                            </button>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.authentication.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Downloads\simrsud-starterpack-main\resources\views/auth/login.blade.php ENDPATH**/ ?>