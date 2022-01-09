 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
     <?php
        $role_id = $this->session->userdata('role_id');
        if ($role_id == 1) {
            $beranda = "admin";
        } else {
            $beranda = "user";
        }

        $queryMenu = "SELECT `user_menu`.`id`, `menu`
        FROM `user_menu` JOIN `user_access_menu`
        ON `user_menu`.`id` = `user_access_menu`.`menu_id`
        WHERE  `user_access_menu`.`role_id` = $role_id
        ORDER BY `user_access_menu`.`id`
        ";

        $menu = $this->db->query($queryMenu)->result_array();
        ?>
     <!-- Sidebar - Brand -->
     <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url($beranda); ?>">
         <div class="sidebar-brand-icon rotate-n-15">
             <i class="fas fa-burn"></i>
         </div>
         <div class="sidebar-brand-text mx-3">Dashboard</div>
     </a>

     <!-- Divider -->
     <hr class="sidebar-divider">
     <!-- Nav Item - Dashboard -->

     <div class="sidebar-heading">Beranda</div>
     <li class="nav-item">
         <a class="nav-link" href="<?= base_url($beranda); ?>">
             <i class="fas fa-table"></i>
             <span>Data Usulan</span></a>
     </li>

     <hr class="sidebar-divider">

     <!-- QUERY MENU-->

     <?php foreach ($menu as $m) :
        ?>
         <div class="sidebar-heading"><?= $m['menu']; ?></div>

         <?php
            $menuID = $m['id'];
            $querySubMenu = "SELECT * FROM user_sub_menu JOIN user_menu 
                            ON user_sub_menu.menu_id = user_menu.id 
                            WHERE user_sub_menu.menu_id = $menuID 
                            AND user_sub_menu.aktif = 1";

            $subMenu = $this->db->query($querySubMenu)->result_array();
            ?>

         <?php foreach ($subMenu as $sm) : ?>
             <li class="nav-item" active>
                 <a class="nav-link" href="<?= base_url($sm['url']); ?>">
                     <i class="<?= $sm['icon']; ?>"></i>
                     <span><?= $sm['judul']; ?></span></a>
             </li>

         <?php endforeach; ?>
         <hr class="sidebar-divider">
     <?php endforeach; ?>

     <!-- Heading Looping Menu-->

     <!-- Nav Item - Pages Collapse Menu -->

     <!-- Divider -->

     <!-- Heading -->

     <!-- Nav Item - Pages Collapse Menu -->

     <!-- Nav Item - Charts -->
     <li class="nav-item">
         <a class="nav-link" href="#">
             <i class="fas fa-question-circle"></i>
             <span>Help</span></a>
     </li>

     <!-- Nav Item - Tables -->
     <li class="nav-item">
         <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
             <i class="fas fa-sign-out-alt"></i>
             <span>Log Out</span></a>
     </li>

     <!-- Divider -->
     <hr class="sidebar-divider d-none d-md-block">

     <!-- Sidebar Toggler (Sidebar) -->
     <div class="text-center d-none d-md-inline">
         <button class="rounded-circle border-0" id="sidebarToggle"></button>
     </div>

 </ul>
 <!-- End of Sidebar -->