<?php
ob_start();
?>

<div class="content-wrapper">
    <section class="content ">
        <div class="container-fluid mb-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline mb-5">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-info-circle"></i> Thông tin cơ bản
                            </h3>
                            <div class="card-tools">
                                <?php
                                $currentUser = getCurrentUser();
                                $isCurrent = $currentUser && isset($currentUser->id) && $currentUser->id == $user['id'];
                                ?>
                                <a href="<?= BASE_URL . 'form-update-user&id=' . $user['id'] ?>" class="btn btn-sm btn-info">
                                    <i class="fas fa-edit"></i> Sửa
                                </a>
                                <?php if ($isCurrent) : ?>
                                    <button type="button" class="btn btn-sm btn-danger" disabled title="Không thể xóa chính bạn">
                                        <i class="fas fa-trash"></i> Xóa
                                    </button>
                                <?php else : ?>
                                    <a href="delete-user&id=<?= $user['id'] ?>" style="color: white;" onclick="return confirmDelete()" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i> Xóa
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="card-body">
                            <dl class="row">
                                <dt class="col-sm-4">Tên đăng nhập:</dt>
                                <dd class="col-sm-8"><?= htmlspecialchars($user['username']) ?></dd>

                                <dt class="col-sm-4">Mật khẩu:</dt>
                                <dd class="col-sm-8"><?= !empty($user['password_hash']) ? '******' : '' ?></dd>

                                <dt class="col-sm-4">Tên nhân viên:</dt>
                                <dd class="col-sm-8"><?= htmlspecialchars($user['ho_ten']) ?></dd>

                                <dt class="col-sm-4">Giới tính:</dt>
                                <dd class="col-sm-8"><?= htmlspecialchars($user['gioi_tinh']) ?></dd>

                                <dt class="col-sm-4">Ngày sinh:</dt>
                                <dd class="col-sm-8">
                                    <span class=""><?= date('d-m-Y', strtotime($user['ngay_sinh'])) ?></span>
                                </dd>
                                <dt class="col-sm-4">Số điện thoại:</dt>
                                <dd class="col-sm-8"><?= htmlspecialchars($user['so_dien_thoai']) ?></dd>
                                 <dt class="col-sm-4">Email:</dt>
                                <dd class="col-sm-8"><?= htmlspecialchars($user['email']) ?></dd>
                                 <dt class="col-sm-4">Địa chỉ:</dt>
                                <dd class="col-sm-8"><?= htmlspecialchars($user['dia_chi']) ?></dd>
                                 <dt class="col-sm-4">Cccd:</dt>
                                <dd class="col-sm-8"><?= htmlspecialchars($user['cccd']) ?></dd>
                                 <dt class="col-sm-4">Chức vụ:</dt>
                                <dd class="col-sm-8"><?= htmlspecialchars($user['chuc_vu']) ?></dd>
                                <dt class="col-sm-4">Ngày vào làm:</dt>
                                <dd class="col-sm-8">
                                    <span class=""><?= !empty($user['ngay_vao_lam']) ? date('d-m-Y', strtotime($user['ngay_vao_lam'])) : '' ?></span>
                                </dd>
                                 <dt class="col-sm-4">Lương cơ bản:</dt>
                                <dd class="col-sm-8"><?= is_numeric($user['luong_co_ban']) ? number_format((float)$user['luong_co_ban'], 0, ',', '.') : htmlspecialchars($user['luong_co_ban']) ?></dd>

                                <dt class="col-sm-4">Trạng thái:</dt>
                                <dd class="col-sm-8">
                                    <?php
                                    $active = !empty($user['trang_thai']) && ($user['trang_thai'] == 1 || $user['trang_thai'] === '1' || $user['trang_thai'] === 'Kích hoạt' || $user['trang_thai'] === 'Hoạt động');
                                    $status_text = $active ? 'Kích hoạt' : 'Vô hiệu';
                                    $status_color = $active ? 'success' : 'warning';
                                    ?>
                                    <span class="badge badge-<?= $status_color ?>"><?= htmlspecialchars($status_text) ?></span>
                                </dd>
                            </dl>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
</div>

<aside class="control-sidebar control-sidebar-dark"></aside>

<script>
    function confirmDelete() {
        return confirm('Bạn chắc chắn muốn xóa nhân viên này? Hành động không thể hoàn tác.');
    }
</script>

<?php
$content = ob_get_clean();

// Hiển thị layout với nội dung
view('layouts.AdminLayout', [
    'title' => $title ?? 'Chi tiết nhân viên - Website Quản Lý User',
    'pageTitle' => 'Chi tiết nhân viên',
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Chi tiết nhân viên', 'url' => BASE_URL . 'user', 'active' => true],
    ],
]);
?>