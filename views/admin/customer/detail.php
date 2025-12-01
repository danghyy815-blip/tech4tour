<?php
// Bắt đầu bộ đệm đầu ra
ob_start();

// Gán biến customer (giả sử được Controller truyền vào)
// Cung cấp một mảng rỗng mặc định nếu không tồn tại để tránh lỗi
$customer = $customer ?? [];

// Helper function để lấy giá trị hoặc chuỗi mặc định nếu không tồn tại
function get_customer_value($customer, $key, $default = 'Chưa cập nhật')
{
    return htmlspecialchars($customer[$key] ?? $default);
}
?>

<div class="content-wrapper">

    <section class="content">
        <div class="container-fluid mb-5">
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <div class="card card-success card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-user-circle"></i> Hồ sơ Khách hàng
                            </h3>
                            <div class="card-tools">
                                <!-- Nút Sửa -->
                                <a href="<?= BASE_URL . '?act=form-update-khach-hang&id=' . get_customer_value($customer, 'id', 0) ?>"
                                    class="btn btn-sm btn-info">
                                    <i class="fas fa-edit"></i> Sửa
                                </a>
                                <!-- Nút Quay lại -->
                                <a href="<?= BASE_URL . '?act=khach-hang' ?>" class="btn btn-sm btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Quay lại
                                </a>
                            </div>
                        </div>

                        <div class="card-body">
                            <?php if (empty($customer)) : ?>
                                <div class="alert alert-danger text-center">
                                    Không tìm thấy thông tin khách hàng.
                                </div>
                            <?php else : ?>
                                <dl class="row">
                                    <!-- Cột ID và Họ Tên -->
                                    <dt class="col-sm-4">ID Khách hàng:</dt>
                                    <dd class="col-sm-8 font-weight-bold text-primary">
                                        #<?= get_customer_value($customer, 'id') ?>
                                    </dd>

                                    <dt class="col-sm-4">Họ và Tên:</dt>
                                    <dd class="col-sm-8 font-weight-bold">
                                        <?= get_customer_value($customer, 'ho_ten') ?>
                                    </dd>

                                    <!-- Cột Liên hệ -->
                                    <dt class="col-sm-4">Email:</dt>
                                    <dd class="col-sm-8"><?= get_customer_value($customer, 'email') ?></dd>

                                    <dt class="col-sm-4">Số điện thoại:</dt>
                                    <dd class="col-sm-8"><?= get_customer_value($customer, 'so_dien_thoai') ?></dd>

                                    <hr class="col-12 my-3">

                                    <!-- Cột Thông tin cá nhân -->
                                    <dt class="col-sm-4">Giới tính:</dt>
                                    <dd class="col-sm-8"><?= get_customer_value($customer, 'gioi_tinh') ?></dd>

                                    <dt class="col-sm-4">Ngày sinh:</dt>
                                    <dd class="col-sm-8">
                                        <?php
                                        $dob = get_customer_value($customer, 'ngay_sinh', 'Chưa cập nhật');
                                        echo ($dob != 'Chưa cập nhật' && $dob != '') ? date('d/m/Y', strtotime($dob)) : $dob;
                                        ?>
                                    </dd>

                                    <dt class="col-sm-4">CCCD/Passport:</dt>
                                    <dd class="col-sm-8"><?= get_customer_value($customer, 'cccd') ?></dd>

                                    <dt class="col-sm-4">Quốc tịch:</dt>
                                    <dd class="col-sm-8"><?= get_customer_value($customer, 'quoc_tich') ?></dd>

                                    <dt class="col-sm-4">Địa chỉ:</dt>
                                    <dd class="col-sm-8"><?= get_customer_value($customer, 'dia_chi') ?></dd>

                                    <hr class="col-12 my-3">

                                    <!-- Cột Quản lý -->
                                    <dt class="col-sm-4">Ngày đăng ký:</dt>
                                    <dd class="col-sm-8">
                                        <?= date('H:i:s d/m/Y', strtotime(get_customer_value($customer, 'ngay_dang_ky'))) ?>
                                    </dd>

                                    <dt class="col-sm-4">Trạng thái:</dt>
                                    <dd class="col-sm-8">
                                        <?php
                                        $status = get_customer_value($customer, 'trang_thai');
                                        $status_color = 'secondary';
                                        if ($status == 'đang hoạt động') {
                                            $status_color = 'success';
                                        } elseif ($status == 'ngừng liên lạc') {
                                            $status_color = 'warning';
                                        }
                                        ?>
                                        <span class="badge badge-<?= $status_color ?>">
                                            <?= $status ?>
                                        </span>
                                    </dd>
                                </dl>

                                <hr>

                                <h4><i class="fas fa-lightbulb"></i> Yêu cầu đặc biệt/Ghi chú</h4>
                                <div class="text-muted border p-3 rounded bg-light">
                                    <p class="m-0"><?= nl2br(get_customer_value($customer, 'yeu_cau_dac_biet')) ?></p>
                                </div>
                            <?php endif; ?>
                        </div>
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
    'title' => $title ?? 'Chi tiết Khách Hàng - Hệ thống Khách sạn/Du lịch',
    'pageTitle' => 'Chi tiết Khách Hàng',
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Khách hàng', 'url' => BASE_URL . '?act=khach-hang', 'active' => false],
        ['label' => 'Chi tiết', 'url' => '#', 'active' => true],
    ],
]);
?>