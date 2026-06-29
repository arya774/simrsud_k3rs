<div class="sidebar-wrapper">
    <div>

        <!-- LOGO -->
        <div class="logo-wrapper px-3 py-3 border-bottom">

            <a href="<?php echo e(route('dashboard')); ?>"
               class="d-flex align-items-center text-decoration-none">

                <img src="<?php echo e(asset('assets/images/logo/logo-rsud.png')); ?>"
                     alt="Logo RSUD Kota Bogor"
                     style="width:50px; height:auto;"
                     class="me-2">

                <div class="logo-text">
                    <h6 class="mb-0 fw-bold text-dark">RSUD</h6>
                    <small class="text-muted">Kota Bogor</small>
                </div>

            </a>

            <div class="back-btn">
                <i class="fa fa-angle-left"></i>
            </div>

            <div class="toggle-sidebar">
                <i class="status_toggle middle sidebar-toggle"
                   data-feather="grid"></i>
            </div>

        </div>

        <!-- LOGO ICON -->
        <div class="logo-icon-wrapper text-center py-3 border-bottom">

            <a href="<?php echo e(route('dashboard')); ?>">
                <img src="<?php echo e(asset('assets/images/logo/logo-rsud.png')); ?>"
                     alt="Logo RSUD"
                     style="width:38px; height:auto;">
            </a>

        </div>

        <!-- SIDEBAR -->
        <nav class="sidebar-main">

            <div class="left-arrow" id="left-arrow">
                <i data-feather="arrow-left"></i>
            </div>

            <div id="sidebar-menu">

                <ul class="sidebar-links" id="simple-bar">

                    <!-- BACK MOBILE -->
                    <li class="back-btn">
                        <div class="mobile-back text-end">
                            <span>Back</span>
                            <i class="fa fa-angle-right ps-2"></i>
                        </div>
                    </li>

                    <!-- DASHBOARD -->
                    <li class="sidebar-main-title">
                        <div><h6 class="mb-0">DASHBOARD</h6></div>
                    </li>

                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav <?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>"
                           href="<?php echo e(route('dashboard')); ?>">
                            <i data-feather="home"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <hr style="color:#bdbdbd">

                    <!-- MASTER DATA -->
                    <li class="sidebar-main-title">
                        <div><h6 class="mb-0">MASTER DATA</h6></div>
                    </li>

                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav <?php echo e(request()->routeIs('master-data.kategori.*') ? 'active' : ''); ?>"
                           href="<?php echo e(route('master-data.kategori.index')); ?>">
                            <i data-feather="layers"></i>
                            <span>Kategori</span>
                        </a>
                    </li>

                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav <?php echo e(request()->routeIs('master-data.uraian.*') ? 'active' : ''); ?>"
                           href="<?php echo e(route('master-data.uraian.index')); ?>">
                            <i data-feather="file-text"></i>
                            <span>Uraian</span>
                        </a>
                    </li>

                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav <?php echo e(request()->routeIs('master-data.sub-uraian.*') ? 'active' : ''); ?>"
                           href="<?php echo e(route('master-data.sub-uraian.index')); ?>">
                            <i data-feather="list"></i>
                            <span>Sub Uraian</span>
                        </a>
                    </li>

                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav <?php echo e(request()->routeIs('master-data.ruangan.*') ? 'active' : ''); ?>"
                           href="<?php echo e(route('master-data.ruangan.index')); ?>">
                            <i data-feather="map-pin"></i>
                            <span>Ruangan</span>
                        </a>
                    </li>

                    <hr style="color:#bdbdbd">

                    <!-- INSPEKSI -->
                    <li class="sidebar-main-title">
                        <div><h6 class="mb-0">INSPEKSI</h6></div>
                    </li>

                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav <?php echo e(request()->routeIs('inspeksi.index') ? 'active' : ''); ?>"
                           href="<?php echo e(route('inspeksi.index')); ?>">
                            <i data-feather="check-square"></i>
                            <span>Form Inspeksi</span>
                        </a>
                    </li>

                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav <?php echo e(request()->routeIs('inspeksi.riwayat') ? 'active' : ''); ?>"
                           href="<?php echo e(route('inspeksi.riwayat')); ?>">
                            <i data-feather="clipboard"></i>
                            <span>Riwayat Inspeksi</span>
                        </a>
                    </li>

                    <hr style="color:#bdbdbd">

                    <!-- LAPORAN -->
                    <li class="sidebar-main-title">
                        <div><h6 class="mb-0">LAPORAN</h6></div>
                    </li>

                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav <?php echo e(request()->routeIs('laporan.inspeksi') ? 'active' : ''); ?>"
                           href="<?php echo e(route('laporan.inspeksi')); ?>">
                            <i data-feather="printer"></i>
                            <span>Laporan Inspeksi</span>
                        </a>
                    </li>

                    <hr style="color:#bdbdbd">

                    <!-- ACCOUNT -->
                    <li class="sidebar-main-title mt-4">
                        <div><h6 class="mb-0 text-danger">ACCOUNT</h6></div>
                    </li>

                    <li class="sidebar-list">
                        <form method="POST" action="<?php echo e(route('logout')); ?>">
                            <?php echo csrf_field(); ?>
                            <button type="submit"
                                    class="sidebar-link sidebar-title link-nav border-0 bg-transparent w-100 text-start">
                                <i data-feather="log-out"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </li>

                </ul>

            </div>

            <div class="right-arrow" id="right-arrow">
                <i data-feather="arrow-right"></i>
            </div>

        </nav>

    </div>
</div><?php /**PATH C:\Users\Administrator\Documents\Project\RSUD\belajar ni\simrsud_k3rs\resources\views/layouts/dashboard/sidebar.blade.php ENDPATH**/ ?>