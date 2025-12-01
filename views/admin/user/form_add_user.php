<?php ob_start(); ?>

<style>
    :root {
        --primary: #4a6cf7;
        --primary-hover: #3d5ae5;
        --border: #dcdcdc;
        --radius: 10px;
        --input-radius: 6px;
    }
    .card {
        border-radius: var(--radius);
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
    }
    .card-header {
        background: var(--primary);
        padding: 18px 24px;
    }
    .card-title {
        color: #fff;
        font-size: 18px;
        font-weight: 600;
        margin: 0;
    }
    .card-body { padding: 25px 30px; }
    .card-footer { padding: 20px 30px; }

    label { font-weight: 600; margin-bottom: 4px; display: block; }

    .form-control {
        height: 44px;
        border-radius: var(--input-radius);
        border: 1px solid var(--border);
        padding: 0 12px;
        transition: .2s;
    }
    .form-control:focus {
        border: 1px solid var(--primary);
        box-shadow: 0 0 0 3px rgba(74,108,247,0.2);
    }

    .invalid { border-color: red !important; }
    .error-text {
        color: red;
        font-size: 13px;
        margin-top: 4px;
    }

    .form-row { display: flex; gap: 20px; margin-bottom: 18px; }
    .form-group { flex: 1; display: flex; flex-direction: column; }

    .btn-primary {
        background: var(--primary);
        padding: 10px 26px;
        border-radius: 6px;
        border: none;
        font-weight: 600;
    }
    .btn-primary:hover { background: var(--primary-hover); }
</style>


<div class="card">
    <div class="card-header">
        <h3 class="card-title">Thêm nhân viên</h3>
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

        <div class="card-footer">
            <button type="submit" class="btn-primary">Thêm</button>
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
