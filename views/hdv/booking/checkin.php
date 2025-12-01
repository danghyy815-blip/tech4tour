<?php
ob_start();
?>

<div class="content-wrapper">
    <section class="content ">
        <div class="container-fluid mb-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-info card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-align-left"></i> Điểm danh tour <strong><?= htmlspecialchars($booking['ten_tour']) ?>, khởi hàng ngày <?= date('d-m-Y', strtotime($booking['ngay_dat'])) ?></strong>
                            </h3>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="?act=update-checkin&booking_id=<?= $booking['id'] ?>">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Tên khách hàng</th>
                                            <th>Số điện thoại</th>
                                            <th>Ghi chú</th>
                                            <th>Điểm danh</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($customers as $key => $customer): ?>
                                            <tr>
                                                <td><?= $key + 1 ?></td>
                                                <td><?= htmlspecialchars($customer['ho_ten']) ?></td>
                                                <td><?= htmlspecialchars($customer['so_dien_thoai']) ?></td>
                                                <td>
                                                    <input type="text"
                                                        name="ghi_chu[<?= $customer['khach_hang_id'] ?>]"
                                                        value="<?= htmlspecialchars($customer['ghi_chu']) ?>"
                                                        class="form-control">
                                                </td>
                                                <td>
                                                    <select name="diem_danh[<?= $customer['khach_hang_id'] ?>]" class="form-control">
                                                        <option value="0" <?= $customer['diem_danh'] == '0' ? 'selected' : '' ?>>Chưa điểm danh</option>
                                                        <option value="1" <?= $customer['diem_danh'] == '1' ? 'selected' : '' ?>>Có mặt</option>
                                                        <option value="-1" <?= $customer['diem_danh'] == '-1' ? 'selected' : '' ?>>Vắng mặt</option>
                                                    </select>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>

                                <div class="text-end mt-3">
                                    <button class="btn btn-primary">
                                        <i class="bi bi-save"></i> Lưu điểm danh
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</section>
</div>

<aside class="control-sidebar control-sidebar-dark"></aside>

<script>
    function confirmDelete() {
        return confirm('Bạn chắc chắn muốn xóa Booking này? Hành động không thể hoàn tác.');
    }
</script>

<?php
$content = ob_get_clean();

// Hiển thị layout với nội dung
view('layouts.HDVLayout', [
    'title' => $title ?? 'Điểm danh - Website Quản Lý Tour',
    'pageTitle' => 'Điểm danh',
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Điểm danh', 'url' => BASE_URL_HDV . 'booking', 'active' => true],
    ],
]);
?>