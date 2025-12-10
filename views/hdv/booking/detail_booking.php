<?php
ob_start();
?>

<div class="content-wrapper">
    <section class="content ">
        <div class="container-fluid mb-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline mb-5">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-info-circle"></i> Thông tin booking
                            </h3>
                            <div class="card-tools">
                                <a href="update-booking-hdv-form&booking_id=<?= $booking['id'] ?>" style="color: white;"
                                    class="btn btn-sm btn-success">
                                    <i class="fas fa-edit"></i> Cập nhật chuyến đi
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <dl class="row">
                                <dt class="col-sm-4">Tên tour:</dt>
                                <dd class="col-sm-8"><?= htmlspecialchars($booking['ten_tour']) ?></dd>

                                <dt class="col-sm-4">Người phụ trách:</dt>
                                <dd class="col-sm-8"><?php
                                $currentUser = getCurrentUser();
                                echo htmlspecialchars($currentUser->ho_ten);
                                echo ' (' . htmlspecialchars($currentUser->email) . ')';
                                ?></dd>
                                <dt class="col-sm-4">Ngày khởi hành:</dt>
                                <dd class="col-sm-8">
                                    <span class=""><?= date('d-m-Y', strtotime($booking['ngay_dat'])) ?></span>
                                </dd>

                                <dt class="col-sm-4">Trạng thái</dt>
                                <dd class="col-sm-8">
                                    <span class=""><?php
                                    if ($booking['booking_trang_thai'] == "DaXacNhan")
                                        echo "Đã xác nhận";
                                    else if ($booking['booking_trang_thai'] == "ChoDuyet")
                                        echo "Chờ duyệt";
                                    else if ($booking['booking_trang_thai'] == "Huy")
                                        echo "Đã huỷ";
                                    else if ($booking['booking_trang_thai'] == "HoanThanh")
                                        echo "Hoàn thành";
                                    ?></span>
                                </dd>

                                <dt class="col-sm-4">Giá tiền</dt>
                                <dd class="col-sm-8">
                                    <span
                                        class=""><?= number_format($booking['gia_tien'], 0, ',', '.') . ' VND' ?></span>
                                </dd>

                                <dt class="col-sm-4">Loại tour</dt>
                                <dd class="col-sm-8">
                                    <span class=""><?= htmlspecialchars($booking['loai_tour']) ?></span>
                                </dd>

                                <dt class="col-sm-4">Địa điểm</dt>
                                <dd class="col-sm-8">
                                    <span class=""><?= htmlspecialchars($booking['dia_diem']) ?></span>
                                </dd>

                                <dt class="col-sm-4">Lịch trình</dt>
                                                    <div class="border rounded p-3 bg-light">
                        <?= nl2br(htmlspecialchars($tour['lich_trinh'])) ?>
                    </div>
                                <dd class="col-sm-8">
                                    <span class=""><?= htmlspecialchars($booking['lich_trinh']) ?></span>
                                </dd>

                                <dt class="col-sm-4">Ghi chú</dt>
                                <dd class="col-sm-8">
                                    <span class=""><?= htmlspecialchars($booking['ghi_chu']) ?></span>
                                </dd>

                                <dt class="col-sm-4">Hình ảnh</dt>
                                <dd class="col-sm-8">
                                    <img src="<?= BASE_URL . 'uploads/tours/' . htmlspecialchars($booking['hinh_anh']) ?>"
                                        alt="Ảnh tour" style="max-width: 200px; border-radius: 8px;">
                                </dd>

                            </dl>
                        </div>
                    </div>

                    <script>
                        $(function () {
                            $("#lichTrinhTable").DataTable({
                                responsive: true,
                                lengthChange: false,
                                autoWidth: false,
                                buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"]
                            }).buttons()
                                .container()
                                .appendTo('#lichTrinhTable_wrapper .col-md-6:eq(0)');
                        });
                    </script>
                    <div class="card card-info card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-align-left"></i> Khách hàng trong tour
                            </h3>
                            <div class="card-tools">
                                <a href="check-in&id=<?= $booking['id'] ?>" style="color: white;"
                                    class="btn btn-sm btn-success">
                                    <i class="fas fa-trash"></i> Điểm danh
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Tên khách hàng</th>
                                            <th>Giới tính</th>
                                            <th>SĐT</th>
                                            <th>Ghi chú</th>
                                            <th>Trạng thái</th>
                                            <th>Điểm danh</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($customers as $key => $customer): ?>
                                            <tr>
                                                <td><?= $key + 1 ?></td>
                                                <td><?= htmlspecialchars($customer['ho_ten']) ?></td>
                                                <td><?= htmlspecialchars($customer['gioi_tinh']) ?></td>
                                                <td><?= htmlspecialchars($customer['so_dien_thoai']) ?></td>
                                                <td><?= htmlspecialchars($customer['ghi_chu']) ?></td>
                                                <td><?= htmlspecialchars($customer['trang_thai']) ?></td>
                                                <td><?php
                                                if ($customer['diem_danh'] == '1') {
                                                    echo 'Có mặt';
                                                } else if ($customer['diem_danh'] == '0') {
                                                    echo 'Chưa điểm danh';
                                                } else {
                                                    echo 'Vắng mặt';
                                                }
                                                ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<aside class="control-sidebar control-sidebar-dark"></aside>

<?php
$content = ob_get_clean();

// Hiển thị layout với nội dung
view('layouts.HDVLayout', [
    'title' => $title ?? 'Chi tiết Booking - Website Quản Lý Tour',
    'pageTitle' => 'Chi tiết Booking',
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Chi tiết Booking', 'url' => BASE_URL . 'booking', 'active' => true],
    ],
]);
?>