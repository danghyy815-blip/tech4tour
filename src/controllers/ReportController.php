<?php

class ReportController
{
    public $modelUser;
    public $conn;

    public function __construct()
    {
        $this->conn = getDB();
        $this->modelUser = new User();
    }

    // Trang báo cáo thống kê
    public function getStatistics()
    {
        if (!isLoggedIn()) {
            header('Location: ' . BASE_URL . 'welcome');
            exit;
        }

        // Kiểm tra quyền admin
        if (!isAdmin()) {
            header('Location: ' . BASE_URL . 'home');
            exit;
        }

        // Thống kê người dùng
        $totalUsers = $this->conn->query("SELECT COUNT(*) as count FROM users")->fetch(PDO::FETCH_ASSOC)['count'];
        $activeUsers = $this->conn->query("SELECT COUNT(*) as count FROM users WHERE trang_thai = 1")->fetch(PDO::FETCH_ASSOC)['count'];
        $inactiveUsers = $totalUsers - $activeUsers;

        // Thống kê theo chức vụ
        $usersByRole = $this->conn->query("SELECT chuc_vu, COUNT(*) as count FROM users GROUP BY chuc_vu")->fetchAll(PDO::FETCH_ASSOC);

        // Thống kê tour (nếu bảng tour tồn tại)
        $totalTours = 0;
        try {
            $stmt = $this->conn->query("SELECT COUNT(*) as count FROM tour");
            if ($stmt) {
                $totalTours = (int)$stmt->fetch(PDO::FETCH_ASSOC)['count'];
            }
        } catch (Exception $e) {
            // Bảng tour chưa tồn tại, bỏ qua
        }

        // Thống kê chính sách (nếu bảng chinh_sach tồn tại)
        $totalPolicies = 0;
        try {
            $stmt = $this->conn->query("SELECT COUNT(*) as count FROM chinh_sach");
            if ($stmt) {
                $totalPolicies = (int)$stmt->fetch(PDO::FETCH_ASSOC)['count'];
            }
        } catch (Exception $e) {
            // Bảng chinh_sach chưa tồn tại, bỏ qua
        }

        // Thống kê khách hàng
        $totalCustomers = 0;
        try {
            $stmt = $this->conn->query("SELECT COUNT(*) as count FROM khach_hang WHERE trang_thai != 'xóa'");
            if ($stmt) {
                $totalCustomers = (int)$stmt->fetch(PDO::FETCH_ASSOC)['count'];
            }
        } catch (Exception $e) {
            // Bảng khach_hang chưa tồn tại, bỏ qua
        }

        // Thống kê booking
        $totalBookings = 0;
        try {
            $stmt = $this->conn->query("SELECT COUNT(*) as count FROM booking");
            if ($stmt) {
                $totalBookings = (int)$stmt->fetch(PDO::FETCH_ASSOC)['count'];
            }
        } catch (Exception $e) {
            // Bảng booking chưa tồn tại, bỏ qua
        }

        // Tổng thu nhập (tổng giá tiền của booking đã hoàn thành)
        $totalRevenue = 0;
        try {
            $stmt = $this->conn->query("SELECT COALESCE(SUM(gia_tien), 0) as total FROM booking WHERE trang_thai = 'HoanThanh'");
            if ($stmt) {
                $totalRevenue = (float)$stmt->fetch(PDO::FETCH_ASSOC)['total'];
            }
        } catch (Exception $e) {
            // Bảng booking hoặc cột gia_tien chưa tồn tại, bỏ qua
        }

        // Số lượng nhân viên (users table) — xem như tổng users
        $totalEmployees = $totalUsers;

        // Dữ liệu cho biểu đồ
        $roleLabels = [];
        $roleCounts = [];
        foreach ($usersByRole as $role) {
            $roleLabels[] = $role['chuc_vu'];
            $roleCounts[] = $role['count'];
        }

        // Khách hàng mới nhất (5 người)
        $recentCustomers = [];
        try {
            $stmt = $this->conn->query("SELECT id, ho_ten, email, ngay_dang_ky, trang_thai FROM khach_hang WHERE trang_thai != 'xóa' ORDER BY ngay_dang_ky DESC LIMIT 5");
            $recentCustomers = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            // Bỏ qua nếu lỗi
        }

        // Booking theo trạng thái
        $bookingsByStatus = [];
        try {
            $stmt = $this->conn->query("SELECT trang_thai, COUNT(*) as count FROM booking GROUP BY trang_thai");
            $bookingsByStatus = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            // Bỏ qua nếu lỗi
        }

        // Tour phổ biến (top 5 tour có nhiều booking nhất)
        $popularTours = [];
        try {
            $stmt = $this->conn->query("
                SELECT t.id, t.ten_tour, t.gia, COUNT(b.id) as booking_count 
                FROM tour t 
                LEFT JOIN booking b ON t.id = b.tour_id 
                GROUP BY t.id, t.ten_tour, t.gia 
                ORDER BY booking_count DESC 
                LIMIT 5
            ");
            $popularTours = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            // Bỏ qua nếu lỗi
        }

        // Doanh thu theo từng booking trạng thái
        $revenueByStatus = [];
        try {
            $stmt = $this->conn->query("
                SELECT trang_thai, COALESCE(SUM(gia_tien), 0) as total 
                FROM booking 
                GROUP BY trang_thai
            ");
            $revenueByStatus = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            // Bỏ qua nếu lỗi
        }

        require_once './views/admin/report/statistics.php';
    }
}
