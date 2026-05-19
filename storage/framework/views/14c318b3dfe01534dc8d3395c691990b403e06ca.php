

<?php $__env->startSection('title', 'NAMA APLIKASI - RSUD Kota Bogor'); ?>

<?php $__env->startSection('content'); ?>

<style>

    html,
    body{
        width:100%;
        height:100%;
        margin:0;
        padding:0;
        overflow:hidden;
        font-family:'Poppins',sans-serif;
    }

    *{
        box-sizing:border-box;
    }

    body{
        background:#020617;
    }

    /* ===================================
       BACKGROUND ANIMATION
    =================================== */

    .animated-bg{

        width:100%;
        min-height:100vh;

        display:flex;
        justify-content:center;
        align-items:center;

        position:relative;
        overflow:hidden;

        padding:20px;

        background:linear-gradient(
            -45deg,
            #020617,
            #1e1b4b,
            #7c3aed,
            #ec4899,
            #06b6d4,
            #2563eb
        );

        background-size:400% 400%;

        animation:bgAnimation 15s ease infinite;
    }

    @keyframes  bgAnimation{

        0%{
            background-position:0% 50%;
        }

        25%{
            background-position:50% 100%;
        }

        50%{
            background-position:100% 50%;
        }

        75%{
            background-position:50% 0%;
        }

        100%{
            background-position:0% 50%;
        }

    }

    /* ===================================
       GLOW EFFECT
    =================================== */

    .animated-bg::before{

        content:'';

        position:absolute;

        width:700px;
        height:700px;

        background:#8b5cf6;

        border-radius:50%;

        top:-250px;
        left:-150px;

        opacity:0.35;

        filter:blur(120px);

        animation:floating1 10s ease-in-out infinite;
    }

    .animated-bg::after{

        content:'';

        position:absolute;

        width:600px;
        height:600px;

        background:#06b6d4;

        border-radius:50%;

        bottom:-250px;
        right:-150px;

        opacity:0.35;

        filter:blur(120px);

        animation:floating2 12s ease-in-out infinite;
    }

    @keyframes  floating1{

        0%{
            transform:translateY(0px);
        }

        50%{
            transform:translateY(50px);
        }

        100%{
            transform:translateY(0px);
        }

    }

    @keyframes  floating2{

        0%{
            transform:translateY(0px);
        }

        50%{
            transform:translateY(-50px);
        }

        100%{
            transform:translateY(0px);
        }

    }

    /* ===================================
       LOGIN CARD
    =================================== */

    .login-box{

        position:relative;
        z-index:10;

        width:100%;
        max-width:430px;

        padding:42px 35px;

        border-radius:32px;

        background:rgba(255,255,255,0.12);

        backdrop-filter:blur(20px);

        border:1px solid rgba(255,255,255,0.18);

        box-shadow:
            0 10px 40px rgba(0,0,0,0.25);

        animation:fadeIn 1s ease;
    }

    @keyframes  fadeIn{

        from{
            opacity:0;
            transform:translateY(20px);
        }

        to{
            opacity:1;
            transform:translateY(0);
        }

    }

    /* ===================================
       LOGO AREA
    =================================== */

    .logo-area{
        text-align:center;
        margin-bottom:32px;
    }

    .logo-wrapper{

        width:125px;
        height:125px;

        margin:0 auto 22px auto;

        display:flex;
        justify-content:center;
        align-items:center;

        border-radius:50%;

        background:rgba(255,255,255,0.14);

        backdrop-filter:blur(12px);

        border:1px solid rgba(255,255,255,0.22);

        box-shadow:
            0 0 25px rgba(255,255,255,0.15),
            0 0 60px rgba(139,92,246,0.35);

        animation:logoFloat 4s ease-in-out infinite;

        overflow:hidden;
    }

    .logo-rs{

        width:82px;
        height:82px;

        object-fit:cover;

        border-radius:50%;

        background:white;

        padding:5px;

        border:3px solid rgba(255,255,255,0.7);

        box-shadow:
            0 0 20px rgba(255,255,255,0.35),
            0 0 40px rgba(139,92,246,0.35);

        filter:
            drop-shadow(0 0 10px rgba(255,255,255,0.4));

        transition:0.3s;
    }

    .logo-rs:hover{

        transform:scale(1.05);
    }

    @keyframes  logoFloat{

        0%{
            transform:translateY(0px);
        }

        50%{
            transform:translateY(-10px);
        }

        100%{
            transform:translateY(0px);
        }

    }

    .logo-area h2{

        margin:0;

        color:white;

        font-size:32px;
        font-weight:800;

        letter-spacing:1px;

        text-shadow:
            0 0 10px rgba(255,255,255,0.2);
    }

    .logo-area p{

        margin-top:6px;

        color:rgba(255,255,255,0.8);

        font-size:14px;

        letter-spacing:1px;
    }

    /* ===================================
       TITLE
    =================================== */

    .login-title{

        text-align:center;

        margin-bottom:28px;

        color:white;

        font-size:28px;
        font-weight:700;
    }

    /* ===================================
       FORM
    =================================== */

    .form-group{
        margin-bottom:20px;
    }

    .form-group label{

        display:block;

        margin-bottom:8px;

        color:white;

        font-weight:600;

        font-size:14px;
    }

    .form-control{

        width:100%;
        height:56px;

        border:none;

        border-radius:16px;

        padding:0 18px;

        background:rgba(255,255,255,0.16);

        color:white;

        font-size:15px;

        transition:0.3s;
    }

    .form-control::placeholder{
        color:rgba(255,255,255,0.7);
    }

    .form-control:focus{

        outline:none;

        background:rgba(255,255,255,0.24);

        box-shadow:
            0 0 0 3px rgba(255,255,255,0.12);
    }

    /* ===================================
       BUTTON
    =================================== */

    .btn-login{

        width:100%;
        height:56px;

        border:none;

        border-radius:16px;

        margin-top:12px;

        color:white;

        font-size:16px;
        font-weight:700;

        cursor:pointer;

        background:linear-gradient(
            135deg,
            #3b82f6,
            #8b5cf6,
            #ec4899
        );

        background-size:300% 300%;

        animation:buttonGradient 5s ease infinite;

        transition:0.3s;
    }

    @keyframes  buttonGradient{

        0%{
            background-position:0% 50%;
        }

        50%{
            background-position:100% 50%;
        }

        100%{
            background-position:0% 50%;
        }

    }

    .btn-login:hover{

        transform:translateY(-2px);

        box-shadow:
            0 10px 25px rgba(0,0,0,0.25);
    }

    /* ===================================
       ALERT
    =================================== */

    .alert-success-custom{

        background:rgba(34,197,94,0.15);

        color:#dcfce7;

        padding:12px;

        border-radius:12px;

        margin-bottom:15px;

        border:1px solid rgba(255,255,255,0.1);
    }

    .alert-danger-custom{

        background:rgba(239,68,68,0.15);

        color:#fee2e2;

        padding:12px;

        border-radius:12px;

        margin-bottom:15px;

        border:1px solid rgba(255,255,255,0.1);
    }

    .alert-danger-custom ul{
        margin:0;
        padding-left:18px;
    }

    /* ===================================
       MOBILE
    =================================== */

    @media(max-width:576px){

        .login-box{
            padding:30px 22px;
            border-radius:24px;
        }

        .logo-wrapper{
            width:105px;
            height:105px;
        }

        .logo-rs{
            width:70px;
            height:70px;
        }

        .logo-area h2{
            font-size:24px;
        }

        .login-title{
            font-size:22px;
        }

    }

</style>

<div class="animated-bg">

    <div class="login-box">

        <div class="logo-area">

            <div class="logo-wrapper">

                <img
                    src="<?php echo e(asset('assets/images/logo/logo-rsud.png')); ?>"
                    alt="Logo RSUD"
                    class="logo-rs"
                >

            </div>

            <h2>NAMA APLIKASI</h2>

            <p>RSUD KOTA BOGOR</p>

        </div>

        <form
            class="theme-form"
            action="<?php echo e(route('login.store')); ?>"
            method="POST"
        >

            <?php echo csrf_field(); ?>

            <h4 class="login-title">
                Masuk ke Sistem
            </h4>

            <?php if(session('status')): ?>
                <div class="alert-success-custom">
                    <?php echo e(session('status')); ?>

                </div>
            <?php endif; ?>

            <?php if($errors->any()): ?>
                <div class="alert-danger-custom">
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($e); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="form-group">

                <label>Username</label>

                <input
                    type="text"
                    name="email"
                    class="form-control"
                    placeholder="Masukkan username"
                    required
                >

            </div>

            <div class="form-group">

                <label>Password</label>

                <input
                    type="password"
                    name="password"
                    class="form-control"
                    placeholder="Masukkan password"
                    required
                >

            </div>

            <button type="submit" class="btn-login">
                Masuk
            </button>

        </form>

    </div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.authentication.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Downloads\simrsud-starterpack-main\resources\views/auth/login.blade.php ENDPATH**/ ?>