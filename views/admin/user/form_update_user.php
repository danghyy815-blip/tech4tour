<?php
ob_start();
?>


<div class="content-wrapper">

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Cập nhật nhân viên</h3>
            </div>
            <form action="?act=update-user" method="POST">
              <input type="hidden" name="id" value="<?= htmlspecialchars($user['id'] ?? '') ?>">
              <div class="card-body">
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label>Tên đăng nhập</label>
                    <input type="text" name="username" class="form-control" placeholder="Tên đăng nhập" value="<?= htmlspecialchars($_POST['username'] ?? $user['username'] ?? '') ?>">
                    <?php if (isset($errors['username'])) : ?>
                      <span style="color: red;"><?= $errors['username'] ?></span>
                    <?php endif; ?>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Mật khẩu (để trống nếu không đổi)</label>
                    <input type="password" name="password_hash" class="form-control" placeholder="Mật khẩu mới">
                    <?php if (isset($errors['password_hash'])) : ?>
                      <span style="color: red;"><?= $errors['password_hash'] ?></span>
                    <?php endif; ?>
                  </div>
                </div>

                <div class="form-group">
                  <label>Họ và tên</label>
                  <input type="text" name="ho_ten" class="form-control" placeholder="Họ và tên" value="<?= htmlspecialchars($_POST['ho_ten'] ?? $user['ho_ten'] ?? '') ?>">
                  <?php if (isset($errors['ho_ten'])) : ?>
                    <span style="color: red;"><?= $errors['ho_ten'] ?></span>
                  <?php endif; ?>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label>Giới tính</label>
                    <select name="gioi_tinh" class="form-control">
                      <option value="Nam" <?= (($_POST['gioi_tinh'] ?? $user['gioi_tinh'] ?? '') === 'Nam') ? 'selected' : '' ?>>Nam</option>
                      <option value="Nữ" <?= (($_POST['gioi_tinh'] ?? $user['gioi_tinh'] ?? '') === 'Nữ') ? 'selected' : '' ?>>Nữ</option>
                      <option value="Khác" <?= (($_POST['gioi_tinh'] ?? $user['gioi_tinh'] ?? '') === 'Khác') ? 'selected' : '' ?>>Khác</option>
                    </select>
                  </div>
                  <div class="form-group col-md-4">
                    <label>Ngày sinh</label>
                    <input type="date" name="ngay_sinh" class="form-control" value="<?= htmlspecialchars($_POST['ngay_sinh'] ?? $user['ngay_sinh'] ?? '') ?>">
                  </div>
                  <div class="form-group col-md-4">
                    <label>Số điện thoại</label>
                    <input type="text" name="so_dien_thoai" class="form-control" placeholder="Số điện thoại" value="<?= htmlspecialchars($_POST['so_dien_thoai'] ?? $user['so_dien_thoai'] ?? '') ?>">
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Email" value="<?= htmlspecialchars($_POST['email'] ?? $user['email'] ?? '') ?>">
                  </div>
                  <div class="form-group col-md-6">
                    <label>Địa chỉ</label>
                    <input type="text" name="dia_chi" class="form-control" placeholder="Địa chỉ" value="<?= htmlspecialchars($_POST['dia_chi'] ?? $user['dia_chi'] ?? '') ?>">
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label>CCCD</label>
                    <input type="text" name="cccd" class="form-control" placeholder="CCCD" value="<?= htmlspecialchars($_POST['cccd'] ?? $user['cccd'] ?? '') ?>">
                  </div>
                  <div class="form-group col-md-4">
                    <label>Chức vụ</label>
                    <select name="chuc_vu" class="form-control">
                      <option value="Hướng dẫn viên" <?= (($_POST['chuc_vu'] ?? $user['chuc_vu'] ?? '') === 'Hướng dẫn viên') ? 'selected' : '' ?>>Hướng dẫn viên</option>
                      <option value="Admin" <?= (($_POST['chuc_vu'] ?? $user['chuc_vu'] ?? '') === 'Admin') ? 'selected' : '' ?>>Admin</option>
                    </select>
                  </div>
                  <div class="form-group col-md-4">
                    <label>Ngày vào làm</label>
                    <input type="date" name="ngay_vao_lam" class="form-control" value="<?= htmlspecialchars($_POST['ngay_vao_lam'] ?? $user['ngay_vao_lam'] ?? '') ?>">
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label>Lương cơ bản</label>
                    <input type="number" name="luong_co_ban" class="form-control" placeholder="Lương cơ bản" value="<?= htmlspecialchars($_POST['luong_co_ban'] ?? $user['luong_co_ban'] ?? '') ?>">
                  </div>
                  <div class="form-group col-md-6">
                    <label>Trạng thái</label>
                    <select name="trang_thai" class="form-control">
                      <option value="1" <?= ((isset($_POST['trang_thai']) ? $_POST['trang_thai'] : ($user['trang_thai'] ?? '')) == '1') ? 'selected' : '' ?>>Kích hoạt</option>
                      <option value="0" <?= ((isset($_POST['trang_thai']) ? $_POST['trang_thai'] : ($user['trang_thai'] ?? '')) == '0') ? 'selected' : '' ?>>Vô hiệu</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Cập nhật</button>
              </div>
            </form>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>

<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
</div>
</body>

</html>

<?php
$content = ob_get_clean();

// Hiển thị layout với nội dung
view('layouts.AdminLayout', [
  'title' => $title ?? 'Cập nhật nhân viên - Website Quản Lý Tour',
  'pageTitle' => 'Cập nhật nhân viên',
  'content' => $content,
  'breadcrumb' => [
    ['label' => 'Cập nhật nhân viên', 'url' => BASE_URL . '?act=user', 'active' => true],
  ],
]);
?>