  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Nur Muhammad Arofiq</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="/" class="nav-link {{$page == 'dashboard' ? 'active' : ''}}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item {{$page ==  'kategori' || $page == 'databarang'|| $page == 'member' ?  'menu-open' : ' '}}">
            <a href="#" class="nav-link {{$page ==  'kategori' || $page == 'databarang' || $page == 'member' ? 'active' : ' '}}">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Master
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item active ">
                <a href="/master/barang" class="nav-link {{$page == 'databarang' ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Barang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/master/kategori" class="nav-link  {{$page == 'kategori' ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kategori</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/master/member" class="nav-link  {{$page == 'member' ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Member</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/tables/jsgrid.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>User</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item {{$page ==  'transaksi' || $page == 'laporan' ? 'menu-open' : ' '}}">
            <a href="#" class="nav-link {{$page ==  'transaksi' || $page == 'laporan' ? 'active' : ' '}}">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Transaksi
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/transaksi" class="nav-link {{$page == 'transaksi' ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Transaksi Jual</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/transaksi/laporan" class="nav-link {{$page == 'laporan' ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Penjualan</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
