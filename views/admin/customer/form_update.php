<?php
// Bắt đầu bộ đệm đầu ra
ob_start();

// Gán biến customer (giả sử được Controller truyền vào)
// Cung cấp một mảng rỗng mặc định nếu không tồn tại để tránh lỗi
$customer = $customer ?? [];
$errors = $errors ?? [];

// Hàm lấy giá trị ưu tiên từ POST, sau đó là từ $customer, cuối cùng là chuỗi rỗng
function get_update_value($key, $customer, $default = '')
{
    // Ưu tiên dữ liệu từ $_POST (sau khi submit form bị lỗi)
    if (isset($_POST[$key])) {
        return htmlspecialchars($_POST[$key]);
    }
    // Lấy dữ liệu từ database (lần đầu tải form)
    if (isset($customer[$key])) {
        return htmlspecialchars($customer[$key]);
    }
    return $default;
}

// Lấy các giá trị cho form
$id = get_update_value('id', $customer);
$ho_ten = get_update_value('ho_ten', $customer);
$gioi_tinh = get_update_value('gioi_tinh', $customer);
$ngay_sinh = get_update_value('ngay_sinh', $customer);
$so_dien_thoai = get_update_value('so_dien_thoai', $customer);
$email = get_update_value('email', $customer);
$dia_chi = get_update_value('dia_chi', $customer);
$cccd = get_update_value('cccd', $customer);
$quoc_tich = get_update_value('quoc_tich', $customer);
$yeu_cau_dac_biet = get_update_value('yeu_cau_dac_biet', $customer);
$trang_thai = get_update_value('trang_thai', $customer, 'đang hoạt động');

// Kiểm tra nếu không có ID (dữ liệu không hợp lệ)
if (empty($id)) {
    echo '<div class="content-wrapper"><section class="content"><div class="container-fluid"><div class="alert alert-danger">Không tìm thấy khách hàng cần cập nhật.</div></div></section></div>';
    $content = ob_get_clean();
    view('layouts.AdminLayout', ['title' => 'Lỗi', 'pageTitle' => 'Lỗi', 'content' => $content, 'breadcrumb' => []]);
    return;
}
?>

<style>
    :root {
        --primary: #4a6cf7;
        /* Xanh dương (Blue) - Cho Header */
        --primary-hover: #3d5ae5;
        --border: #dcdcdc;
        --radius: 10px;
        --input-radius: 6px;
        --success-btn: #28a745;
        /* Xanh lá - Cho nút Cập nhật */
        --success-hover: #218838;
        --info-btn: #17a2b8;
        /* Xanh dương nhạt - Cho nút Xem Chi Tiết */
        --info-hover: #138496;
    }

    .card {
        border-radius: var(--radius);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        border: 1px solid var(--border);
    }

    .card-header {
        background: #28a745;
        padding: 18px 24px;
        border-top-left-radius: var(--radius);
        border-top-right-radius: var(--radius);
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
        background-color: #f8f9fa;
        /* Màu nền nhẹ cho footer */
        border-top: 1px solid var(--border);
        border-bottom-left-radius: var(--radius);
        border-bottom-right-radius: var(--radius);
    }

    label {
        font-weight: 600;
        margin-bottom: 4px;
        display: block;
    }

    /* Áp dụng styling form-control */
    .form-control,
    select.form-control,
    textarea.form-control {
        height: 44px;
        border-radius: var(--input-radius);
        border: 1px solid var(--border);
        padding: 0 12px;
        transition: .2s;
        width: 100%;
    }

    textarea.form-control {
        height: auto;
        /* Cho phép textarea mở rộng */
        padding-top: 10px;
        padding-bottom: 10px;
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

    /* Các nút */
    .btn-submit {
        background: var(--success-btn);
        /* Xanh lá */
        padding: 10px 26px;
        border-radius: 6px;
        border: none;
        font-weight: 600;
        color: white;
        cursor: pointer;
        display: inline-block;
        text-decoration: none;
    }

    .btn-submit:hover {
        background: var(--success-hover);
    }

    .btn-info-custom {
        background: var(--info-btn);
        /* Xanh dương nhạt */
        padding: 10px 26px;
        border-radius: 6px;
        border: none;
        font-weight: 600;
        color: white;
        margin-left: 10px;
        cursor: pointer;
        display: inline-block;
        text-decoration: none;
    }

    .btn-info-custom:hover {
        background: var(--info-hover);
        color: white;
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
        display: inline-block;
        text-decoration: none;
    }

    .btn-secondary-custom:hover {
        background: #5a6268;
        color: white;
    }

    /* Custom cho Radio button để không bị lỗi layout */
    .custom-control {
        padding-left: 1.5rem;
        /* Điều chỉnh lại padding cho radio */
    }

    .custom-control-input:checked~.custom-control-label::before {
        border-color: var(--primary);
        background-color: var(--primary);
    }
</style>

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-edit"></i> Thông tin Khách hàng</h3>
                        </div>

                        <form action="<?= BASE_URL . 'update-khach-hang' ?>" method="POST">
                            <input type="hidden" name="id" value="<?= $id ?>">

                            <div class="card-body">

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="ho_ten">Họ tên <span class="text-danger">*</span></label>
                                        <input type="text" name="ho_ten" class="form-control" id="ho_ten"
                                            placeholder="Nhập họ và tên" value="<?= $ho_ten ?>">
                                        <?php if (isset($errors['ho_ten'])) : ?>
                                            <span class="text-danger small mt-1 d-block"><?= $errors['ho_ten'] ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Giới tính <span class="text-danger">*</span></label>
                                        <div class="d-flex align-items-center mt-2" style="height: 44px;">
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
                                            value="<?= $ngay_sinh ?>">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="quoc_tich">Quốc tịch</label>
                                        <input type="text" name="quoc_tich" class="form-control" id="quoc_tich"
                                            placeholder="Ví dụ: Việt Nam" value="<?= $quoc_tich ?>">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="cccd">Số CCCD/Passport</label>
                                        <input type="text" name="cccd" class="form-control" id="cccd"
                                            placeholder="Nhập CCCD (nếu có)" value="<?= $cccd ?>">
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
                                            value="<?= $so_dien_thoai ?>">
                                        <?php if (isset($errors['so_dien_thoai'])) : ?>
                                            <span
                                                class="text-danger small mt-1 d-block"><?= $errors['so_dien_thoai'] ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="email">Email <span class="text-danger">*</span></label>
                                        <input type="email" name="email" class="form-control" id="email"
                                            placeholder="Nhập địa chỉ email" value="<?= $email ?>">
                                        <?php if (isset($errors['email'])) : ?>
                                            <span class="text-danger small mt-1 d-block"><?= $errors['email'] ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="dia_chi">Địa chỉ</label>
                                    <input type="text" name="dia_chi" class="form-control" id="dia_chi"
                                        placeholder="Nhập địa chỉ chi tiết" value="<?= $dia_chi ?>">
                                </div>

                                <div class="form-group">
                                    <label for="yeu_cau_dac_biet">Yêu cầu đặc biệt</label>
                                    <textarea rows="3" name="yeu_cau_dac_biet" class="form-control"
                                        id="yeu_cau_dac_biet"
                                        placeholder="Ghi chú về yêu cầu hoặc sở thích đặc biệt của khách hàng"><?= $yeu_cau_dac_biet ?></textarea>
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
                                <button type="submit" class="btn-submit"><i class="fas fa-save"></i> Cập nhật</button>
                                <a href="<?= BASE_URL . 'detail-khach-hang&id=' . $id ?>" class="btn-info-custom"><i
                                        class="fas fa-eye"></i> Xem Chi Tiết</a>
                                <a href="<?= BASE_URL . 'khach-hang' ?>" class="btn-secondary-custom"><i
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

// Gọi hàm view để hiển thị layout Admin
view('layouts.AdminLayout', [
    'title' => $title ?? 'Cập nhật Khách Hàng - Hệ thống Khách sạn/Du lịch',
    'pageTitle' => 'Cập nhật Khách Hàng',
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Khách hàng', 'url' => BASE_URL . 'khach-hang', 'active' => false],
        ['label' => 'Cập nhật', 'url' => '#', 'active' => true],
    ],
]);
?>