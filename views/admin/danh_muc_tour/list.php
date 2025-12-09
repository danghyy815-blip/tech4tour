<?php
ob_start();
?>
<style>
    .cat-card { border-radius: 10px; border: 1px solid #e5e7eb; }
    .cat-card .card-header { background: #f8fafc; border-bottom: 1px solid #e5e7eb; }
    .cat-table thead th { background: #f5f6f8; color: #1f2b3d; }
    .cat-table tbody td { vertical-align: middle; }
    .badge-soft-primary { background: #eef4ff; color: #2f59c1; }
    .badge-soft-success { background: #eaf7ed; color: #1f7a3d; }
    .badge-soft-secondary { background: #f1f2f4; color: #475467; }
    .link-strong { text-decoration: none; color: #0f4db8; font-weight: 600; }
    .link-strong:hover { text-decoration: underline; }
</style>

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card cat-card shadow-sm">
                        <div class="card-header d-flex align-items-center flex-wrap gap-2">
                            <div>
                                <h5 class="mb-0 fw-semibold">Danh mục Tour</h5>
                                <small class="text-muted">Quản lý loại tour và mô tả</small>
                            </div>
                            <a href="<?= BASE_URL . 'form-add-danh-muc-tour' ?>" class="btn btn-success ms-auto">
                                <i class="fas fa-plus-circle"></i> Thêm danh mục tour
                            </a>
                        </div>

                        <div class="card-body">
                            <table id="example1" class="table table-hover align-middle cat-table">
                                <thead>
                                    <tr>
                                        <th style="width: 5%">ID</th>
                                        <th>Tên danh mục</th>
                                        <th style="width: 15%">Loại</th>
                                        <th>Mô tả</th>
                                        <th style="width: 15%">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($danhMucs)) : ?>
                                    <?php foreach ($danhMucs as $dm) : ?>
                                    <tr>
                                        <td><?= htmlspecialchars($dm['id']) ?></td>
                                        <td>
                                            <a href="<?= BASE_URL . 'detail-danh-muc-tour&id=' . htmlspecialchars($dm['id']) ?>" class="link-strong">
                                                <?= htmlspecialchars($dm['ten_danh_muc']) ?>
                                            </a>

                                        </td>
                                        <td>
                                            <?php
                                                    $loai_color = ($dm['loai'] == 'Trong nước') ? 'success' : (($dm['loai'] == 'Quốc tế') ? 'primary' : 'secondary');
                                                    ?>
                                            <span class="badge badge-soft-<?= $loai_color ?> px-3 py-2"><?= htmlspecialchars($dm['loai']) ?></span>
                                        </td>
                                        <td><?= htmlspecialchars(substr($dm['mo_ta'], 0, 80)) . (strlen($dm['mo_ta']) > 80 ? '...' : '') ?>
                                        </td>
                                        <td>
                                            <button type="button" onclick="window.location.href='<?= BASE_URL . 'form-update-danh-muc-tour&id=' . htmlspecialchars($dm['id']) ?>'" class="btn btn-primary btn-sm mb-1">
                                                <i class="fas fa-edit"></i> Sửa
                                            </button>
                                            <button type="button"
                                                onclick="if(confirm('Bạn có chắc chắn muốn xoá danh mục [<?= htmlspecialchars($dm['ten_danh_muc']) ?>] này không? Hành động này có thể ảnh hưởng đến các Tour liên quan!')) { window.location.href='<?= BASE_URL . 'delete-danh-muc-tour&id=' . htmlspecialchars($dm['id']) ?>'; }"
                                                class="btn btn-outline-danger btn-sm mb-1">
                                                <i class="fas fa-trash"></i> Xóa
                                            </button>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <?php else : ?>
                                    <tr>
                                        <td colspan="5" class="text-center">Chưa có danh mục tour nào được thêm.</td>
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

<aside class="control-sidebar control-sidebar-dark">
</aside>

<script>
$(function() {
    $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
        "language": {
            "sProcessing": "Đang xử lý...",
            "sLengthMenu": "Xem _MENU_ mục",
            "sZeroRecords": "Không tìm thấy kết quả",
            "sInfo": "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
            "sInfoEmpty": "Đang xem 0 đến 0 trong tổng số 0 mục",
            "sInfoFiltered": "(được lọc từ tổng số _MAX_ mục)",
            "sInfoPostFix": "",
            "sSearch": "Tìm kiếm:",
            "sUrl": "",
            "oPaginate": {
                "sFirst": "Đầu",
                "sPrevious": "Trước",
                "sNext": "Tiếp",
                "sLast": "Cuối"
            },
            "oAria": {
                "sSortAscending": ": sắp xếp cột theo thứ tự tăng dần",
                "sSortDescending": ": sắp xếp cột theo thứ tự giảm dần"
            }
        }
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
});
</script>

<?php
$content = ob_get_clean();


view('layouts.AdminLayout', [
    'title' => $title ?? 'Quản lý danh mục tour - Website Quản Lý Tour',
    'pageTitle' => 'Quản lý Danh Mục Tour',
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Quản lý danh mục tour', 'url' => BASE_URL . 'danh-muc-tour', 'active' => true],
    ],
]);
?>