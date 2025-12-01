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
                            <a href="form-add-user">
                                <button type="button" class="btn btn-success">Thêm nhân viên</button>
                            </a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <?php if ($msg = getFlash('success')): ?>
                                <div class="alert alert-success" role="alert"><?= htmlspecialchars($msg) ?></div>
                            <?php endif; ?>
                            <?php if ($msg = getFlash('error')): ?>
                                <div class="alert alert-danger" role="alert"><?= htmlspecialchars($msg) ?></div>
                            <?php endif; ?>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Họ và tên</th>
                                        <th>Giới tính</th>
                                        
                                        
                                        <th>Email</th>
                                        <th>Địa chỉ</th>
                                        
                                        <th>Chức vụ</th>
                                        
                                        
                                        <th>Trạng thái</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $currentUser = getCurrentUser();
                                    foreach ($users as $key => $user) :
                                        $isCurrent = $currentUser && isset($currentUser->id) && $currentUser->id == $user['id'];
                                    ?>
                                        <tr class="<?= $isCurrent ? 'table-success' : '' ?>">
                                            <td><?= $key + 1 ?></td>
                                            
                                            <td><?= htmlspecialchars($user['ho_ten']) ?></td>
                                            <td><?= htmlspecialchars($user['gioi_tinh']) ?></td>
                                            
                                            
                                            <td><?= htmlspecialchars($user['email']) ?></td>
                                            <td><?= htmlspecialchars($user['dia_chi']) ?></td>
                                            
                                            <td><?= htmlspecialchars($user['chuc_vu']) ?></td>
                                           
                                            <td><?= $user['trang_thai'] ? 'Kích hoạt' : 'Vô hiệu' ?></td>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-sm">
                                                    <a href="<?= BASE_URL . 'form-update-user&id=' . $user['id'] ?>" style="color: white;">Sửa</a>
                                                </button>
                                                <?php if ($isCurrent) : ?>
                                                    <button type="button" class="btn btn-danger btn-sm" disabled title="Không thể xóa chính bạn">
                                                        Xóa
                                                    </button>
                                                <?php else : ?>
                                                    <button type="button" class="btn btn-danger btn-sm">
                                                        <a href="delete-user&id=<?= $user['id'] ?>" style="color: white;" onclick="return confirm('Bạn có đồng ý xóa nhân viên này không?')">Xóa</a>
                                                    </button>
                                                <?php endif; ?>
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
                        elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (new Date().valueOf());
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
    'title' => $title ?? 'Quản lý nhân viên - Website Quản Lý Tour',
    'pageTitle' => 'Quản lý nhân viên',
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Quản lý nhân viên', 'url' => BASE_URL . 'user', 'active' => true],
    ],
]);
?>