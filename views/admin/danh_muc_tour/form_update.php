<?php
ob_start();


?>

<div class="content-wrapper">

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-edit"></i> Cập nhật Danh mục Tour</h3>
                        </div>

                        <form action="update-danh-muc-tour" method="POST">
                            <input type="hidden" name="id" value="<?= $danhMuc['id'] ?>">

                            <div class="card-body">

                                <div class="form-group">
                                    <label for="ten_danh_muc">Tên danh mục</label>
                                    <input value="<?= htmlspecialchars($danhMuc['ten_danh_muc']) ?>" type="text"
                                        name="ten_danh_muc" class="form-control" id="ten_danh_muc"
                                        placeholder="Nhập tên danh mục">
                                    <?php if (isset($errors['ten_danh_muc'])) : ?>
                                        <span class="text-danger small mt-1 d-block"><?= $errors['ten_danh_muc'] ?></span>
                                    <?php endif; ?>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="loai_danh_muc">Loại</label>
                                        <select name="loai" class="form-control" id="loai_danh_muc">
                                            <option value="Trong nước"
                                                <?= $danhMuc['loai'] == 'Trong nước' ? 'selected' : '' ?>>Trong nước
                                            </option>

                                            <option value="Quốc tế"
                                                <?= $danhMuc['loai'] == 'Quốc tế' ? 'selected' : '' ?>>Quốc tế</option>



                                        </select>
                                        <?php if (isset($errors['loai'])) : ?>
                                            <span class="text-danger small mt-1 d-block"><?= $errors['loai'] ?></span>
                                        <?php endif; ?>
                                    </div>

                                    <div class="form-group col-md-6">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="mo_ta">Mô tả</label>
                                    <textarea rows="6" name="mo_ta" class="form-control" id="mo_ta"
                                        placeholder="Mô tả chi tiết về danh mục tour này"><?= htmlspecialchars($danhMuc['mo_ta']) ?></textarea>
                                </div>

                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Cập
                                    nhật</button>
                                <a href="danh-muc-tour" class="btn btn-secondary ml-2"><i
                                        class="fas fa-arrow-left"></i> Quay lại</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<aside class="control-sidebar control-sidebar-dark">
</aside>

<?php
$content = ob_get_clean();

view('layouts.AdminLayout', [
    'title' => $title ?? 'Cập nhật danh mục tour - Website Quản Lý Tour',
    'pageTitle' => 'Cập nhật Danh Mục Tour',
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Danh mục tour', 'url' => BASE_URL . 'danh-muc-tour', 'active' => false],
        ['label' => 'Cập nhật', 'url' => '#', 'active' => true],
    ],
]);
?>