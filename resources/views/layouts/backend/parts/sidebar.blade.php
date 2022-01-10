<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('/') }}dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: 0.8" />
        <span class="brand-text font-weight-light">{{  env('APP_NAME') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('/') }}dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image" />
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>

        @canany(['admin', 'donatur'])
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"  class="nav-link mb-0  {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-tachometer-alt"></i>
                        <p class="mb-0">Dashboard</p>
                    </a>
                </li>
                <li class="nav-header">Master</li>
                <li class="nav-item">
                    <a href="{{ route('category.index') }}" class="nav-link {{ request()->routeIs('category.*') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-cube"></i>
                        <p>Kategori</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/gallery.html" class="nav-link">
                        <i class="nav-icon fa fa-th-large"></i>
                        <p>Project</p>
                    </a>
                </li>
                <li class="nav-header">Referensi</li>
                <li class="nav-item">
                    <a href="pages/gallery.html" class="nav-link">
                        <i class="nav-icon fa fa-users"></i>
                        <p>Donatur</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/gallery.html" class="nav-link">
                        <i class="nav-icon fa fa-hand-holding-usd"></i>
                        <p>Daftar Donasi</p>
                    </a>
                </li>
              @can('admin')
              <li class="nav-header">Informasi</li>
              <li class="nav-item">
                  <a href="pages/gallery.html" class="nav-link">
                      <i class="nav-icon fa fa-envelope"></i>
                      <p>Kontak Masuk</p>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="pages/gallery.html" class="nav-link">
                      <i class="nav-icon fa fa-user-plus"></i>
                      <p>Subscribers</p>
                  </a>
              </li>
              @endcan
               @can('donatur')
               <li class="nav-header">Log</li>
               <li class="nav-item">
                   <a href="pages/gallery.html" class="nav-link">
                       <i class="nav-icon fa fa-info-circle"></i>
                       <p>Log Aktivitas</p>
                   </a>
               </li>
               @endcan
                <li class="nav-header">Report</li>
                <li class="nav-item">
                    <a href="pages/gallery.html" class="nav-link">
                        <i class="nav-icon fa fa-file-alt"></i>
                        <p>Laporan</p>
                    </a>
                </li>
                <li class="nav-header">Settings</li>
                <li class="nav-item">
                    <a href="pages/gallery.html" class="nav-link">
                        <i class="nav-icon fa fa-cog"></i>
                        <p>Pengaturan</p>
                    </a>
                </li>
            </ul>
        </nav>
        @endcanany
    </div>
</aside>
