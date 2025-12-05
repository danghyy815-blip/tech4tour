<?php
ob_start();
?>
<style>
    /* Detail user page styles */
    .user-detail-card {
        max-width: 1000px;
        margin: 0 auto 30px;
    }

    .user-panel {
        display: grid;
        grid-template-columns: 220px 1fr;
        gap: 24px;
        align-items: start;
    }

    .user-avatar {
        width: 180px;
        height: 180px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 48px;
        color: #fff;
        background: linear-gradient(135deg, #4a6cf7, #6f87ff);
        box-shadow: 0 8px 24px rgba(74,108,247,0.18);
        margin-bottom: 12px;
    }

    .user-meta {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .user-name {
        font-size: 20px;
        font-weight: 700;
        color: #1e293b;
    }

    .user-role {
        font-size: 13px;
        color: #64748b;
    }

    .user-actions a, .user-actions button {
        margin-left: 8px;
    }

    .detail-list dt {
        color: #475569;
        font-weight: 600;
    }

    .detail-list dd {
        color: #0f172a;
    }

    .badge-custom {
        padding: 6px 12px;
        border-radius: 999px;
        font-weight: 700;
        font-size: 13px;
    }

    .status-active { background: #d1fae5; color: #065f46; }
    .status-inactive { background: #fee2e2; color: #7f1d1d; }

    @media (max-width: 820px) {
        .user-panel { grid-template-columns: 1fr; }
        .user-avatar { width: 140px; height: 140px; font-size: 36px; }
    }
</style>

<div class="content-wrapper">
    <section class="content ">
        <div class="container-fluid mb-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline mb-5 user-detail-card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title">
                                <i class="fas fa-info-circle"></i> Thông tin cơ bản
                            </h3>
                            <div class="card-tools user-actions">
                                <?php
                                $currentUser = getCurrentUser();
                                $isCurrent = $currentUser && isset($currentUser->id) && $currentUser->id == $user['id'];
                                ?>
                                <a href="<?= BASE_URL . 'form-update-user&id=' . $user['id'] ?>" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-edit"></i> Sửa
                                </a>
                                <?php if ($isCurrent) : ?>
                                    <button type="button" class="btn btn-sm btn-outline-secondary" disabled title="Không thể xóa chính bạn">
                                        <i class="fas fa-user-lock"></i> Bảo vệ
                                    </button>
                                <?php else : ?>
                                    <a href="delete-user&id=<?= $user['id'] ?>" onclick="return confirmDelete()" class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-trash"></i> Xóa
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php
                            // Tạo initials cho avatar
                            $initials = '';
                            if (!empty($user['ho_ten'])) {
                                $parts = preg_split('/\s+/', trim($user['ho_ten']));
                                foreach ($parts as $p) {
                                    $initials .= mb_substr($p, 0, 1);
                                    if (mb_strlen($initials) >= 2) break;
                                }
                                $initials = mb_strtoupper($initials);
                            }
                            $active = !empty($user['trang_thai']) && ($user['trang_thai'] == 1 || $user['trang_thai'] === '1' || $user['trang_thai'] === 'Kích hoạt' || $user['trang_thai'] === 'Hoạt động');
                            ?>

                            <div class="user-panel">
                                <div>
                                    <div class="user-avatar"><?= htmlspecialchars($initials ?: 'NV') ?></div>
                                    <div class="user-meta">
                                        <div class="user-name"><?= htmlspecialchars($user['ho_ten']) ?></div>
                                        <div class="user-role"><?= htmlspecialchars($user['chuc_vu']) ?></div>
                                        <div style="margin-top:8px;">
                                            <span class="badge-custom <?= $active ? 'status-active' : 'status-inactive' ?>">
                                                <?= $active ? 'Kích hoạt' : 'Vô hiệu' ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <dl class="row detail-list">
                                        <dt class="col-sm-4">Tên đăng nhập:</dt>
                                        <dd class="col-sm-8"><?= htmlspecialchars($user['username']) ?></dd>

                                        <dt class="col-sm-4">Mật khẩu:</dt>
                                        <dd class="col-sm-8"><?= !empty($user['password_hash']) ? '******' : '' ?></dd>

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

                                        <dt class="col-sm-4">Ngày vào làm:</dt>
                                        <dd class="col-sm-8"><?= !empty($user['ngay_vao_lam']) ? date('d-m-Y', strtotime($user['ngay_vao_lam'])) : '' ?></dd>

                                        <dt class="col-sm-4">Lương cơ bản:</dt>
                                        <dd class="col-sm-8"><?= is_numeric($user['luong_co_ban']) ? number_format((float)$user['luong_co_ban'], 0, ',', '.') : htmlspecialchars($user['luong_co_ban']) ?></dd>
                                    </dl>
                                </div>
                            </div>
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