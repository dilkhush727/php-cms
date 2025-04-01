<div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
    <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="sidebarMenuLabel">Dilkhush</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
        <ul class="nav flex-column">
        <li class="nav-item <?php echo (strpos($_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], 'dashboard.php') !== false) ? 'active' : ''; ?>">
            <a class="nav-link d-flex align-items-center gap-2 active" aria-current="page" href="<?=base_url('admin/'); ?>dashboard.php">
            <i class="fa fa-home"></i>
            Dashboard
            </a>
        </li>
        <li class="nav-item <?php echo (strpos($_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], 'projects.php') !== false) ? 'active' : ''; ?>">
            <a class="nav-link d-flex align-items-center gap-2" href="<?=base_url('admin/'); ?>projects.php">
            <i class="fa fa-check"></i>
            Projects
            </a>
        </li>
        <li class="nav-item <?php echo (strpos($_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], 'skills.php') !== false) ? 'active' : ''; ?>">
            <a class="nav-link d-flex align-items-center gap-2" href="<?=base_url('admin/'); ?>skills.php">
            <i class="fa fa-bullseye"></i>
            Skills
            </a>
        </li>
        <li class="nav-item <?php echo (strpos($_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], 'contact.php') !== false) ? 'active' : ''; ?>">
            <a class="nav-link d-flex align-items-center gap-2" href="<?=base_url('admin/'); ?>contact.php">
            <i class="fa fa-envelope"></i>
            Contact
            </a>
        </li>
        </ul>

        <hr class="my-3">

        <ul class="nav flex-column mb-auto">
            <li class="nav-item <?php echo (strpos($_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], 'settings.php') !== false) ? 'active' : ''; ?>">
                <a class="nav-link d-flex align-items-center gap-2" href="<?=base_url('admin/'); ?>settings.php">
                <i class="fa fa-cog"></i>
                Settings
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-2" href="<?=base_url('admin/'); ?>logout.php">
                <i class="fa fa-sign-out"></i>
                Sign out
                </a>
            </li>
        </ul>
    </div>
    </div>
</div>