<?php
ob_start();

$ho_ten = $_POST['ho_ten'] ?? '';
$gioi_tinh = $_POST['gioi_tinh'] ?? '';
$ngay_sinh = $_POST['ngay_sinh'] ?? '';
$so_dien_thoai = $_POST['so_dien_thoai'] ?? '';
$email = $_POST['email'] ?? '';
$dia_chi = $_POST['dia_chi'] ?? '';
$cccd = $_POST['cccd'] ?? '';
$quoc_tich = $_POST['quoc_tich'] ?? '';
$yeu_cau_dac_biet = $_POST['yeu_cau_dac_biet'] ?? '';
$trang_thai = $_POST['trang_thai'] ?? 'đang hoạt động';

$errors = $errors ?? [];

?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Thêm Khách Hàng Mới</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-user-plus"></i> Thông tin Khách hàng</h3>
                        </div>

                        <form action="<?= BASE_URL . '?act=add-khach-hang' ?>" method="POST">
                            <div class="card-body">

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="ho_ten">Họ tên <span class="text-danger">*</span></label>
                                        <input type="text" name="ho_ten" class="form-control" id="ho_ten"
                                            placeholder="Nhập họ và tên" value="<?= htmlspecialchars($ho_ten) ?>">
                                        <?php if (isset($errors['ho_ten'])) : ?>
                                            <span class="text-danger small mt-1 d-block"><?= $errors['ho_ten'] ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Giới tính <span class="text-danger">*</span></label>
                                        <div class="d-flex align-items-center mt-2">
                                            <div class="custom-control custom-radio mr-4">
                                                <input class="custom-control-input" type="radio" id="genderNam"
                                                    name="gioi_tinh" value="Nam"
                                                    <?= ($gioi_tinh == 'Nam') ? 'checked' : '' ?>>
                                                <label for="genderNam"
                                                    class="custom-control-label font-weight-normal">Nam</label>
                                            </div>
                                            <div class="custom-control custom-radio mr-4">
                                                <input class="custom-control-input" type="radio" id="genderNu"
                                                    name="gioi_tinh" value="Nữ"
                                                    <?= ($gioi_tinh == 'Nữ') ? 'checked' : '' ?>>
                                                <label for="genderNu"
                                                    class="custom-control-label font-weight-normal">Nữ</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="genderKhac"
                                                    name="gioi_tinh" value="Khác"
                                                    <?= ($gioi_tinh == 'Khác') ? 'checked' : '' ?>>
                                                <label for="genderKhac"
                                                    class="custom-control-label font-weight-normal">Khác</label>
                                            </div>
                                        </div>
                                        <?php if (isset($errors['gioi_tinh'])) : ?>
                                            <span class="text-danger small mt-1 d-block"><?= $errors['gioi_tinh'] ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="ngay_sinh">Ngày sinh</label>
                                        <input type="date" name="ngay_sinh" class="form-control" id="ngay_sinh"
                                            value="<?= htmlspecialchars($ngay_sinh) ?>">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="quoc_tich">Quốc tịch</label>
                                        <input type="text" name="quoc_tich" class="form-control" id="quoc_tich"
                                            placeholder="Ví dụ: Việt Nam" value="<?= htmlspecialchars($quoc_tich) ?>">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="cccd">Số CCCD/Passport</label>
                                        <input type="text" name="cccd" class="form-control" id="cccd"
                                            placeholder="Nhập CCCD (nếu có)" value="<?= htmlspecialchars($cccd) ?>">
                                        <?php if (isset($errors['cccd'])) : ?>
                                            <span class="text-danger small mt-1 d-block"><?= $errors['cccd'] ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="so_dien_thoai">Số điện thoại <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="so_dien_thoai" class="form-control" id="so_dien_thoai"
                                            placeholder="Nhập số điện thoại (10 hoặc 11 số)"
                                            value="<?= htmlspecialchars($so_dien_thoai) ?>">
                                        <?php if (isset($errors['so_dien_thoai'])) : ?>
                                            <span
                                                class="text-danger small mt-1 d-block"><?= $errors['so_dien_thoai'] ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="email">Email <span class="text-danger">*</span></label>
                                        <input type="email" name="email" class="form-control" id="email"
                                            placeholder="Nhập địa chỉ email" value="<?= htmlspecialchars($email) ?>">
                                        <?php if (isset($errors['email'])) : ?>
                                            <span class="text-danger small mt-1 d-block"><?= $errors['email'] ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="dia_chi">Địa chỉ</label>
                                    <input type="text" name="dia_chi" class="form-control" id="dia_chi"
                                        placeholder="Nhập địa chỉ chi tiết" value="<?= htmlspecialchars($dia_chi) ?>">
                                </div>

                                <div class="form-group">
                                    <label for="yeu_cau_dac_biet">Yêu cầu đặc biệt</label>
                                    <textarea rows="3" name="yeu_cau_dac_biet" class="form-control"
                                        id="yeu_cau_dac_biet"
                                        placeholder="Ghi chú về yêu cầu hoặc sở thích đặc biệt của khách hàng"><?= htmlspecialchars($yeu_cau_dac_biet) ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="trang_thai">Trạng thái</label>
                                    <select name="trang_thai" class="form-control" id="trang_thai">
                                        <option value="đang hoạt động"
                                            <?= ($trang_thai == 'đang hoạt động') ? 'selected' : '' ?>>Đang hoạt động
                                        </option>
                                        <option value="ngừng liên lạc"
                                            <?= ($trang_thai == 'ngừng liên lạc') ? 'selected' : '' ?>>Ngừng liên lạc
                                        </option>
                                    </select>
                                </div>

                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Thêm Khách
                                    hàng</button>
                                <a href="<?= BASE_URL . '?act=khach-hang' ?>" class="btn btn-secondary ml-2"><i
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
    'title' => $title ?? 'Thêm Khách Hàng - Hệ thống Khách sạn/Du lịch',
    'pageTitle' => 'Thêm Khách Hàng Mới',
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Khách hàng', 'url' => BASE_URL . '?act=khach-hang', 'active' => false],
        ['label' => 'Thêm mới', 'url' => '#', 'active' => true],
    ],
]);
?>