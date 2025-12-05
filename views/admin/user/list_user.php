<?php
ob_start();
?>

<style>
    /* User list improvements to match detail UI */
    .tbl-avatar {
        width: 44px;
        height: 44px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        color: white;
        background: linear-gradient(135deg,#4a6cf7,#6f87ff);
        box-shadow: 0 6px 18px rgba(74,108,247,0.16);
        margin-right: 10px;
    }
    .name-cell { display: flex; align-items: center; gap: 8px; }
    .name-cell .meta { display: flex; flex-direction: column; }
    .name-cell .meta .name { font-weight:700; color:#0f172a; }
    .name-cell .meta .email { color:#64748b; font-size:13px; word-break:break-all; }
    .badge-custom { padding:6px 10px; border-radius:12px; font-weight:700; font-size:12px; }
    .status-active { background:#d1fae5; color:#065f46; }
    .status-inactive { background:#fee2e2; color:#7f1d1d; }
    .action-link { text-decoration:none; }
    .btn-action { margin-right:6px; }
    @media (max-width: 768px) {
        .name-cell .meta .email { display:none; }
    }
</style>

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
                            <table id="example1" class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th style="width:60px">STT</th>
                                        <th>Người</th>
                                        <th>Giới tính</th>
                                        <th>Địa chỉ</th>
                                        <th>Chức vụ</th>
                                        <th>Trạng thái</th>
                                        <th style="width:150px">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $currentUser = getCurrentUser();
                                    foreach ($users as $key => $user) :
                                        $isCurrent = $currentUser && isset($currentUser->id) && $currentUser->id == $user['id'];
                                        // initials
                                        $initials = '';
                                        if (!empty($user['ho_ten'])) {
                                            $parts = preg_split('/\s+/', trim($user['ho_ten']));
                                            foreach ($parts as $p) {
                                                $initials .= mb_substr($p, 0, 1);
                                                if (mb_strlen($initials) >= 2) break;
                                            }
                                            $initials = mb_strtoupper($initials);
                                        }
                                    ?>
                                        <tr class="<?= $isCurrent ? 'table-success' : '' ?>">
                                            <td><?= $key + 1 ?></td>
                                            <td>
                                                <div class="name-cell">
                                                    <div class="tbl-avatar"><?= htmlspecialchars($initials ?: 'NV') ?></div>
                                                    <div class="meta">
                                                        <div class="name"><?= htmlspecialchars($user['ho_ten']) ?></div>
                                                        <div class="email"><?= htmlspecialchars($user['email']) ?></div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><?= htmlspecialchars($user['gioi_tinh']) ?></td>
                                            <td><?= htmlspecialchars($user['dia_chi']) ?></td>
                                            <td><?= htmlspecialchars($user['chuc_vu']) ?></td>
                                            <td>
                                                <?php if (!empty($user['trang_thai']) && ($user['trang_thai'] == 1 || $user['trang_thai'] === '1' || $user['trang_thai'] === 'Kích hoạt' || $user['trang_thai'] === 'Hoạt động')): ?>
                                                    <span class="badge-custom status-active">Kích hoạt</span>
                                                <?php else: ?>
                                                    <span class="badge-custom status-inactive">Vô hiệu</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <a href="<?= BASE_URL . 'form-update-user&id=' . $user['id'] ?>" class="btn btn-sm btn-outline-primary btn-action action-link" title="Sửa">
                                                    <i class="fas fa-edit"></i> Sửa
                                                </a>
                                                <?php if ($isCurrent) : ?>
                                                    <button type="button" class="btn btn-sm btn-outline-secondary" disabled title="Không thể xóa chính bạn">
                                                        <i class="fas fa-user-lock"></i>
                                                    </button>
                                                <?php else : ?>
                                                    <a href="delete-user&id=<?= $user['id'] ?>" class="btn btn-sm btn-outline-danger action-link" onclick="return confirm('Bạn có đồng ý xóa nhân viên này không?')" title="Xóa">
                                                        <i class="fas fa-trash"></i> Xóa
                                                    </a>
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