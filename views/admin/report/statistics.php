<?php
ob_start();
?>
<style>
    /* Card đẹp hiện đại */
    .card {
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        border: none;
        overflow: hidden;
        margin-bottom: 25px;
    }

    .card-header {
        padding: 16px 20px;
        background: linear-gradient(90deg, #4a6cf7, #6f87ff);
        color: #fff !important;
        border-bottom: none;
    }

    .card-title {
        font-size: 18px;
        font-weight: 600;
        margin: 0;
    }

    .small-box {
        border-radius: 12px !important;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        transition: 0.25s ease;
    }

    .small-box:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
    }

    .card-body {
        padding: 20px 22px;
    }

    .chart canvas {
        max-height: 260px;
    }
</style>

<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Page header -->
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Báo cáo thống kê</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= BASE_URL . 'home' ?>">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Báo cáo thống kê</li>
                    </ol>
                </div>
            </div>

            <!-- Stats row -->
            <div class="row">
                <div class="col-lg-2 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= $totalCustomers ?></h3>
                            <p>Số khách hàng</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-friends"></i>
                        </div>
                        <a href="<?= BASE_URL . 'khach-hang' ?>" class="small-box-footer">Xem chi tiết <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-6">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3><?= $totalEmployees ?></h3>
                            <p>Số lượng nhân viên</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <a href="<?= BASE_URL . 'user' ?>" class="small-box-footer">Xem chi tiết <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?= $totalBookings ?></h3>
                            <p>Số lượng booking</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-book"></i>
                        </div>
                        <a href="<?= BASE_URL . 'booking' ?>" class="small-box-footer">Xem chi tiết <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?= $totalTours ?></h3>
                            <p>Số lượng tour</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-hiking"></i>
                        </div>
                        <a href="<?= BASE_URL . 'tour' ?>" class="small-box-footer">Xem chi tiết <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?= number_format($totalRevenue, 0, ',', '.') ?> đ</h3>
                            <p>Tổng thu nhập (Hoàn thành)</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <a href="#" class="small-box-footer">Chi tiết doanh thu <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- /.row -->

            <!-- Main row -->
            <div class="row">
                <div class="col-md-6">
                    <!-- AREA CHART -->
                    <div class="card card-primary">
                        <div class="card-header with-border">
                            <h3 class="card-title">Phân bố doanh thu theo tour</h3>
                            <div class="card-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart">
                                <canvas id="roleChart" height="90"></canvas>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                    <!-- LINE CHART -->
                    <div class="card card-success">
                        <div class="card-header with-border">
                            <h3 class="card-title">Thống kê trạng thái</h3>
                            <div class="card-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart">
                                <canvas id="statusChart" height="90"></canvas>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Thống kê chi tiết người dùng</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Chức vụ</th>
                                        <th>Số lượng</th>
                                        <th>Phần trăm</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($usersByRole as $role) : ?>
                                        <tr>
                                            <td><?= htmlspecialchars($role['chuc_vu']) ?></td>
                                            <td><?= $role['count'] ?></td>
                                            <td><?= $totalUsers > 0 ? round(($role['count'] / $totalUsers) * 100, 2) : 0 ?>%</td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
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

<?php
$content = ob_get_clean();

// Hiển thị layout với nội dung
view('layouts.AdminLayout', [
    'title' => $title ?? 'Báo cáo thống kê - Website Quản Lý Tour',
    'pageTitle' => 'Báo cáo thống kê',
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Báo cáo thống kê', 'url' => BASE_URL . 'report', 'active' => true],
    ],
]);
?>

<!-- Chart.js library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>

<script>
    // Role Chart (Doughnut)
    const roleCtx = document.getElementById('roleChart').getContext('2d');
    const roleChart = new Chart(roleCtx, {
        type: 'doughnut',
        data: {
            labels: <?= json_encode($roleLabels) ?>,
            datasets: [{
                data: <?= json_encode($roleCounts) ?>,
                backgroundColor: [
                    '#FF6384',
                    '#36A2EB',
                    '#FFCE56',
                    '#4BC0C0',
                    '#9966FF'
                ],
                borderColor: '#fff',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

    // Status Chart (Pie)
    const statusCtx = document.getElementById('statusChart').getContext('2d');
    const statusChart = new Chart(statusCtx, {
        type: 'pie',
        data: {
            labels: ['Kích hoạt', 'Vô hiệu'],
            datasets: [{
                data: [<?= $activeUsers ?>, <?= $inactiveUsers ?>],
                backgroundColor: [
                    '#28a745',
                    '#dc3545'
                ],
                borderColor: '#fff',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
</script>