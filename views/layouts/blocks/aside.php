<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <ul class="nav nav-treeview">

        <li class="nav-item">
            <a href="" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>Danh mục Tour</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>Thêm danh mục mới</p>
            </a>
        </li>
    </ul>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon bi bi-collection"></i>
            <p>
                Danh Mục
                <i class="nav-arrow bi bi-chevron-right"></i>
            </p>
        </a>

        <ul class="nav nav-treeview">

            <li class="nav-item">
                <a href="<?= BASE_URL . 'danh-muc-tour' ?>" class="nav-link">
                    <i class="nav-icon bi bi-circle"></i>
                    <p>Danh mục Tour</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?= BASE_URL . 'form-add-danh-muc-tour' ?>" class="nav-link">
                    <i class="nav-icon bi bi-circle"></i>
                    <p>Thêm danh mục mới</p>
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon bi bi-people-fill"></i>
            <p>
                Quản lý Khách hàng
                <i class="nav-arrow bi bi-chevron-right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="<?= BASE_URL . 'khach-hang' ?>" class="nav-link">
                    <i class="nav-icon bi bi-circle"></i>
                    <p>Danh sách Khách hàng</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= BASE_URL . 'form-add-khach-hang' ?>" class="nav-link">
                    <i class="nav-icon bi bi-circle"></i>
                    <p>Thêm khách hàng</p>
                </a>
            </li>
        </ul>
    </li>
    <?php if (isAdmin()): ?>
        <li class="nav-item">
            <a href="<?= BASE_URL . '?act=user' ?>" class="nav-link">
                <i class="nav-icon bi bi-person-gear"></i>
                <p>
                    Quản lý nhân viên
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?= BASE_URL . '?act=form-add-user' ?>" class="nav-link">
                        <i class="nav-icon bi bi-circle"></i>
                        <p>Danh sách Người dùng</p>
                    </a>
                </li>
            </ul>
        </li>
    <?php endif; ?>
    <li class="nav-header">HỆ THỐNG</li>
    <li class="nav-item">
        <a href="<?= BASE_URL . 'logout' ?>" class="nav-link">
            <i class="nav-icon bi bi-box-arrow-right"></i>
            <p>Đăng xuất</p>
        </a>
    </li>
    </ul>
    <!--end::Sidebar Menu-->
    </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>
<!--end::Sidebar-->