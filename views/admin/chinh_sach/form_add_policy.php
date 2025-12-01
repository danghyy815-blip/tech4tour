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
              <h3 class="card-title">Thêm chính sách</h3>
            </div>
            <form action="<?= BASE_URL . 'add-policy'?>" method="POST">
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Tên chính sách</label>
                  <input type="text" name="ten_chinh_sach" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên chính sách">
                  <?php if (isset($errors['ten_chinh_sach'])) : ?>
                    <span style="color: red;"><?= $errors['ten_chinh_sach'] ?></span>
                  <?php endif; ?>
                </div>
                <div class="row">
                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Loại chính sách</label>
                    <select name="loai_chinh_sach" class="form-control" id="exampleInputEmail1">
                      <option value="Giảm giá">Giảm giá</option>
                      <option value="Hoàn tiền">Hoàn tiền</option>
                      <option value="Khuyến mãi">Khuyến mãi</option>
                      <option value="Khác">Khác</option>
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Trạng thái</label>
                    <select name="trang_thai" class="form-control" id="exampleInputEmail1">
                      <option value="Đang áp dụng">Đang áp dụng</option>
                      <option value="Hết hạn">Hết hạn</option>
                      <option value="Ẩn">Ẩn</option>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Ngày áp dụng</label>
                    <input type="date" name="ngay_ap_dung" class="form-control" id="exampleInputEmail1" placeholder="Nhập ngày áp dụng">
                    <?php if (isset($errors['ngay_ap_dung'])) : ?>
                      <span style="color: red;"><?= $errors['ngay_ap_dung'] ?></span>
                    <?php endif; ?>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Ngày hết hạn</label>
                    <input type="date" name="ngay_het_han" class="form-control" id="exampleInputEmail1" placeholder="Nhập ngày hết hạn">
                    <?php if (isset($errors['ngay_het_han'])) : ?>
                      <span style="color: red;"><?= $errors['ngay_het_han'] ?></span>
                    <?php endif; ?>
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Mô tả</label>
                  <textarea rows="6" type="text" name="mo_ta" class="form-control" id="exampleInputPassword1" placeholder="Mô tả"></textarea>
                </div>
              </div>

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Thêm</button>
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
<!-- /.control-sidebar -->
</div>
</body>

</html>


<?php
$content = ob_get_clean();

// Hiển thị layout với nội dung
view('layouts.AdminLayout', [
  'title' => $title ?? 'Thêm chính sách - Website Quản Lý Tour',
  'pageTitle' => 'Thêm chính sách',
  'content' => $content,
  'breadcrumb' => [
    ['label' => 'Thêm chính sách', 'url' => BASE_URL . 'policy', 'active' => true],
  ],
]);
?>