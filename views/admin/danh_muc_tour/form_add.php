<?php
ob_start();
?>

<style>
    .cat-form-card { border: 1px solid #e5e7eb; border-radius: 10px; background: #fff; }
    .cat-form-card .card-header { background: #f8fafc; border-bottom: 1px solid #e5e7eb; padding: 16px 20px; }
    .cat-form-card .card-body { padding: 20px; }
    .cat-form-card .card-footer { padding: 16px 20px; background: #f9fafb; border-top: 1px solid #e5e7eb; }
    label { font-weight: 600; margin-bottom: 6px; display: block; }
    .form-control, select.form-control, textarea.form-control {
        border-radius: 6px;
        border: 1px solid #e5e7eb;
        height: 42px;
        padding: 0 12px;
    }
    textarea.form-control { height: auto; padding-top: 10px; padding-bottom: 10px; }
    .form-control:focus { border-color: #2563eb; box-shadow: 0 0 0 3px rgba(37,99,235,0.15); }
    .btn-submit { background: #16a34a; border: none; padding: 10px 20px; border-radius: 6px; color: #fff; font-weight: 600; }
    .btn-submit:hover { background: #15803d; }
    .btn-secondary-custom { background: #6b7280; border: none; padding: 10px 20px; border-radius: 6px; color: #fff; font-weight: 600; }
</style>


<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card cat-form-card shadow-sm">
                        <div class="card-header">
                            <h5 class="mb-0 fw-semibold"><i class="fas fa-plus-circle"></i> Thêm Danh mục Tour</h5>
                        </div>

                        <form action="add-danh-muc-tour" method="POST">
                            <div class="card-body">

                                <div class="form-group mb-4">
                                    <label for="ten_danh_muc">Tên danh mục <span class="text-danger">*</span></label>
                                    <input type="text" name="ten_danh_muc" class="form-control" id="ten_danh_muc"
                                        placeholder="Nhập tên danh mục tour"
                                        value="<?= htmlspecialchars($_POST['ten_danh_muc'] ?? '') ?>">
                                    <?php if (isset($errors['ten_danh_muc'])) : ?>
                                        <span class="error-text"><?= $errors['ten_danh_muc'] ?></span>
                                    <?php endif; ?>
                                </div>

                                <div class="form-row mb-4">
                                    <div class="form-group">
                                        <label for="loai_danh_muc">Loại</label>
                                        <select name="loai" class="form-control" id="loai_danh_muc">
                                            <option value="Trong nước"
                                                <?= (isset($_POST['loai']) && $_POST['loai'] === 'Trong nước') || !isset($_POST['loai']) ? 'selected' : '' ?>>
                                                Trong nước
                                            </option>
                                            <option value="Quốc tế"
                                                <?= isset($_POST['loai']) && $_POST['loai'] === 'Quốc tế' ? 'selected' : '' ?>>
                                                Quốc tế
                                            </option>
                                        </select>

                                        <?php if (isset($errors['loai'])) : ?>
                                            <span class="error-text"><?= $errors['loai'] ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="mo_ta">Mô tả</label>
                                    <textarea rows="4" name="mo_ta" class="form-control" id="mo_ta"
                                        placeholder="Mô tả chi tiết về danh mục tour này"><?= htmlspecialchars($_POST['mo_ta'] ?? '') ?></textarea>
                                </div>

                            </div>

                            <div class="card-footer d-flex gap-2">
                                <button type="submit" class="btn-submit"><i class="fas fa-save"></i> Thêm danh mục</button>
                                <a href="danh-muc-tour" class="btn-secondary-custom text-decoration-none text-white"><i class="fas fa-arrow-left"></i> Quay lại</a>
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
    'breadcrumb' => [ //
        ['label' => 'Danh mục tour', 'url' => BASE_URL . 'danh-muc-tour', 'active' => false],
        ['label' => 'Thêm mới', 'url' => '#', 'active' => true],
    ],
]);
?>