  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= BASE_URL_ADMIN . '/' ?>" class="brand-link">
      <img src="./assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="./assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fa-solid fa-magnifying-glass"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <li class="nav-item">
            <a href="<?= BASE_URL_ADMIN . '?act=policy' ?>" class="nav-link">
              <i class="fa-solid fa-list p-2" style="font-size: 20px;"></i>
              <p>
                Quản lý chính sách
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= BASE_URL_ADMIN . '?act=san-pham' ?>" class="nav-link">
              <i class="fa-brands fa-product-hunt p-2" style="font-size: 20px;"></i>
              <p>
                Sản phẩm
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= BASE_URL_ADMIN . '?act=don-hang' ?>" class="nav-link">
              <i class="fa-solid fa-file-invoice p-2" style="font-size: 20px;"></i>
              <p>
                Đơn hàng
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= BASE_URL_ADMIN . '?act=san-pham' ?>" class="nav-link">
              <i class="nav-item fas fa-user p-2" style="font-size: 20px;"></i>
              <p>
                Quản lý tài khoản
              </p>
              <i class="right fas fa-angle-left right mt-2"></i>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= BASE_URL_ADMIN . '?act=list-tai-khoan-quan-tri' ?>" class="nav-link">
                  <i class="nav-item fas fa-user" style="font-size: 18px;"></i>
                  <p>
                    Tài khoản quản trị
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= BASE_URL_ADMIN . '?act=list-tai-khoan-khach-hang' ?>" class="nav-link">
                  <i class="nav-item fas fa-user" style="font-size: 18px;"></i>
                  <p>
                    Tài khoản khách hàng
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= BASE_URL_ADMIN . '?act=form-edit-admin' ?>" class="nav-link">
                  <i class="nav-item fas fa-user" style="font-size: 18px;"></i>
                  <p>
                    Tài khoản cá nhân
                  </p>
                </a>
              </li>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>