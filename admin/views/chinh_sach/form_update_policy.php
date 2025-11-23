   <?php include_once './views/layout/header.php'; ?>
   <?php include_once './views/layout/navbar.php'; ?>
   <?php include_once './views/layout/sidebar.php'; ?>


   <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <section class="content-header">
       <div class="container-fluid">
         <div class="row mb-2">
           <div class="col-sm-6">
             <h1>Quản lý chính sách</h1>
           </div>
           <div class="col-sm-6">
             <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="#">Home</a></li>
               <li class="breadcrumb-item active">Quản lý chính sách</li>
             </ol>
           </div>
         </div>
       </div><!-- /.container-fluid -->
     </section>

     <!-- Main content -->
     <section class="content">
       <div class="container-fluid">
         <div class="row">
           <div class="col-12">
             <div class="card card-primary">
               <div class="card-header">
                 <h3 class="card-title">Cập nhật chính sách</h3>
               </div>
               <form action="?act=update-policy" method="POST">
                  <input type="hidden" name="id" value="<?= $policy['id'] ?>">
                 <div class="card-body">
                   <div class="form-group">
                     <label for="exampleInputEmail1">Tên chính sách</label>
                     <input value="<?= $policy['ten_chinh_sach'] ?>" type="text" name="ten_chinh_sach" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên chính sách">
                     <?php if (isset($errors['ten_chinh_sach'])) : ?>
                       <span style="color: red;"><?= $errors['ten_chinh_sach'] ?></span>
                     <?php endif; ?>
                   </div>
                   <div class="row">
                     <div class="form-group col-md-6">
                       <label for="exampleInputEmail1">Loại chính sách</label>
                       <select name="loai_chinh_sach" class="form-control" id="exampleInputEmail1">
                         <option value="Giảm giá" <?= $policy['loai_chinh_sach'] == 'Giảm giá' ? 'selected' : '' ?>>Giảm giá</option>
                         <option value="Hoàn tiền" <?= $policy['loai_chinh_sach'] == 'Hoàn tiền' ? 'selected' : '' ?>>Hoàn tiền</option>
                         <option value="Khuyến mãi" <?= $policy['loai_chinh_sach'] == 'Khuyến mãi' ? 'selected' : '' ?>>Khuyến mãi</option>
                         <option value="Khác" <?= $policy['loai_chinh_sach'] == 'Khác' ? 'selected' : '' ?>>Khác</option>
                       </select>
                     </div>
                     <div class="form-group col-md-6">
                       <label for="exampleInputEmail1">Trạng thái</label>
                       <select name="trang_thai" class="form-control" id="exampleInputEmail1">
                         <option value="Đang áp dụng" <?= $policy['trang_thai'] == 'Đang áp dụng' ? 'selected' : '' ?>>Đang áp dụng</option>
                         <option value="Hết hạn" <?= $policy['trang_thai'] == 'Hết hạn' ? 'selected' : '' ?>>Hết hạn</option>
                         <option value="Ẩn" <?= $policy['trang_thai'] == 'Ẩn' ? 'selected' : '' ?>>Ẩn</option>
                       </select>
                     </div>
                   </div>
                   <div class="row">
                     <div class="form-group col-md-6">
                       <label for="exampleInputEmail1">Ngày áp dụng</label>
                       <input value="<?= $policy['ngay_ap_dung'] ?>" type="date" name="ngay_ap_dung" class="form-control" id="exampleInputEmail1" placeholder="Nhập ngày áp dụng">
                       <?php if (isset($errors['ngay_ap_dung'])) : ?>
                         <span style="color: red;"><?= $errors['ngay_ap_dung'] ?></span>
                       <?php endif; ?>
                     </div>
                     <div class="form-group col-md-6">
                       <label for="exampleInputEmail1">Ngày hết hạn</label>
                       <input value="<?= $policy['ngay_het_han'] ?>" type="date" name="ngay_het_han" class="form-control" id="exampleInputEmail1" placeholder="Nhập ngày hết hạn">
                       <?php if (isset($errors['ngay_het_han'])) : ?>
                         <span style="color: red;"><?= $errors['ngay_het_han'] ?></span>
                       <?php endif; ?>
                     </div>
                   </div>
                   <div class="form-group">
                     <label for="exampleInputPassword1">Mô tả</label>
                     <textarea rows="6" type="text" name="mo_ta" class="form-control" id="exampleInputPassword1" placeholder="Mô tả"><?= $policy['mo_ta'] ?></textarea>
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
   <?php include_once './views/layout/footer.php'; ?>
   </div>
   </body>

   </html>