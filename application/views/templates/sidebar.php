<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-code"></i>
        </div>
        <div class="sidebar-brand-text mx-3">WPU LOGIN PROJECT</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <?php
    $role_id = $this->session->userdata('role_id');
    $queryMenu = "SELECT `tb_user_menu`.`id`, `menu`
                    FROM `tb_user_menu` JOIN `tb_user_access_menu`
                      ON `tb_user_menu`.`id` = `tb_user_access_menu`.`menu_id`
                   WHERE `tb_user_access_menu`.`role_id` = $role_id
                ORDER BY `tb_user_access_menu`.`menu_id`
                ";
    $menu = $this->db->query($queryMenu)->result_array();
    ?>

    <!-- Looping menu -->
    <?php foreach ($menu as $mn) : ?>
        <div class="sidebar-heading">
            <?php echo $mn['menu']; ?>
        </div>

        <!-- siapin Sub Menu -->
        <?php
        $menuId = $mn['id'];
        $querySubMenu = "SELECT *
                    FROM `tb_user_sub_menu` JOIN `tb_user_menu`
                      ON `tb_user_sub_menu`.`menu_id` = `tb_user_menu`.`id`
                   WHERE `tb_user_sub_menu`.`menu_id` = $menuId
                     AND `tb_user_sub_menu`.`is_active` = 1
                ";

        $subMenu = $this->db->query($querySubMenu)->result_array();
        ?>
        <!-- looping sub menu -->
        <?php foreach ($subMenu as $sm) : ?>
            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.html">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span><?= $sm['title']; ?></span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">
        <?php endforeach; ?>

    <?php endforeach; ?>


    <!-- Heading -->
    <div class="sidebar-heading">
        Logout
    </div>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('auth/logout'); ?>">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Logout</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->