<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <i class="fas fa-user"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin Site</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-3">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('/admin/admin'); ?>">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - inbox -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('/admin/inbox'); ?>">
            <i class="far fa-arrow-alt-to-bottom"></i>
            <span>Inbox</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Output -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('/admin/output'); ?>">
            <i class="far fa-arrow-alt-to-top"></i>
            <span>Output</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Input -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('admin/input'); ?>">
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

</ul>