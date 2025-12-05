<?php ob_start(); ?>

<style>
    .user-form-card { border: 1px solid #e5e7eb; border-radius: 10px; background: #fff; }
    .user-form-card .card-header { background: #f8fafc; border-bottom: 1px solid #e5e7eb; padding: 16px 20px; }
    .user-form-card .card-body { padding: 20px; }
    .user-form-card .card-footer { padding: 16px 20px; background: #f9fafb; border-top: 1px solid #e5e7eb; }
    label { font-weight: 600; margin-bottom: 6px; display: block; }
    .form-control { height: 42px; border-radius: 6px; border: 1px solid #e5e7eb; padding: 0 12px; }
    .form-control:focus { border-color: #2563eb; box-shadow: 0 0 0 3px rgba(37,99,235,0.15); }
    .invalid { border-color: red !important; }
    .error-text { color: red; font-size: 13px; margin-top: 4px; }
    .form-row { display: flex; gap: 16px; margin-bottom: 16px; }
    .form-group { flex: 1; display: flex; flex-direction: column; }
    .btn-primary { background: #2563eb; border: none; padding: 10px 20px; border-radius: 6px; font-weight: 600; }
    .btn-primary:hover { background: #1d4ed8; }
    .btn-secondary { background: #6b7280; border: none; padding: 10px 20px; border-radius: 6px; font-weight: 600; }
</style>


<div class="card user-form-card shadow-sm">
    <div class="card-header d-flex align-items-center justify-content-between">
        <div>
            <h5 class="mb-0 fw-semibold">Thêm nhân viên</h5>
            <small class="text-muted">Nhập thông tin tài khoản và hồ sơ</small>
        </div>
        <a href="user" class="btn btn-secondary text-white">Quay lại</a>
    </div>

    <form action="add-user" method="POST">
        <div class="card-body">

            <!-- Username + Password -->
            <div class="form-row">

                <div class="form-group">
                    <label>Tên đăng nhập</label>
                    <input type="text" name="username"
                           class="form-control <?= isset($errors['username']) ? 'invalid' : '' ?>"
                           value="<?= htmlspecialchars($_POST['username'] ?? '') ?>"
                           placeholder="Nhập tên đăng nhập">
                    <?php if(isset($errors['username'])): ?>
                        <div class="error-text"><?= $errors['username'] ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label>Mật khẩu</label>
                    <input type="password" name="password_hash"
                           class="form-control <?= isset($errors['password_hash']) ? 'invalid' : '' ?>"
                           placeholder="Nhập mật khẩu">
                    <?php if(isset($errors['password_hash'])): ?>
                        <div class="error-text"><?= $errors['password_hash'] ?></div>
                    <?php endif; ?>
                </div>

            </div>

            <!-- Họ tên -->
            <div class="form-group">
                <label>Họ và tên</label>
                <input type="text" name="ho_ten"
                       class="form-control <?= isset($errors['ho_ten']) ? 'invalid' : '' ?>"
                       value="<?= htmlspecialchars($_POST['ho_ten'] ?? '') ?>">
                <?php if(isset($errors['ho_ten'])): ?>
                    <div class="error-text"><?= $errors['ho_ten'] ?></div>
                <?php endif; ?>
            </div>

            <!-- Giới tính - Ngày sinh - SĐT -->
            <div class="form-row">

                <div class="form-group">
                    <label>Giới tính</label>
                    <select name="gioi_tinh"
                            class="form-control <?= isset($errors['gioi_tinh']) ? 'invalid' : '' ?>">
                        <option value="">-- Chọn --</option>
                        <option value="Nam" <?= (($_POST['gioi_tinh'] ?? '') == 'Nam')?'selected':'' ?>>Nam</option>
                        <option value="Nữ" <?= (($_POST['gioi_tinh'] ?? '') == 'Nữ')?'selected':'' ?>>Nữ</option>
                        <option value="Khác" <?= (($_POST['gioi_tinh'] ?? '') == 'Khác')?'selected':'' ?>>Khác</option>
                    </select>
                    <?php if(isset($errors['gioi_tinh'])): ?>
                        <div class="error-text"><?= $errors['gioi_tinh'] ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label>Ngày sinh</label>
                    <input type="date" name="ngay_sinh"
                           class="form-control <?= isset($errors['ngay_sinh']) ? 'invalid' : '' ?>"
                           value="<?= htmlspecialchars($_POST['ngay_sinh'] ?? '') ?>">
                    <?php if(isset($errors['ngay_sinh'])): ?>
                        <div class="error-text"><?= $errors['ngay_sinh'] ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label>Số điện thoại</label>
                    <input type="text" name="so_dien_thoai"
                           class="form-control <?= isset($errors['so_dien_thoai']) ? 'invalid' : '' ?>"
                           value="<?= htmlspecialchars($_POST['so_dien_thoai'] ?? '') ?>">
                    <?php if(isset($errors['so_dien_thoai'])): ?>
                        <div class="error-text"><?= $errors['so_dien_thoai'] ?></div>
                    <?php endif; ?>
                </div>

            </div>

            <!-- Email - Địa chỉ -->
            <div class="form-row">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email"
                           class="form-control <?= isset($errors['email']) ? 'invalid' : '' ?>"
                           value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                    <?php if(isset($errors['email'])): ?>
                        <div class="error-text"><?= $errors['email'] ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label>Địa chỉ</label>
                    <input type="text" name="dia_chi"
                           class="form-control <?= isset($errors['dia_chi']) ? 'invalid' : '' ?>"
                           value="<?= htmlspecialchars($_POST['dia_chi'] ?? '') ?>">
                    <?php if(isset($errors['dia_chi'])): ?>
                        <div class="error-text"><?= $errors['dia_chi'] ?></div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- CCCD - Chức vụ - Ngày vào làm -->
            <div class="form-row">

                <div class="form-group">
                    <label>CCCD</label>
                    <input type="text" name="cccd"
                           class="form-control <?= isset($errors['cccd']) ? 'invalid' : '' ?>"
                           value="<?= htmlspecialchars($_POST['cccd'] ?? '') ?>">
                    <?php if(isset($errors['cccd'])): ?>
                        <div class="error-text"><?= $errors['cccd'] ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label>Chức vụ</label>
                    <select name="chuc_vu"
                            class="form-control <?= isset($errors['chuc_vu']) ? 'invalid' : '' ?>">
                        <option value="">-- Chọn --</option>
                        <option value="Hướng dẫn viên" <?= (($_POST['chuc_vu'] ?? '')=='Hướng dẫn viên')?'selected':'' ?>>Hướng dẫn viên</option>
                        <option value="Admin" <?= (($_POST['chuc_vu'] ?? '')=='Admin')?'selected':'' ?>>Admin</option>
                    </select>
                    <?php if(isset($errors['chuc_vu'])): ?>
                        <div class="error-text"><?= $errors['chuc_vu'] ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label>Ngày vào làm</label>
                    <input type="date" name="ngay_vao_lam"
                           class="form-control <?= isset($errors['ngay_vao_lam']) ? 'invalid' : '' ?>"
                           value="<?= htmlspecialchars($_POST['ngay_vao_lam'] ?? '') ?>">
                    <?php if(isset($errors['ngay_vao_lam'])): ?>
                        <div class="error-text"><?= $errors['ngay_vao_lam'] ?></div>
                    <?php endif; ?>
                </div>

            </div>

            <!-- Lương + Trạng thái -->
            <div class="form-row">

                <div class="form-group">
                    <label>Lương cơ bản</label>
                    <input type="number" name="luong_co_ban"
                           class="form-control <?= isset($errors['luong_co_ban']) ? 'invalid' : '' ?>"
                           value="<?= htmlspecialchars($_POST['luong_co_ban'] ?? '') ?>">
                    <?php if(isset($errors['luong_co_ban'])): ?>
                        <div class="error-text"><?= $errors['luong_co_ban'] ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label>Trạng thái</label>
                    <select name="trang_thai"
                            class="form-control <?= isset($errors['trang_thai']) ? 'invalid' : '' ?>">
                        <option value="">-- Chọn --</option>
                        <option value="1" <?= (($_POST['trang_thai'] ?? '') === '1')?'selected':'' ?>>Kích hoạt</option>
                        <option value="0" <?= (($_POST['trang_thai'] ?? '') === '0')?'selected':'' ?>>Vô hiệu</option>
                    </select>
                    <?php if(isset($errors['trang_thai'])): ?>
                        <div class="error-text"><?= $errors['trang_thai'] ?></div>
                    <?php endif; ?>
                </div>

            </div>

        </div>

        <div class="card-footer d-flex gap-2">
            <button type="submit" class="btn-primary">Thêm</button>
            <a href="user" class="btn btn-secondary text-white">Hủy</a>
        </div>

    </form>
</div>

<?php $content = ob_get_clean(); 

view('layouts.AdminLayout', [
    'title' => 'Thêm nhân viên',
    'pageTitle' => 'Thêm nhân viên',
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Thêm nhân viên', 'url' => BASE_URL . 'user', 'active' => true],
    ],
]);
?>
