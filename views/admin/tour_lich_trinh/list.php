<?php
ob_start();
?>
<div class="content-wrapper">

    <section class="content">
        <div class="container-fluid">

            <!-- Nút thêm -->
            <div class="row mb-3">
                <div class="col-12 d-flex justify-content-between align-items-center">
                    <a href="form-add-lich-trinh" class="btn btn-success">
                        <i class="bi bi-plus-circle"></i> Thêm lịch trình
                    </a>
                </div>
            </div>

            <!-- Danh sách lịch trình -->
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-body">

                            <table id="lichTrinhTable" class="table table-bordered table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Tour</th>
                                        <th>Ảnh</th>
                                        <th>Tiêu đề</th>
                                        <th>Ngày</th>
                                        <th>Thứ tự</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php if (!empty($data)): ?>
                                        <?php foreach ($data as $lt): ?>
                                            <tr>
                                                <td><?= $lt['id'] ?></td>

                                                <!-- Tên tour -->
                                                <td><?= htmlspecialchars($lt['ten_tour'] ?? '---') ?></td>

                                                <!-- Ảnh lịch trình -->
                                                <td>
                                                    <?php if (!empty($lt['hinh_anh'])): ?>
                                                        <img src="<?= BASE_URL . 'uploads/tour_lich_trinh/' . $lt['hinh_anh'] ?>"
                                                            alt="Ảnh lịch trình" width="70" class="img-thumbnail">
                                                    <?php else: ?>
                                                        <span class="text-muted">Không có</span>
                                                    <?php endif; ?>
                                                </td>

                                                <!-- Tiêu đề -->
                                                <td><?= htmlspecialchars($lt['tieu_de'] ?? '') ?></td>

                                                <!-- Ngày -->
                                                <td>
                                                    <?= !empty($lt['ngay_thu'])
                                                        ? date("d/m/Y", strtotime($lt['ngay_thu']))
                                                        : '---' ?>
                                                </td>

                                                <!-- Thứ tự -->
                                                <td><?= $lt['thu_tu'] ?></td>

                                                <!-- Action -->
                                                <td>
                                                    <a href="form-update-lich-trinh&id=<?= $lt['id'] ?>"
                                                        class="btn btn-primary btn-sm me-1">
                                                        Sửa
                                                    </a>

                                                    <a href="delete-lich-trinh&id=<?= $lt['id'] ?>"
                                                        class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Xóa lịch trình này?')">
                                                        Xóa
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="7" class="text-center text-muted py-3">
                                                Không có dữ liệu lịch trình
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

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

<?php
$content = ob_get_clean();

view('layouts.AdminLayout', [
    'title' => 'Quản lý Lịch Trình',
    'pageTitle' => 'Danh sách Lịch Trình',
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Quản lý Lịch Trình', 'url' => BASE_URL . 'tour-lich-trinh', 'active' => true],
    ],
]);
?>