<!DOCTYPE html>
<html lang="en">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token"
          content="<?php echo e(csrf_token()); ?>">

    <link rel="icon"
          href="<?php echo e(asset('assets/images/logo/logo-rsud.png')); ?>"
          type="image/x-icon">

    <link rel="shortcut icon"
          href="<?php echo e(asset('assets/images/logo/logo-rsud.png')); ?>"
          type="image/x-icon">

    <title>

        <?php echo $__env->yieldContent('title'); ?>

    </title>

    <!-- GOOGLE FONT -->

    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&display=swap"
          rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&display=swap"
          rel="stylesheet">

    <!-- RESPONSIVE FIX -->

    <style>

        *{
            box-sizing:border-box;
        }

        html,
        body{
            overflow-x:hidden;
            background:#f5f7fb;
            font-family:'Rubik', sans-serif;
        }

        .page-wrapper.compact-wrapper .page-body-wrapper .page-body{
            min-height:100vh;
            background:#f5f7fb;
            padding-bottom:40px;
        }

        .page-title{
            margin-bottom:25px;
        }

        .card{
            border:none;
            border-radius:20px;
        }

        .sidebar-wrapper{
            overflow-y:auto !important;
            overflow-x:hidden !important;
        }

        .sidebar-main{
            padding-bottom:80px;
        }

        /* MOBILE */

        @media(max-width:991px){

            .page-wrapper.compact-wrapper .page-body-wrapper .page-body{
                margin-left:0 !important;
                width:100% !important;
                padding:15px !important;
            }

            .page-title .row{
                display:flex;
                flex-direction:column;
                gap:10px;
            }

            .page-title .col-6{
                width:100%;
            }

            .breadcrumb{
                justify-content:flex-start !important;
            }

        }

    </style>

    <?php echo $__env->yieldPushContent('before-style'); ?>

    <?php echo $__env->make('layouts.dashboard.css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->yieldPushContent('after-style'); ?>

</head>

<body>

    <!-- LOADER -->

    <div class="loader-wrapper">

        <div class="loader-index">

            <span></span>

        </div>

        <svg>

            <defs></defs>

            <filter id="goo">

                <feGaussianBlur in="SourceGraphic"
                                stdDeviation="11"
                                result="blur"></feGaussianBlur>

                <feColorMatrix in="blur"
                               mode="matrix"
                               values="
                               1 0 0 0 0
                               0 1 0 0 0
                               0 0 1 0 0
                               0 0 0 18 -7"
                               result="goo">

                </feColorMatrix>

            </filter>

        </svg>

    </div>

    <!-- TAP TOP -->

    <div class="tap-top">

        <i data-feather="chevrons-up"></i>

    </div>

    <!-- PAGE WRAPPER -->

    <div class="page-wrapper compact-wrapper"
         id="pageWrapper">

        <!-- HEADER -->

        <?php echo $__env->make('layouts.dashboard.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <!-- BODY WRAPPER -->

        <div class="page-body-wrapper">

            <!-- SIDEBAR -->

            <?php echo $__env->make('layouts.dashboard.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <!-- PAGE BODY -->

            <div class="page-body">

                <!-- BREADCRUMB -->

                <div class="container-fluid">

                    <div class="page-title">

                        <div class="row align-items-center">

                            <div class="col-6">

                                <?php echo $__env->yieldContent('breadcrumb-title'); ?>

                            </div>

                            <div class="col-6">

                                <ol class="breadcrumb justify-content-end">

                                    <li class="breadcrumb-item">

                                        <a href="<?php echo e(route('dashboard')); ?>">

                                            <i data-feather="home"></i>

                                        </a>

                                    </li>

                                    <?php echo $__env->yieldContent('breadcrumb-items'); ?>

                                </ol>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- CONTENT -->

                <?php echo $__env->yieldContent('content'); ?>

            </div>

            <!-- FOOTER -->

            <?php echo $__env->make('layouts.dashboard.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        </div>

    </div>

    <!-- SCRIPT -->

    <?php echo $__env->yieldPushContent('before-script'); ?>

    <?php echo $__env->make('layouts.dashboard.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- IMPORTANT -->

    <?php echo $__env->yieldContent('script'); ?>

    <?php echo $__env->yieldPushContent('after-script'); ?>

    <!-- FEATHER ICON -->

    <script>

        if(typeof feather !== 'undefined'){

            feather.replace();

        }

    </script>

</body>

</html><?php /**PATH C:\Users\Administrator\Documents\Project\RSUD\belajar ni\simrsud_k3rs\resources\views/layouts/dashboard/master.blade.php ENDPATH**/ ?>