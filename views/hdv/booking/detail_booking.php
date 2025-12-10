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
                    <!-- LỊCH TRÌNH CHI TIẾT -->
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header bg-dark text-white">
                            <h5 class="mb-0">Lịch trình của tour</h5>
                        </div>

                        <div class="card-body">
                            <?php if (empty($lichTrinh)): ?>
                                <p class="text-muted">Tour này chưa có lịch trình.</p>
                            <?php else: ?>
                                <div class="table-responsive">
                                    <table id="lichTrinhTable" class="table table-striped table-bordered align-middle">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>ID</th>
                                                <th>Ảnh</th>
                                                <th>Tiêu đề</th>
                                                <th>Ngày bắt đầu</th>
                                                <th>Ngày kết thúc</th>
                                                <th>Thứ tự</th>
                                                <th>Nội dung</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($lichTrinh as $lt): ?>
                                                <tr>
                                                    <td><?= $lt['id'] ?></td>

                                                    <td>
                                                        <?php if (!empty($lt['hinh_anh'])): ?>
                                                            <?php
                                                            $imagePath = BASE_URL . 'public/uploads/tour_lich_trinh/' . htmlspecialchars($lt['hinh_anh']);
                                                            ?>
                                                            <img src="<?= $imagePath ?>" class="thumb-sm" alt="thumb"
                                                                style="width: 150px; height: 100px;"
                                                                onerror="console.error('Image not found:', this.src); this.style.display='none'; this.nextElementSibling.style.display='block';">
                                                            <span class="text-danger small" style="display:none;">Ảnh lỗi</span>
                                                        <?php else: ?>
                                                            <span class="text-muted small">Không có ảnh</span>
                                                        <?php endif; ?>
                                                    </td>

                                                    <!-- Tiêu đề -->
                                                    <td><?= htmlspecialchars($lt['tieu_de']) ?></td>

                                                    <!-- Ngày bắt đầu -->
                                                    <td><?= !empty($lt['ngay_bat_dau']) ? date("d/m/Y", strtotime($lt['ngay_bat_dau'])) : '---' ?>
                                                    </td>

                                                    <!-- Ngày kết thúc -->
                                                    <td><?= !empty($lt['ngay_ket_thuc']) ? date("d/m/Y", strtotime($lt['ngay_ket_thuc'])) : '---' ?>
                                                    </td>

                                                    <!-- Thứ tự -->
                                                    <td><?= $lt['thu_tu'] ?></td>

                                                    <!-- Nội dung -->
                                                    <td style="white-space: pre-line;">
                                                        <?= nl2br(htmlspecialchars($lt['noi_dung'])) ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php endif; ?>
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