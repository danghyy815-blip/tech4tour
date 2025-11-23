<?php 
session_start(); // Bắt đầu phiên làm việc
// Require file Common
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/HomeController.php';

// Require toàn bộ file Models
require_once './models/SanPham.php';
require_once './models/TaiKhoan.php';
require_once './models/GioHang.php';
require_once './models/DonHang.php'; 
require_once './models/DanhMuc.php';


// Route
$act = $_GET['act'] ?? '/';

// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match
$controller = new HomeController();

match ($act) {
    '/' => $controller->home(),
    'danh-sach-san-pham' => $controller->danhSachSanPham(),
    'chi-tiet-san-pham' => $controller->chiTietSanPham(),
    'login' => $controller->formLogin(),
    'checkLogin' => $controller->login(),
    'logout' => $controller->logout(),
    'binh-luan' => $controller->binhLuan(),
    'form-register' => $controller->register(),
    'register' => $controller->checkRegister(),
    'them-gio-hang' => $controller->themGioHang(),
    'gio-hang' => $controller->gioHang(),
    'xoa-gio-hang' => $controller->xoaGioHang(),
    'thanh-toan' => $controller->thanhToan(),
    'xu-ly-thanh-toan' => $controller->xuLyThanhToan(),
    'lich-su-don-hang' => $controller->lichSuDonHang(),
    'chi-tiet-don-hang' => $controller->chiTietDonHang(),
    'huy-don-hang' => $controller->huyDonHang(),
};