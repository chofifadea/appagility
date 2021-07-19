<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <i class="fas fa-user"></i>
        </div>
        <div class="sidebar-brand-text mx-3"><?= $sess->data['tipe'] == 'superadmin' ? 'Super Admin' : 'Admin ' . $sess->data['nama_site'] ?></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-3">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('/dashboard'); ?>">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <?php if($sess->data['tipe'] == 'superadmin') : ?>
    
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('/pengguna'); ?>">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Pengguna</span></a>
    </li>

    <hr class="sidebar-divider">

    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('/pallet'); ?>">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Master Pallet</span></a>
    </li>

    <hr class="sidebar-divider">

    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('/site'); ?>">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Master Site</span></a>
    </li>

    <hr class="sidebar-divider">

    <!-- <li class="nav-item">
        <a class="nav-link" href="<?= base_url('/keterangan'); ?>">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Master Keterangan</span></a>
    </li>

    <hr class="sidebar-divider"> -->

    <?php endif ?>

    <!-- Nav Item - inbox -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('/admin/inbox'); ?>">
            <i class="fas fa-boxes"></i>
            <span>Inbox</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Output -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('/output'); ?>">
            <i class="fas fa-shipping-fast"></i>
            <span>Output</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Input -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('input'); ?>">
            <i class="fas fa-layer-group"></i>
            <span>Input</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Transaction -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('/transactions'); ?>">
            <i class="fas fa-fw fa-table"></i>
            <span>Transaction</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    <!-- Nav Item - User Guide -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('/transactions'); ?>">
            <i class="far fa-question-circle"></i>
            <span>User Guide</span></a>
    </li>

</ul>