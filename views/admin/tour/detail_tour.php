<?php ob_start(); ?>
<div class="container mt-4">

    <!-- THÔNG TIN TOUR -->
    <div class="card shadow-sm mb-4 border-0">
        <div class="card-body">

            <h3 class="fw-bold mb-3"><?= htmlspecialchars($tour['ten_tour']) ?></h3>

            <div class="row g-4">

                <!-- CỘT TRÁI -->
                <div class="col-md-7">
                    <ul class="list-group list-group-flush small">
                        <li class="list-group-item px-0">
                            <strong>Danh mục:</strong> <?= htmlspecialchars($tour['ten_danh_muc'] ?? 'Chưa xác định') ?>
                        </li>
                        <li class="list-group-item px-0">
                            <strong>Địa điểm:</strong> <?= htmlspecialchars($tour['dia_diem']) ?>
                        </li>
                        <li class="list-group-item px-0">
                            <strong>Giá:</strong> <span class="text-danger fw-bold">
                                <?= number_format($tour['gia']) ?>đ
                            </span>
                        </li>
                        <li class="list-group-item px-0">
                            <strong>Nhà cung cấp:</strong> <?= htmlspecialchars($tour['nha_cung_cap']) ?>
                        </li>
                        <li class="list-group-item px-0">
                            <strong>Loại tour:</strong> <?= htmlspecialchars($tour['loai_tour']) ?>
                        </li>
                        <li class="list-group-item px-0">
                            <strong>Trạng thái:</strong>
                            <span
                                class="badge <?= $tour['trang_thai'] === 'Hoạt động' ? 'bg-success' : 'bg-secondary' ?> px-3 py-2">
                                <?= $tour['trang_thai'] === 'Hoạt động' ? 'Hoạt động' : 'Tạm dừng' ?>
                            </span>
                        </li>
                    </ul>

                    <p class="mt-4 mb-1 fw-semibold">Lịch trình:</p>
                    <div class="border rounded p-3 bg-light">
                        <?= nl2br(htmlspecialchars($tour['lich_trinh'])) ?>
                    </div>
                </div>

                <!-- CỘT PHẢI -->
                <div class="col-md-5 text-center">
                    <?php if (!empty($tour['hinh_anh'])): ?>
                        <img src="uploads/tours/<?= htmlspecialchars($tour['hinh_anh']) ?>"
                            class="img-fluid rounded shadow-sm" style="max-height: 300px; object-fit: cover;">
                    <?php else: ?>
                        <div class="text-muted fst-italic">Không có hình ảnh</div>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </div>


    <!-- CHÍNH SÁCH ÁP DỤNG -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-0">Chính sách áp dụng</h5>
            </div>
        </div>

        <div class="card-body">

            <?php if (!empty($policies)): ?>

                <div class="table-responsive">
                    <table id="policyTable" class="table table-bordered table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>STT</th>
                                <th>Tên chính sách</th>
                                <th>Loại</th>
                                <th>Ngày áp dụng</th>
                                <th>Ngày hết hạn</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($policies as $key => $policy): ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><?= htmlspecialchars($policy['ten_chinh_sach']) ?></td>
                                    <td><?= htmlspecialchars($policy['loai_chinh_sach']) ?></td>
                                    <td><?= date('d-m-Y', strtotime($policy['ngay_ap_dung'])) ?></td>
                                    <td><?= date('d-m-Y', strtotime($policy['ngay_het_han'])) ?></td>

                                    <td>
                                        <?php
                                        $status = $policy['trang_thai'];
                                        $badge = $status === 'Đang áp dụng' ? 'bg-success' : 'bg-danger';
                                        ?>
                                        <span class="badge <?= $badge ?> px-3 py-2"><?= $status ?></span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            <?php else: ?>
                <div class="alert alert-light border text-muted">Tour này chưa áp dụng chính sách nào.</div>
            <?php endif; ?>

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
                    <table class="table table-striped table-bordered align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Ảnh</th>
                                <th>Tiêu đề</th>
                                <th>Ngày</th>
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
                                            <img src="<?= BASE_URL . 'uploads/tour_lich_trinh/' . $lt['hinh_anh'] ?>" width="70"
                                                class="rounded shadow-sm">
                                        <?php else: ?>
                                            <span class="text-muted">Không có</span>
                                        <?php endif; ?>
                                    </td>

                                    <td><?= htmlspecialchars($lt['tieu_de']) ?></td>

                                    <td><?= !empty($lt['ngay_thu']) ? date("d/m/Y", strtotime($lt['ngay_thu'])) : '---' ?></td>

                                    <td><?= $lt['thu_tu'] ?></td>

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

</div>

<script>
    $(function () {
        $("#policyTable").DataTable({
            responsive: true,
            lengthChange: false,
            autoWidth: false,
            buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#policyTable_wrapper .col-md-6:eq(0)');
    });
</script>

<?php
$content = ob_get_clean();

view('layouts.AdminLayout', [
    'title' => $title ?? 'Chi tiết Tour - Hệ thống quản lý Tour',
    'pageTitle' => 'Chi tiết Tour',
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Quản lý Tour', 'url' => BASE_URL . 'tour', 'active' => false],
        ['label' => 'Chi tiết Tour', 'url' => '#', 'active' => true],
    ],
]);
?>