<?php ob_start(); ?>

<style>
  .user-form-card { border: 1px solid #e5e7eb; border-radius: 10px; background: #fff; }
  .user-form-card .card-header { background: #f8fafc; border-bottom: 1px solid #e5e7eb; padding: 16px 20px; }
  .user-form-card .card-body { padding: 20px; }
  .user-form-card .card-footer { padding: 16px 20px; background: #f9fafb; border-top: 1px solid #e5e7eb; }
  label { font-weight: 600; margin-bottom: 6px; display: block; }
  .form-control {
    height: 42px;
    border-radius: 6px;
    border: 1px solid #e5e7eb;
    padding: 0 12px;
  }
  .form-control:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
  }
  .invalid { border-color: red !important; }
  .error-text {
    color: red;
    font-size: 13px;
    margin-top: 4px;
    display: block;
  }
  .form-row {
    display: flex;
    gap: 16px;
    margin-bottom: 16px;
  }
  .form-group {
    flex: 1;
    display: flex;
    flex-direction: column;
  }
  .btn-primary {
    background: #2563eb;
    padding: 10px 20px;
    border-radius: 6px;
    border: none;
    font-weight: 600;
    transition: .2s;
  }
  .btn-primary:hover {
    background: #1d4ed8;
  }
  .btn-secondary { background: #6b7280; border: none; padding: 10px 20px; border-radius: 6px; font-weight: 600; }
</style>


<div class="card user-form-card shadow-sm">
  <div class="card-header d-flex align-items-center justify-content-between">
    <div>
      <h5 class="mb-0 fw-semibold">Cập nhật nhân viên</h5>
      <small class="text-muted">Điều chỉnh thông tin tài khoản và hồ sơ</small>
    </div>
    <a href="user" class="btn btn-secondary text-white">Quay lại</a>
  </div>

  <form action="update-user" method="POST">

    <input type="hidden" name="id" value="<?= htmlspecialchars($user['id'] ?? '') ?>">

    <div class="card-body">

      <!-- Username + Password -->
      <div class="form-row">

        <div class="form-group">
          <label>Tên đăng nhập</label>
          <input type="text" name="username"
            class="form-control <?= isset($errors['username']) ? 'invalid' : '' ?>"
            placeholder="Tên đăng nhập"
            value="<?= htmlspecialchars($_POST['username'] ?? $user['username'] ?? '') ?>">
          <?php if (isset($errors['username'])): ?>
            <span class="error-text"><?= $errors['username'] ?></span>
          <?php endif; ?>
        </div>

        <div class="form-group">
          <label>Mật khẩu (để trống nếu không đổi)</label>
          <input type="password" name="password_hash"
            class="form-control <?= isset($errors['password_hash']) ? 'invalid' : '' ?>"
            placeholder="Nhập mật khẩu mới nếu muốn đổi">
          <?php if (isset($errors['password_hash'])): ?>
            <span class="error-text"><?= $errors['password_hash'] ?></span>
          <?php endif; ?>
        </div>

      </div>


      <!-- Họ tên -->
      <div class="form-group">
        <label>Họ và tên</label>
        <input type="text" name="ho_ten"
          class="form-control <?= isset($errors['ho_ten']) ? 'invalid' : '' ?>"
          placeholder="Họ và tên"
          value="<?= htmlspecialchars($_POST['ho_ten'] ?? $user['ho_ten'] ?? '') ?>">
        <?php if (isset($errors['ho_ten'])): ?>
          <span class="error-text"><?= $errors['ho_ten'] ?></span>
        <?php endif; ?>
      </div>


      <!-- Giới tính – Ngày sinh – SĐT -->
      <div class="form-row">

        <div class="form-group">
          <label>Giới tính</label>
          <select name="gioi_tinh"
            class="form-control <?= isset($errors['gioi_tinh']) ? 'invalid' : '' ?>">
            <option value="Nam" <?= (($_POST['gioi_tinh'] ?? $user['gioi_tinh'] ?? '') == "Nam") ? "selected" : "" ?>>Nam</option>
            <option value="Nữ" <?= (($_POST['gioi_tinh'] ?? $user['gioi_tinh'] ?? '') == "Nữ") ? "selected" : "" ?>>Nữ</option>
            <option value="Khác" <?= (($_POST['gioi_tinh'] ?? $user['gioi_tinh'] ?? '') == "Khác") ? "selected" : "" ?>>Khác</option>
          </select>
          <?php if (isset($errors['gioi_tinh'])): ?>
            <span class="error-text"><?= $errors['gioi_tinh'] ?></span>
          <?php endif; ?>
        </div>

        <div class="form-group">
          <label>Ngày sinh</label>
          <input type="date" name="ngay_sinh"
            class="form-control <?= isset($errors['ngay_sinh']) ? 'invalid' : '' ?>"
            value="<?= htmlspecialchars($_POST['ngay_sinh'] ?? $user['ngay_sinh'] ?? '') ?>">
          <?php if (isset($errors['ngay_sinh'])): ?>
            <span class="error-text"><?= $errors['ngay_sinh'] ?></span>
          <?php endif; ?>
        </div>

        <div class="form-group">
          <label>Số điện thoại</label>
          <input type="text" name="so_dien_thoai"
            class="form-control <?= isset($errors['so_dien_thoai']) ? 'invalid' : '' ?>"
            placeholder="Số điện thoại"
            value="<?= htmlspecialchars($_POST['so_dien_thoai'] ?? $user['so_dien_thoai'] ?? '') ?>">
          <?php if (isset($errors['so_dien_thoai'])): ?>
            <span class="error-text"><?= $errors['so_dien_thoai'] ?></span>
          <?php endif; ?>
        </div>

      </div>


      <!-- Email – Địa chỉ -->
      <div class="form-row">

        <div class="form-group">
          <label>Email</label>
          <input type="email" name="email"
            class="form-control <?= isset($errors['email']) ? 'invalid' : '' ?>"
            placeholder="Email"
            value="<?= htmlspecialchars($_POST['email'] ?? $user['email'] ?? '') ?>">
          <?php if (isset($errors['email'])): ?>
            <span class="error-text"><?= $errors['email'] ?></span>
          <?php endif; ?>
        </div>

        <div class="form-group">
          <label>Địa chỉ</label>
          <input type="text" name="dia_chi"
            class="form-control <?= isset($errors['dia_chi']) ? 'invalid' : '' ?>"
            placeholder="Địa chỉ"
            value="<?= htmlspecialchars($_POST['dia_chi'] ?? $user['dia_chi'] ?? '') ?>">
          <?php if (isset($errors['dia_chi'])): ?>
            <span class="error-text"><?= $errors['dia_chi'] ?></span>
          <?php endif; ?>
        </div>

      </div>


      <!-- CCCD – Chức vụ – Ngày vào làm -->
      <div class="form-row">

        <div class="form-group">
          <label>CCCD</label>
          <input type="text" name="cccd"
            class="form-control <?= isset($errors['cccd']) ? 'invalid' : '' ?>"
            placeholder="CCCD"
            value="<?= htmlspecialchars($_POST['cccd'] ?? $user['cccd'] ?? '') ?>">
          <?php if (isset($errors['cccd'])): ?>
            <span class="error-text"><?= $errors['cccd'] ?></span>
          <?php endif; ?>
        </div>

        <div class="form-group">
          <label>Chức vụ</label>
          <select name="chuc_vu"
            class="form-control <?= isset($errors['chuc_vu']) ? 'invalid' : '' ?>">
            <option value="Hướng dẫn viên" <?= (($_POST['chuc_vu'] ?? $user['chuc_vu'] ?? '') == "Hướng dẫn viên") ? "selected" : "" ?>>Hướng dẫn viên</option>
            <option value="Admin" <?= (($_POST['chuc_vu'] ?? $user['chuc_vu'] ?? '') == "Admin") ? "selected" : "" ?>>Admin</option>
          </select>
          <?php if (isset($errors['chuc_vu'])): ?>
            <span class="error-text"><?= $errors['chuc_vu'] ?></span>
          <?php endif; ?>
        </div>

        <div class="form-group">
          <label>Ngày vào làm</label>
          <input type="date" name="ngay_vao_lam"
            class="form-control <?= isset($errors['ngay_vao_lam']) ? 'invalid' : '' ?>"
            value="<?= htmlspecialchars($_POST['ngay_vao_lam'] ?? $user['ngay_vao_lam'] ?? '') ?>">
          <?php if (isset($errors['ngay_vao_lam'])): ?>
            <span class="error-text"><?= $errors['ngay_vao_lam'] ?></span>
          <?php endif; ?>
        </div>

      </div>


      <!-- Lương – Trạng thái -->
      <div class="form-row">

        <div class="form-group">
          <label>Lương cơ bản</label>
          <input type="number" name="luong_co_ban"
            class="form-control <?= isset($errors['luong_co_ban']) ? 'invalid' : '' ?>"
            placeholder="Lương cơ bản"
            value="<?= htmlspecialchars($_POST['luong_co_ban'] ?? $user['luong_co_ban'] ?? '') ?>">
          <?php if (isset($errors['luong_co_ban'])): ?>
            <span class="error-text"><?= $errors['luong_co_ban'] ?></span>
          <?php endif; ?>
        </div>

        <div class="form-group">
          <label>Trạng thái</label>
          <select name="trang_thai"
            class="form-control <?= isset($errors['trang_thai']) ? 'invalid' : '' ?>">
            <option value="1" <?= ((isset($_POST['trang_thai']) ? $_POST['trang_thai'] : ($user['trang_thai'] ?? '')) == '1') ? 'selected' : '' ?>>Kích hoạt</option>
            <option value="0" <?= ((isset($_POST['trang_thai']) ? $_POST['trang_thai'] : ($user['trang_thai'] ?? '')) == '0') ? 'selected' : '' ?>>Vô hiệu</option>
          </select>
          <?php if (isset($errors['trang_thai'])): ?>
            <span class="error-text"><?= $errors['trang_thai'] ?></span>
          <?php endif; ?>
        </div>

      </div>

    </div>

    <div class="card-footer d-flex gap-2">
      <button type="submit" class="btn-primary">Cập nhật</button>
      <a href="user" class="btn btn-secondary text-white">Hủy</a>
    </div>

  </form>
</div>


<?php
$content = ob_get_clean();

view('layouts.AdminLayout', [
  'title' => 'Cập nhật nhân viên',
  'pageTitle' => 'Cập nhật nhân viên',
  'content' => $content,
  'breadcrumb' => [
    ['label' => 'Cập nhật nhân viên', 'url' => BASE_URL . 'user', 'active' => true],
  ],
]);
?>