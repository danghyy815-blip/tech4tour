<?php
ob_start();
?>
<style>
    .tour-detail-wrapper {
        max-width: 1080px;
    }
    .badge-soft-primary { background: #e7f1ff; color: #1b4f9c; }
    .tour-hero {
        background: linear-gradient(120deg, #f0f6ff 0%, #f9fbff 100%);
        border: 1px solid #e5edf7;
        border-radius: 14px;
    }
    .tour-title {
        font-weight: 700;
        color: #1b3c87;
        margin-bottom: 8px;
    }
    .meta-label {
        color: #6c757d;
        font-size: 0.95rem;
    }
    .meta-value {
        font-weight: 600;
        color: #212529;
    }
    .price-chip {
        background: #fff3e0;
        color: #d35400;
        border: 1px solid #ffd8a8;
        font-weight: 700;
        padding: 10px 14px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .tour-image {
        max-height: 240px;
        object-fit: cover;
        border-radius: 10px;
        border: 1px solid #e8eef7;
        box-shadow: 0 6px 20px rgba(0,0,0,0.06);
    }
    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 12px;
    }
    .info-card {
        padding: 12px 14px;
        border: 1px solid #ecf0f5;
        border-radius: 10px;
        background: #fff;
    }
    .badge-soft-success { background: #e6f4ea; color: #1e8b4d; }
    .badge-soft-danger { background: #fde8e8; color: #d93025; }
    .policy-table th {
        background: #f4f6fa;
        color: #334155;
        border-bottom: 1px solid #e5e9f2;
    }
    .policy-table td {
        vertical-align: middle;
    }
</style>

<div class="container mt-4">

    <div class="card shadow mb-4">
        <div class="card-body">
            <h4><?= htmlspecialchars($tour['ten_tour']) ?></h4>

            <!-- Danh mục tour -->
            <p><strong>Danh mục:</strong> <?= htmlspecialchars($tour['ten_danh_muc'] ?? 'Chưa xác định') ?></p>

            <p><strong>Địa điểm:</strong> <?= htmlspecialchars($tour['dia_diem']) ?></p>
            <p><strong>Giá:</strong> <?= number_format($tour['gia']) ?>đ</p>
            <p><strong>Nhà cung cấp:</strong> <?= htmlspecialchars($tour['nha_cung_cap']) ?></p>
            <p><strong>Loại tour:</strong> <?= htmlspecialchars($tour['loai_tour']) ?></p>
            <p><strong>Trạng thái:</strong>
                <span class="badge <?= $tour['trang_thai'] === 'Hoạt động' ? 'bg-success' : 'bg-secondary' ?>">
                    <?= $tour['trang_thai'] === 'Hoạt động' ? 'Hoạt động' : 'Tạm dừng' ?>
                </span>
            </p>

            <p><strong>Lịch trình:</strong></p>
            <div class="border p-3 bg-light"><?= nl2br(htmlspecialchars($tour['lich_trinh'])) ?></div>

            <?php if (!empty($tour['hinh_anh'])): ?>
                <p class="mt-3"><strong>Hình ảnh:</strong></p>
                <img src="uploads/tours/<?= htmlspecialchars($tour['hinh_anh']) ?>" class="img-fluid rounded shadow-sm"
                    width="400">
            <?php endif; ?>
<div class="container mt-4 tour-detail-wrapper">
    <div class="tour-hero p-4 mb-4">
        <div class="row g-3 align-items-start">
            <div class="col-md-8">
                <h3 class="tour-title mb-2"><?= htmlspecialchars($tour['ten_tour']) ?></h3>
                <div class="d-flex flex-wrap gap-2 mb-3">
                    <span class="badge <?= $tour['trang_thai'] === 'Hoạt động' ? 'badge-soft-success' : 'badge-soft-danger' ?>">
                        <?= $tour['trang_thai'] === 'Hoạt động' ? 'Hoạt động' : 'Tạm dừng' ?>
                    </span>
                    <span class="badge badge-soft-primary fw-semibold"><?= htmlspecialchars($tour['loai_tour']) ?></span>
                    <span class="price-chip"><i class="fas fa-tag"></i><?= number_format($tour['gia']) ?>đ</span>
                </div>
                <div class="info-grid mb-3">
                    <div class="info-card">
                        <div class="meta-label">Danh mục</div>
                        <div class="meta-value"><?= htmlspecialchars($tour['ten_danh_muc'] ?? 'Chưa xác định') ?></div>
                    </div>
                    <div class="info-card">
                        <div class="meta-label">Địa điểm</div>
                        <div class="meta-value"><?= htmlspecialchars($tour['dia_diem']) ?></div>
                    </div>
                    <div class="info-card">
                        <div class="meta-label">Nhà cung cấp</div>
                        <div class="meta-value"><?= htmlspecialchars($tour['nha_cung_cap']) ?></div>
                    </div>
                    <div class="info-card">
                        <div class="meta-label">Ngày tạo</div>
                        <div class="meta-value"><?= !empty($tour['created_at']) ? date('d/m/Y', strtotime($tour['created_at'])) : '—' ?></div>
                    </div>
                </div>
                <div>
                    <p class="meta-label mb-1 fw-semibold">Lịch trình</p>
                    <div class="border p-3 bg-white rounded-3 shadow-sm" style="border-color:#e9eef5!important; line-height:1.6;">
                        <?= nl2br(htmlspecialchars($tour['lich_trinh'])) ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-center text-md-end">
                <?php if (!empty($tour['hinh_anh'])): ?>
                    <img src="uploads/tours/<?= htmlspecialchars($tour['hinh_anh']) ?>" alt="Hình ảnh tour" class="tour-image w-100 mb-2">
                <?php else: ?>
                    <div class="tour-image w-100 d-flex align-items-center justify-content-center bg-light text-muted">
                        Chưa có hình ảnh
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <!-- Bảng chính sách áp dụng -->
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white border-0 d-flex align-items-center justify-content-between">
            <div>
                <p class="text-uppercase text-muted small mb-1 fw-semibold">Chính sách</p>
                <h5 class="card-title mb-0">Chính sách áp dụng</h5>
            </div>
            <span class="badge bg-info text-dark"><?= !empty($policies) ? count($policies) . ' chính sách' : 'Chưa áp dụng' ?></span>
        </div>
        <div class="card-body pt-0">
            <?php if (!empty($policies) && is_array($policies)): ?>
                <table id="policyTable" class="table table-bordered table-striped">
            <div class="table-responsive">
                <table id="policyTable" class="table table-hover align-middle policy-table">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên chính sách</th>
                            <th>Loại chính sách</th>
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
                                    if ($status === 'Đang áp dụng')
                                        $badge = 'bg-success';
                                    elseif ($status === 'Hết hạn')
                                        $badge = 'bg-warning';
                                    else
                                        $badge = 'bg-secondary';
                                    ?>
                                    <span class="badge <?= $badge ?>"><?= $status ?></span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="alert alert-light border text-muted mb-0">Tour này chưa áp dụng chính sách nào.</div>
            <?php endif; ?>
        </div>
    </div>

    <div class="card shadow-sm mt-4">
        <div class="card-header">
            <h4 class="card-title">Lịch trình của tour</h4>
        </div>

        <div class="card-body">

            <?php if (empty($lichTrinh)): ?>
                <p class="text-muted">Tour này chưa có lịch trình nào.</p>
            <?php else: ?>

                <table class="table table-bordered table-striped">
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
                                <!-- ID -->
                                <td><?= $lt['id'] ?></td>

                                <!-- Ảnh -->
                                <td>
                                    <?php if (!empty($lt['hinh_anh'])): ?>
                                        <img src="<?= BASE_URL . 'uploads/tour_lich_trinh/' . $lt['hinh_anh'] ?>" width="80"
                                            class="img-thumbnail">
                                    <?php else: ?>
                                        <span class="text-muted">Không có</span>
                                    <?php endif; ?>
                                </td>

                                <!-- Tiêu đề -->
                                <td><?= htmlspecialchars($lt['tieu_de']) ?></td>

                                <!-- Ngày -->
                                <td>
                                    <?= !empty($lt['ngay_thu'])
                                        ? date("d/m/Y", strtotime($lt['ngay_thu']))
                                        : '---'
                                        ?>
                                </td>

                                <!-- Thứ tự -->
                                <td><?= $lt['thu_tu'] ?></td>

                                <!-- Nội dung -->
                                <td style="white-space: pre-line;">
                                    <?= nl2br(htmlspecialchars($lt['noi_dung'] ?? '')) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            <?php endif; ?>

        </div>
    </div>

</div>

<script>
    $(function () {
        $("#policyTable").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#policyTable_wrapper .col-md-6:eq(0)');
    });
</script>

<?php
$content = ob_get_clean();

view('layouts.AdminLayout', [
    'title' => $title ?? 'Chi tiết Tour - Website Quản Lý Tour',
    'pageTitle' => 'Chi tiết Tour',
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Quản lý Tour', 'url' => BASE_URL . 'tour', 'active' => false],
        ['label' => 'Chi tiết Tour', 'url' => '#', 'active' => true],
    ],
]);
?>