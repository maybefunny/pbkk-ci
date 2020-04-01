<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
  <div class="sidebar-brand-icon rotate-n-15">
	<i class="fas fa-laugh-wink"></i>
  </div>
  <div class="sidebar-brand-text mx-3">Toko Buah <sup>2</sup></div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item <?php echo $this->uri->segment(2) == '' ? 'active': '' ?>">
  <a class="nav-link" href="<?php echo site_url('admin') ?>">
	<i class="fas fa-fw fa-tachometer-alt"></i>
	<span>Overview</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
  Menu
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item <?php echo $this->uri->segment(2) == 'transactions' ? 'active': '' ?>">
	<a class="nav-link" href="<?php echo site_url('transactions') ?>">
		<i class="fas fa-fw fa-list"></i>
		<span>Transactions</span></a>
</li>

<li class="nav-item <?php echo $this->uri->segment(2) == 'products' ? 'active': '' ?>">
	<a class="nav-link" href="<?php echo site_url('admin/products') ?>">
		<i class="fas fa-fw fa-boxes"></i>
		<span>Products</span></a>
</li>

<?php if( $this->session->user_logged->role === "admin" ){ ?>
<li class="nav-item <?php echo $this->uri->segment(2) == 'categories' ? 'active': '' ?>">
	<a class="nav-link" href="<?php echo site_url('admin/categories') ?>">
		<i class="fas fa-fw fa-tag"></i>
		<span>Categories</span></a>
</li>

<li class="nav-item <?php echo $this->uri->segment(2) == 'users' ? 'active': '' ?>">
	<a class="nav-link" href="<?php echo site_url('admin/users') ?>">
		<i class="fas fa-fw fa-users"></i>
		<span>Users</span></a>
</li>
<?php } ?>

<li class="nav-item <?php echo $this->uri->segment(2) == 'settings' ? 'active': '' ?>">
	<a class="nav-link" href="#">
		<i class="fas fa-fw fa-cog"></i>
		<span>Settings</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
  <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->
