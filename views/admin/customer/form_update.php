<?php
// Bắt đầu bộ đệm đầu ra
ob_start();

// Gán biến customer (giả sử được Controller truyền vào)
// Cung cấp một mảng rỗng mặc định nếu không tồn tại để tránh lỗi
$customer = $customer ?? [];
$errors = $errors ?? [];

// Hàm lấy giá trị ưu tiên từ POST, sau đó là từ $customer, cuối cùng là chuỗi rỗng
function get_update_value($key, $customer, $default = '') {
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

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Cập Nhật Khách Hàng: **<?= $ho_ten ?>**</h1>
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
                            <h3 class="card-title"><i class="fas fa-edit"></i> Thông tin Khách hàng</h3>
                        </div>

                        <form action="<?= BASE_URL . '?act=update-khach-hang' ?>" method="POST">
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
                                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Cập
                                    nhật</button>
                                <a href="<?= BASE_URL . '?act=detail-khach-hang&id=' . $id ?>"
                                    class="btn btn-info ml-2"><i class="fas fa-eye"></i> Xem Chi Tiết</a>
                                <a href="<?= BASE_URL . '?act=khach-hang' ?>" class="btn btn-secondary ml-2"><i
                                        class="fas fa-arrow-left"></i> Quay lại Danh sách</a>
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
        ['label' => 'Khách hàng', 'url' => BASE_URL . '?act=khach-hang', 'active' => false],
        ['label' => 'Cập nhật', 'url' => '#', 'active' => true],
    ],
]);
?>