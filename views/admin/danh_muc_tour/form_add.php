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
                            <h3 class="card-title"><i class="fas fa-plus-circle"></i> Thêm Danh mục Tour</h3>
                        </div>

                        <form action="add-danh-muc-tour" method="POST">
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="ten_danh_muc">Tên danh mục <span class="text-danger">*</span></label>
                                    <input type="text" name="ten_danh_muc" class="form-control" id="ten_danh_muc"
                                        placeholder="Nhập tên danh mục tour"
                                        value="<?= htmlspecialchars($_POST['ten_danh_muc'] ?? '') ?>">
                                    <?php if (isset($errors['ten_danh_muc'])) : ?>
                                        <span class="text-danger small mt-1 d-block"><?= $errors['ten_danh_muc'] ?></span>
                                    <?php endif; ?>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="loai_danh_muc">Loại</label>
                                        <select name="loai" class="form-control" id="loai_danh_muc">
                                            <option value="Trong nước"
                                                <?= (($_POST['loai'] ?? '') == 'Trong nước') ? 'selected' : '' ?>>Trong
                                                nước</option>
                                            <option value="Quốc tế"
                                                <?= (($_POST['loai'] ?? '') == 'Quốc tế') ? 'selected' : '' ?>>Quốc tế
                                            </option>
                                            <option value="Khác"
                                                <?= (($_POST['loai'] ?? '') == 'Khác') ? 'selected' : '' ?>>Khác
                                            </option>
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
                                    <textarea rows="4" name="mo_ta" class="form-control" id="mo_ta"
                                        placeholder="Mô tả chi tiết về danh mục tour này"><?= htmlspecialchars($_POST['mo_ta'] ?? '') ?></textarea>
                                </div>

                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Thêm danh
                                    mục</button>
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
    'title' => $title ?? 'Thêm danh mục tour - Website Quản Lý Tour',
    'pageTitle' => 'Thêm Danh Mục Tour',
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Danh mục tour', 'url' => BASE_URL . 'danh-muc-tour', 'active' => false],
        ['label' => 'Thêm mới', 'url' => '#', 'active' => true],
    ],
]);
?>