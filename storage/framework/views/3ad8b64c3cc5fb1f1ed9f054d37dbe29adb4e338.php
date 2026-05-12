<div class="page-header">
    <div class="header-wrapper row m-0">
        <div class="d-flex justify-content-between header-logo-wrapper col-12 p-0">
            <div class="toggle-sidebar">
                <i class="status_toggle middle sidebar-toggle" data-feather="menu"></i>
            </div>
            <div></div>
            <div class="d-flex" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer">
                <img class="b-r-10 d-none d-lg-block" src="https://ui-avatars.com/api/?name=User" alt="" style="width: 35px;">
                <img class="d-block d-lg-none" src="https://ui-avatars.com/api/?name=User" alt="" style="width: 25px;">
                <div class="media-body ms-2 d-none d-lg-block">
                    <span class="fw-bold ">User</span>
                    <p class="m-0 font-roboto">
                       User
                        <i class="fa fa-chevron-down"></i>
                    </p>
                </div>
            </div>
            <ul class="dropdown-menu mt-2">
                <li>
                    <form action="<?php echo e(route('logout')); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="dropdown-item"><i class="fa fa-arrow-right-from-bracket"></i> Keluar</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
<?php /**PATH D:\xampp\htdocs\simrsud_k3rs-main\simrsud_k3rs\resources\views/layouts/dashboard/header.blade.php ENDPATH**/ ?>