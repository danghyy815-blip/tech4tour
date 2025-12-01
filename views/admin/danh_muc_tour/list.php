<?php
ob_start();


?>

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="<?= BASE_URL . 'form-add-danh-muc-tour' ?>">
                                <button type="button" class="btn btn-primary">
                                    <i class="fas fa-plus-circle"></i> Thêm danh mục tour
                                </button>
                            </a>
                        </div>

                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
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
                                                    <a href="<?= BASE_URL . 'detail-danh-muc-tour&id=' . htmlspecialchars($dm['id']) ?>"
                                                        class="font-weight-bold">
                                                        <?= htmlspecialchars($dm['ten_danh_muc']) ?>
                                                    </a>
                                                </td>
                                                <td>
                                                    <?php
                                                    $loai_color = ($dm['loai'] == 'Trong nước') ? 'success' : (($dm['loai'] == 'Quốc tế') ? 'primary' : 'secondary');
                                                    ?>
                                                    <span class="badge badge-<?= $loai_color ?>"
                                                        style="color: #000000 !important; font-weight: bold;">
                                                        <?= htmlspecialchars($dm['loai']) ?>
                                                    </span>
                                                </td>
                                                <td><?= htmlspecialchars(substr($dm['mo_ta'], 0, 80)) . (strlen($dm['mo_ta']) > 80 ? '...' : '') ?>
                                                </td>
                                                <td>
                                                    <button type="button"
                                                        onclick="window.location.href='<?= BASE_URL . 'form-update-danh-muc-tour&id=' . htmlspecialchars($dm['id']) ?>'"
                                                        class="btn btn-primary btn-sm mb-1" title="Sửa">
                                                        <i class="fas fa-edit"></i> Sửa
                                                    </button>
                                                    <button type="button"
                                                        onclick="if(confirm('Bạn có chắc chắn muốn xoá danh mục [<?= htmlspecialchars($dm['ten_danh_muc']) ?>] này không? Hành động này có thể ảnh hưởng đến các Tour liên quan!')) { window.location.href='<?= BASE_URL . 'delete-danh-muc-tour&id=' . htmlspecialchars($dm['id']) ?>'; }"
                                                        class="btn btn-danger btn-sm mb-1" title="Xóa">
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