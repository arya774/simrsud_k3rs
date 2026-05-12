<div class="sidebar-wrapper">
    <div>

        <!-- LOGO -->
        <div class="logo-wrapper">

            <a href="<?php echo e(route('dashboard')); ?>">

                <img class="img-fluid for-light w-75"
                     src="https://via.placeholder.com/305x60.png?text=Logo+RSUD+Kota+Bogor"
                     alt="Logo RSUD">

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
        <div class="logo-icon-wrapper">

            <a href="<?php echo e(route('dashboard')); ?>">

                <img class="img-fluid"
                     src="https://via.placeholder.com/33x33.png?text=RS"
                     alt="Logo">

            </a>

        </div>

        <!-- SIDEBAR -->
        <nav class="sidebar-main">

            <div class="left-arrow" id="left-arrow">
                <i data-feather="arrow-left"></i>
            </div>

            <div id="sidebar-menu">

                <ul class="sidebar-links" id="simple-bar">

                    <!-- MOBILE BACK -->
                    <li class="back-btn">

                        <div class="mobile-back text-end">

                            <span>Back</span>

                            <i class="fa fa-angle-right ps-2"></i>

                        </div>

                    </li>

                    <!-- DASHBOARD -->
                    <li class="sidebar-main-title">

                        <div>
                            <h6 class="mb-0">DASHBOARD</h6>
                        </div>

                    </li>

                    <li class="sidebar-list">

                        <a class="sidebar-link sidebar-title link-nav 
                           <?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>"
                           href="<?php echo e(route('dashboard')); ?>">

                            <i data-feather="home"></i>

                            <span>Dashboard</span>

                        </a>

                    </li>

                    <hr style="color:#bdbdbd">

                    <!-- MASTER DATA -->
                    <li class="sidebar-main-title">

                        <div>
                            <h6 class="mb-0">MASTER DATA</h6>
                        </div>

                    </li>

                    <!-- KATEGORI -->
                    <li class="sidebar-list">

                        <a class="sidebar-link sidebar-title link-nav 
                           <?php echo e(request()->routeIs('master-data.kategori.*') ? 'active' : ''); ?>"
                           href="<?php echo e(route('master-data.kategori.index')); ?>">

                            <i data-feather="layers"></i>

                            <span>Kategori</span>

                        </a>

                    </li>

                    <!-- URAIAN -->
                    <li class="sidebar-list">

                        <a class="sidebar-link sidebar-title link-nav 
                           <?php echo e(request()->routeIs('master-data.uraian.*') ? 'active' : ''); ?>"
                           href="<?php echo e(route('master-data.uraian.index')); ?>">

                            <i data-feather="file-text"></i>

                            <span>Uraian</span>

                        </a>

                    </li>

                    <!-- SUB URAIAN -->
                    <li class="sidebar-list">

                        <a class="sidebar-link sidebar-title link-nav 
                           <?php echo e(request()->routeIs('master-data.sub-uraian.*') ? 'active' : ''); ?>"
                           href="<?php echo e(route('master-data.sub-uraian.index')); ?>">

                            <i data-feather="list"></i>

                            <span>Sub Uraian</span>

                        </a>

                    </li>

                    <!-- RUANGAN -->
                    <li class="sidebar-list">

                        <a class="sidebar-link sidebar-title link-nav 
                           <?php echo e(request()->routeIs('master-data.ruangan.*') ? 'active' : ''); ?>"
                           href="<?php echo e(route('master-data.ruangan.index')); ?>">

                            <i data-feather="map-pin"></i>

                            <span>Ruangan</span>

                        </a>

                    </li>

                    <hr style="color:#bdbdbd">

                    <!-- INSPEKSI -->
                    <li class="sidebar-main-title">

                        <div>
                            <h6 class="mb-0">INSPEKSI</h6>
                        </div>

                    </li>

                    <!-- FORM INSPEKSI -->
                    <li class="sidebar-list">

                        <a class="sidebar-link sidebar-title link-nav 
                           <?php echo e(request()->routeIs('inspeksi.index') ? 'active' : ''); ?>"
                           href="<?php echo e(route('inspeksi.index')); ?>">

                            <i data-feather="check-square"></i>

                            <span>Form Inspeksi</span>

                        </a>

                    </li>

                    <!-- RIWAYAT -->
                    <li class="sidebar-list">

                        <a class="sidebar-link sidebar-title link-nav 
                           <?php echo e(request()->routeIs('inspeksi.riwayat') ? 'active' : ''); ?>"
                           href="<?php echo e(route('inspeksi.riwayat')); ?>">

                            <i data-feather="clipboard"></i>

                            <span>Riwayat Inspeksi</span>

                        </a>

                    </li>

                    <hr style="color:#bdbdbd">

                    <!-- LAPORAN -->
                    <li class="sidebar-main-title">

                        <div>
                            <h6 class="mb-0">LAPORAN</h6>
                        </div>

                    </li>

                    <li class="sidebar-list">

                        <a class="sidebar-link sidebar-title link-nav"
                           href="#">

                            <i data-feather="printer"></i>

                            <span>Laporan Inspeksi</span>

                        </a>

                    </li>

                    <!-- LOGOUT -->
                    <li class="sidebar-main-title mt-4">

                        <div>
                            <h6 class="mb-0 text-danger">ACCOUNT</h6>
                        </div>

                    </li>

                    <li class="sidebar-list">

                        <form method="POST"
                              action="<?php echo e(route('logout')); ?>">

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
</div><?php /**PATH D:\Downloads\simrsud-starterpack-main\resources\views/layouts/dashboard/sidebar.blade.php ENDPATH**/ ?>