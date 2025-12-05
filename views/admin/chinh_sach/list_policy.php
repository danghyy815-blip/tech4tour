<?php
ob_start();
?>

<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="<?= BASE_URL . 'form-add-policy'?>">
                                <button type="button" class="btn btn-success">Thêm chính sách</button>
                            </a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
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
                                        <td><?= $key + 1 ?></td>
                                        <td><a
                                                href="<?= BASE_URL . 'detail-policy&id=' . $policy['id'] ?>"><?= $policy['ten_chinh_sach'] ?></a>
                                        </td>
                                        <td><?= $policy['loai_chinh_sach'] ?></td>
                                        <td><?= date('d-m-Y', strtotime($policy['ngay_ap_dung'])) ?></td>
                                        <td><?= date('d-m-Y', strtotime($policy['ngay_het_han'])) ?></td>
                                        <td><?= $policy['trang_thai'] ?></td>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-sm">
                                                <a href="<?= BASE_URL . 'form-update-policy&id=' . $policy['id'] ?>"
                                                    style="color: white; text-decoration: none;">Sửa</a>
                                            </button>

                                            <button type="button" class="btn btn-danger btn-sm">
                                                <a href="delete-policy&id=<?= $policy['id'] ?>"
                                                    style="color: white; text-decoration: none;"
                                                    onclick="return confirm('Bạn có đồng ý xóa chính sách này không?')">
                                                    Xóa
                                                </a>
                                            </button>
                                        </td>

                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
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