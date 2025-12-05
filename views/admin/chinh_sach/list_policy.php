<?php
ob_start();
?>

<style>
    .policy-card { border: 1px solid #e5e7eb; border-radius: 10px; }
    .policy-card .card-body { padding: 16px; }
    .policy-table thead th { background: #f5f6f8; color: #1f2b3d; }
    .policy-table tbody td { vertical-align: middle; }
    .badge-soft-success { background: #e6f4ea; color: #1f7a3d; }
    .badge-soft-warning { background: #fff7e6; color: #b45309; }
    .badge-soft-secondary { background: #f1f2f4; color: #475467; }
    .action-btn { border-radius: 6px; padding: 6px 10px; }
</style>

<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card policy-card shadow-sm">
                        <div class="card-header d-flex align-items-center flex-wrap gap-2 bg-white border-0">
                            <div>
                                <h5 class="mb-0 fw-semibold">Chính sách</h5>
                                <small class="text-muted">Quản lý áp dụng và thời hạn</small>
                            </div>
                            <a href="<?= BASE_URL . 'form-add-policy' ?>" class="btn btn-success ms-auto">
                                <i class="fas fa-plus-circle"></i> Thêm chính sách
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-hover align-middle policy-table">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên chính sách</th>
                                        <th>Loại chính sách</th>
                                        <th>Ngày áp dụng</th>
                                        <th>Ngày hết hạn</th>
                                        <th>Trạng thái</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($policies as $key => $policy) : ?>
                                        <tr>
                                            <td class="text-muted fw-semibold"><?= $key + 1 ?></td>
                                            <td>
                                                <a href="<?= BASE_URL . 'detail-policy&id=' . $policy['id'] ?>" class="fw-semibold text-decoration-none">
                                                    <?= $policy['ten_chinh_sach'] ?>
                                                </a>
                                            </td>
                                            <td><span class="badge bg-light text-dark border px-3 py-2"><?= $policy['loai_chinh_sach'] ?></span></td>
                                            <td><?= date('d-m-Y', strtotime($policy['ngay_ap_dung'])) ?></td>
                                            <td><?= date('d-m-Y', strtotime($policy['ngay_het_han'])) ?></td>
                                            <td>
                                                <?php
                                                    $status = $policy['trang_thai'];
                                                    $badge = 'badge-soft-secondary';
                                                    if ($status === 'Đang áp dụng') $badge = 'badge-soft-success';
                                                    elseif ($status === 'Hết hạn') $badge = 'badge-soft-warning';
                                                ?>
                                                <span class="badge <?= $badge ?> px-3 py-2"><?= $status ?></span>
                                            </td>
                                            <td>
                                                <a href="<?= BASE_URL . 'form-update-policy&id=' . $policy['id'] ?>" class="btn btn-primary btn-sm action-btn me-1">Sửa</a>
                                                <a href="delete-policy&id=<?= $policy['id'] ?>" class="btn btn-outline-danger btn-sm action-btn"
                                                    onclick="return confirm('Bạn có đồng ý xóa chính sách này không?')">Xóa</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
</div>

<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
<!-- Code injected by live-server -->
<script>
    // <![CDATA[  <-- For SVG support
    if ('WebSocket' in window) {
        (function() {
            function refreshCSS() {
                var sheets = [].slice.call(document.getElementsByTagName("link"));
                var head = document.getElementsByTagName("head")[0];
                for (var i = 0; i < sheets.length; ++i) {
                    var elem = sheets[i];
                    var parent = elem.parentElement || head;
                    parent.removeChild(elem);
                    var rel = elem.rel;
                    if (elem.href && typeof rel != "string" || rel.length == 0 || rel.toLowerCase() == "stylesheet") {
                        var url = elem.href.replace(/(&|\?)_cacheOverride=\d+/, '');
                        elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (new Date()
                            .valueOf());
                    }
                    parent.appendChild(elem);
                }
            }
            var protocol = window.location.protocol === 'http:' ? 'ws://' : 'wss://';
            var address = protocol + window.location.host + window.location.pathname + '/ws';
            var socket = new WebSocket(address);
            socket.onmessage = function(msg) {
                if (msg.data == 'reload') window.location.reload();
                else if (msg.data == 'refreshcss') refreshCSS();
            };
            if (sessionStorage && !sessionStorage.getItem('IsThisFirstTime_Log_From_LiveServer')) {
                console.log('Live reload enabled.');
                sessionStorage.setItem('IsThisFirstTime_Log_From_LiveServer', true);
            }
        })();
    } else {
        console.error('Upgrade your browser. This Browser is NOT supported WebSocket for Live-Reloading.');
    }
    // ]]>
</script>
</body>

</html>

<?php
$content = ob_get_clean();

// Hiển thị layout với nội dung
view('layouts.AdminLayout', [
    'title' => $title ?? 'Quản lý chính sách - Website Quản Lý Tour',
    'pageTitle' => 'Quản lý chính sách',
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Quản lý chính sách', 'url' => BASE_URL . 'policy', 'active' => true],
    ],
]);
?>