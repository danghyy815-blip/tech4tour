<?php
ob_start();
?>

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
                <img src="uploads/tours/<?= htmlspecialchars($tour['hinh_anh']) ?>" class="img-fluid rounded shadow-sm" width="400">
            <?php endif; ?>
        </div>
    </div>

    <!-- Bảng chính sách áp dụng -->
    <div class="card shadow">
        <div class="card-header">
            <h5 class="card-title mb-0">Chính sách áp dụng</h5>
        </div>
        <div class="card-body">
            <?php if (!empty($policies) && is_array($policies)): ?>
            <table id="policyTable" class="table table-bordered table-striped">
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
                                    if ($status === 'Đang áp dụng') $badge = 'bg-success';
                                    elseif ($status === 'Hết hạn') $badge = 'bg-warning';
                                    else $badge = 'bg-secondary';
                                ?>
                                <span class="badge <?= $badge ?>"><?= $status ?></span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php else: ?>
                <p>Tour này chưa áp dụng chính sách nào.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    $(function() {
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
