<?php
ob_start();


?><style>
    :root {
        --primary: #4a6cf7;
        /* Xanh dương (Blue) */
        --primary-hover: #3d5ae5;
        --border: #dcdcdc;
        --radius: 10px;
        --input-radius: 6px;
        /* THÊM MÀU XANH LÁ (Green) CHO NÚT THÊM - TÔI ĐẶT MỘT BIẾN MỚI */
        --success-btn: #28a745;
        --success-hover: #218838;
    }

    /* Đổi màu header nếu cần theo yêu cầu, nhưng tôi giữ màu primary: #4a6cf7 (Xanh Dương) để khớp với ảnh 2 */
    .card-header {
        background: #28a745;
        padding: 18px 24px;
    }

    .card {
        border-radius: var(--radius);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        border: 1px solid var(--border);
        /* Thêm border nhẹ */
    }

    .card-title {
        color: #fff;
        font-size: 18px;
        font-weight: 600;
        margin: 0;
    }

    .card-body {
        padding: 25px 30px;
    }

    .card-footer {
        padding: 20px 30px;
        /* Giả sử bạn muốn footer có nền trắng giống ảnh */
        background-color: #fff;
        border-top: 1px solid var(--border);
    }

    /* CSS cho các nút - THAY ĐỔI THEO MẪU 2 */
    .btn-submit {
        background: var(--success-btn);
        /* Xanh lá */
        padding: 10px 26px;
        border-radius: 6px;
        border: none;
        font-weight: 600;
        color: white;
    }

    .btn-submit:hover {
        background: var(--success-hover);
    }

    .btn-secondary-custom {
        background: #6c757d;
        /* Xám */
        padding: 10px 26px;
        border-radius: 6px;
        border: none;
        font-weight: 600;
        color: white;
        margin-left: 10px;
        cursor: pointer;
    }

    .btn-secondary-custom:hover {
        background: #5a6268;
    }


    /* Giữ nguyên các phần CSS còn lại của bạn */
    label {
        font-weight: 600;
        margin-bottom: 4px;
        display: block;
    }

    .form-control {
        height: 44px;
        border-radius: var(--input-radius);
        border: 1px solid var(--border);
        padding: 0 12px;
        transition: .2s;
    }

    .form-control:focus {
        border: 1px solid var(--primary);
        box-shadow: 0 0 0 3px rgba(74, 108, 247, 0.2);
    }

    .invalid {
        border-color: red !important;
    }

    .error-text {
        color: red;
        font-size: 13px;
        margin-top: 4px;
    }

    .form-row {
        display: flex;
        gap: 20px;
        margin-bottom: 18px;
    }

    .form-group {
        flex: 1;
        display: flex;
        flex-direction: column;
    }
</style>

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
                                <a href="danh-muc-tour" class="btn btn-secondary ml-2"><i class="fas fa-arrow-left"></i>
                                    Quay lại</a>
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