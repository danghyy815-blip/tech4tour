<?php
ob_start();
?>

<style>
    .user-detail-card { border: 1px solid #e5e7eb; border-radius: 10px; }
    .user-detail-card .card-header { background: #f8fafc; border-bottom: 1px solid #e5e7eb; padding: 16px 20px; }
    .user-detail-card .card-body { padding: 20px; }
    .badge-soft-success { background: #e6f4ea; color: #1f7a3d; }
    .badge-soft-secondary { background: #f1f2f4; color: #475467; }
    dl.row dt { font-weight: 600; color: #475467; }
</style>

<div class="content-wrapper">
    <section class="content ">
        <div class="container-fluid mb-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card user-detail-card shadow-sm mb-5">
                        <div class="card-header d-flex align-items-center flex-wrap gap-2">
                            <div>
                                <h5 class="mb-0 fw-semibold"><i class="fas fa-info-circle"></i> Thông tin nhân viên</h5>
                                <small class="text-muted">Chi tiết hồ sơ và trạng thái</small>
                            </div>
                            <div class="ms-auto d-flex gap-2">
                                <?php
                                $currentUser = getCurrentUser();
                                $isCurrent = $currentUser && isset($currentUser->id) && $currentUser->id == $user['id'];
                                ?>
                                <a href="<?= BASE_URL . 'form-update-user&id=' . $user['id'] ?>" class="btn btn-primary btn-sm">
                                    <i class="fas fa-edit"></i> Sửa
                                </a>
                                <?php if ($isCurrent) : ?>
                                    <button type="button" class="btn btn-secondary btn-sm" disabled title="Không thể xóa chính bạn">
                                        <i class="fas fa-trash"></i> Xóa
                                    </button>
                                <?php else : ?>
                                    <a href="delete-user&id=<?= $user['id'] ?>" class="btn btn-outline-danger btn-sm"
                                        onclick="return confirmDelete()">
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
                                <dd class="col-sm-8"><?= !empty($user['ngay_sinh']) ? date('d-m-Y', strtotime($user['ngay_sinh'])) : '' ?></dd>

                                <dt class="col-sm-4">Số điện thoại:</dt>
                                <dd class="col-sm-8"><?= htmlspecialchars($user['so_dien_thoai']) ?></dd>

                                <dt class="col-sm-4">Email:</dt>
                                <dd class="col-sm-8"><?= htmlspecialchars($user['email']) ?></dd>

                                <dt class="col-sm-4">Địa chỉ:</dt>
                                <dd class="col-sm-8"><?= htmlspecialchars($user['dia_chi']) ?></dd>

                                <dt class="col-sm-4">CCCD:</dt>
                                <dd class="col-sm-8"><?= htmlspecialchars($user['cccd']) ?></dd>

                                <dt class="col-sm-4">Chức vụ:</dt>
                                <dd class="col-sm-8"><span class="badge bg-light text-dark border px-3 py-2"><?= htmlspecialchars($user['chuc_vu']) ?></span></dd>

                                <dt class="col-sm-4">Ngày vào làm:</dt>
                                <dd class="col-sm-8"><?= !empty($user['ngay_vao_lam']) ? date('d-m-Y', strtotime($user['ngay_vao_lam'])) : '' ?></dd>

                                <dt class="col-sm-4">Lương cơ bản:</dt>
                                <dd class="col-sm-8"><?= is_numeric($user['luong_co_ban']) ? number_format((float)$user['luong_co_ban'], 0, ',', '.') : htmlspecialchars($user['luong_co_ban']) ?></dd>

                                <dt class="col-sm-4">Trạng thái:</dt>
                                <dd class="col-sm-8">
                                    <?php
                                    $active = !empty($user['trang_thai']) && ($user['trang_thai'] == 1 || $user['trang_thai'] === '1' || $user['trang_thai'] === 'Kích hoạt' || $user['trang_thai'] === 'Hoạt động');
                                    $status_text = $active ? 'Kích hoạt' : 'Vô hiệu';
                                    $badgeClass = $active ? 'badge-soft-success' : 'badge-soft-secondary';
                                    ?>
                                    <span class="badge <?= $badgeClass ?> px-3 py-2"><?= htmlspecialchars($status_text) ?></span>
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