<?php 

class HomeController
{
    public $modelSanPham;
    public $taiKhoanModel;
    public $modelGioHang;
    public $modelDonHang; 
    public $modelDanhMuc;
    public $modelTaiKhoan;
    
    public function __construct()
    {
        $this->modelSanPham = new SanPham();
        $this->taiKhoanModel = new TaiKhoan();
        $this->modelGioHang = new GioHang();
        $this->modelDonHang = new DonHang();
        $this->modelDanhMuc = new DanhMuc();
        $this->modelTaiKhoan = new TaiKhoan();
    }
    public function home()
    {
        $listSanPham = $this->modelSanPham->getAll();
        require_once './views/home.php';
    }

    public function danhSachSanPham()
    {
        $danhMucId = $_GET['danh-muc-id'] ?? 0;
        $listSanPham = $this->modelSanPham->getListSanPhamTheoDanhMuc($danhMucId);
        require_once './views/danh-sach.php';
    }

    public function chiTietSanPham()
    {
        $id = $_GET['id'] ?? 0;
        $sanPham = $this->modelSanPham->getById($id);
        $listAnh = $this->modelSanPham->getListAnh($id);
        $listBinhLuan = $this->modelSanPham->getListBinhLuan($id);
        $listSanPhamTheoDanhMuc = $this->modelSanPham->getListSanPhamTheoDanhMuc($sanPham['danh_muc_id']);
        if(!$sanPham) {
            header('Location: ?act=/');
            exit;
        }
        else {
            require_once './views/chitiet.php';
        }
    }

    public function formLogin()
    {
        // Hiển thị form đăng nhập
        require_once './views/auth/formLogin.php';
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $taiKhoan = $this->taiKhoanModel->getByEmail($email);

            if ($taiKhoan && password_verify($password, $taiKhoan['mat_khau'])) {
                if ($taiKhoan['chuc_vu_id'] != 2) {
                    $_SESSION['errors'] =  "Bạn không có quyền truy cập vào trang này";
                    $_SESSION['flash'] =  true;
                    header('Location: ' . BASE_URL . '?act=login');
                    return;
                }elseif ($taiKhoan['trang_thai'] == 0) {
                    $_SESSION['errors'] =  "Tài khoản của bạn đã bị khóa";
                    $_SESSION['flash'] =  true;
                    header('Location: ' . BASE_URL . '?act=login');
                    return;
                }
                $_SESSION['user'] = $taiKhoan;
                header('Location: ' . BASE_URL);
            } else {
                $_SESSION['errors'] =  "Email hoặc mật khẩu không đúng";
                $_SESSION['flash'] =  true;
                header('Location: ' . BASE_URL . '?act=login');


            }
        }
    }

    public function logout()
    {
        // Xóa session để đăng xuất
        unset($_SESSION['user']);
        unset($_SESSION['errors']);
        unset($_SESSION['flash']);
        header('Location: ' . BASE_URL . '?act=login');
    }

    public function themGioHang()
    {
        // Xử lý thêm sản phẩm vào giỏ hàng
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if(isset($_SESSION['user'])) {
                $gioHang = $this->modelGioHang->getGioHangFromUserID($_SESSION['user']['id']);
                if ($gioHang) {
                    $gioHangId = $gioHang['id'];
                } else {
                    // Nếu giỏ hàng chưa tồn tại, tạo mới
                    $gioHangId = $this->modelGioHang->createGioHang($_SESSION['user']['id']);
                }

                $chiTietGioHang = $this->modelGioHang->getChiTietGioHangID($gioHangId);
                $sanPhamId = $_POST['id'];
                $soLuong = $_POST['so_luong'];
                $currentQty = $this->modelSanPham->getSoLuong($sanPhamId);

                if($soLuong > $currentQty) {
                    $_SESSION['errors'] = "Số lượng sản phẩm không đủ";
                    header('Location: ' . BASE_URL . '?act=chi-tiet-san-pham&id=' . $sanPhamId);
                    return;
                }


                $check = false;

                foreach ($chiTietGioHang as $item) {
                    if($item['san_pham_id'] == $sanPhamId) {
                        $updateSoLuong = $item['so_luong'] + $soLuong;
                        $this->modelGioHang->updateSoLuong($updateSoLuong, $item['id']);
                        $check = true;
                    }
                }
                if(!$check) {
                    $this->modelGioHang->addChiTietGioHang($gioHangId, $sanPhamId, $soLuong);
                }
                header('Location: ' . BASE_URL . '?act=gio-hang');
            } else {
                var_dump("chưa đăng nhập");
                die();
            }

        }
    }

    public function gioHang()
    {
        // Hiển thị giỏ hàng
        if (isset($_SESSION['user'])) {
            $gioHang = $this->modelGioHang->getGioHangFromUserID($_SESSION['user']['id']);
            if ($gioHang) {
                $chiTietGioHang = $this->modelGioHang->getChiTietGioHangID($gioHang['id']);
                
            } else {
                $_SESSION['errors'] = "Giỏ hàng của bạn đang trống";
                header('Location: ' . BASE_URL);
            }
            require_once './views/giohang.php';
        } else {
            header('Location: ' . BASE_URL . '?act=login');
        }
    }

    public function xoaGioHang()
    {
        // Xử lý xóa giỏ hàng
        if (isset($_SESSION['user'])) {
            $gioHangId = $_GET['id'];
            if ($gioHangId) {
                $this->modelGioHang->deleteChiTietGioHang($gioHangId);
                header('Location: ' . BASE_URL . '?act=gio-hang');
                exit;
            } else {
                $_SESSION['errors'] = "Giỏ hàng không tồn tại";
            }
        } else {
            header('Location: ' . BASE_URL . '?act=login');
        }
    }

    public function thanhToan()
    {
        if (isset($_SESSION['user'])) {
            $gioHang = $this->modelGioHang->getGioHangFromUserID($_SESSION['user']['id']);
            $phuongThucThanhToan = $this->modelGioHang->getPhuongThucThanhToan();
            if ($gioHang) {
                $chiTietGioHang = $this->modelGioHang->getChiTietGioHangID($gioHang['id']);
            }
            require_once './views/thanhtoan.php';
        } else {
            header('Location: ' . BASE_URL . '?act=login');
        }
    }

    public function xuLyThanhToan()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_SESSION['user'])) {
                $ten_nguoi_nhan = $_POST['ten_nguoi_nhan'];
                $email_nguoi_nhan = $_POST['email_nguoi_nhan'];
                $sdt_nguoi_nhan = $_POST['sdt_nguoi_nhan'];
                $dia_chi_nguoi_nhan = $_POST['dia_chi'];
                $ghi_chu = $_POST['ghi_chu'];
                $tong_tien = $_POST['tong_tien'];
                $phuong_thuc_thanh_toan = $_POST['phuong_thuc_thanh_toan'];
                $ngay_dat_hang = new DateTime();
                $ngay_dat_hang = $ngay_dat_hang->format('Y-m-d');
                $trang_thai_id = 1;
                $tai_khoan_id = $_SESSION['user']['id'];
                $ma_don_hang = 'DH' . time();

                // Thêm vào DB
                $donHangId = $this->modelDonHang->addDonHang($tai_khoan_id, $ma_don_hang, $ten_nguoi_nhan, $email_nguoi_nhan, $sdt_nguoi_nhan, $dia_chi_nguoi_nhan, $ghi_chu, $tong_tien, 
                $phuong_thuc_thanh_toan, $ngay_dat_hang, $trang_thai_id);
                

                // Lẩy thông tin giỏ hàng
                $gioHang = $this->modelGioHang->getGioHangFromUserID($tai_khoan_id);
                if($donHangId) {
                    $chiTietGioHang = $this->modelGioHang->getChiTietGioHangID($gioHang['id']);
                    foreach ($chiTietGioHang as $item) {
                        $donGia = $item['gia_khuyen_mai'] ? $item['gia_khuyen_mai'] : $item['gia_san_pham'];
                        $this->modelDonHang->addChiTietDonHang($donHangId, $item['san_pham_id'], $item['so_luong'], $donGia, $item['gia_khuyen_mai'] ? $item['gia_khuyen_mai'] * $item['so_luong'] : $item['gia_san_pham'] * $item['so_luong']);
                        $this->modelGioHang->deleteChiTietGioHang($item['gio_hang_id']);
                        //update số lượng mới
                        $sanPham = $this->modelSanPham->getById($item['san_pham_id']);
                        $sanPham['so_luong'] = $sanPham['so_luong'] - $item['so_luong'];
                        $this->modelSanPham->updateSoLuong($sanPham['so_luong'], $sanPham['id']);
                    }
                }    
                header('Location: ' . BASE_URL . '?act=lich-su-don-hang');
            } else {
                header('Location: ' . BASE_URL . '?act=login');
            }
        }
    }

    public function lichSuDonHang()
    {
        if (isset($_SESSION['user'])) {
            $listDonHang = $this->modelDonHang->getByUserID($_SESSION['user']['id']);
            require_once './views/lich-su-don-hang.php';
        } else {
            header('Location: ' . BASE_URL . '?act=login');
        }
    }

    public function chiTietDonHang()
    {
        if (isset($_SESSION['user'])) {
            $donHang = $this->modelDonHang->getById($_GET['id']);
            $sanPhamDonHang = $this->modelDonHang->getListSanPhamDonHang($donHang['id']);

            require_once './views/chi-tiet-don-hang.php';
        } else {
            header('Location: ' . BASE_URL . '?act=login');
        }
    }

    public function huyDonHang()
    {
        if (isset($_SESSION['user'])) {
            $donHang = $this->modelDonHang->getById($_GET['id']);
            if($donHang['trang_thai_id'] == 1){
                $this->modelDonHang->updateTrangThai($donHang['id'], 11);
            }else{
                $_SESSION['errors'] = "Đơn hàng không thể hủy";
                header('Location: ' . BASE_URL . '?act=chi-tiet-don-hang&id=' . $_GET['id']);
                return;
            }
            header('Location: ' . BASE_URL . '?act=lich-su-don-hang');
        } else {
            header('Location: ' . BASE_URL . '?act=login');
        }
    }

    public function register()
    {
        require_once './views/auth/formRegister.php';
    }

    public function checkRegister()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ho_ten = $_POST['ho_ten'];
            $email = $_POST['email'];
            $so_dien_thoai = $_POST['so_dien_thoai'];
            $dia_chi = $_POST['dia_chi'];
            $ngay_sinh = $_POST['ngay_sinh'];
            $gioi_tinh = $_POST['gioi_tinh'];
            $mat_khau = $_POST['mat_khau'];
            $error = [];
            
            if($ho_ten == '') {
                $error['ho_ten'] = 'Họ tên không được để trống';
            }   
            if($email == '') {
                $error['email'] = 'Email không được để trống';
            }   
            if($so_dien_thoai == '') {
                $error['so_dien_thoai'] = 'Số điện thoại không được để trống';
            }   
            if($dia_chi == '') {
                $error['dia_chi'] = 'Địa chỉ không được để trống';
            }   
            if($ngay_sinh == '') {
                $error['ngay_sinh'] = 'Ngày sinh không được để trống';
            }   
            if($gioi_tinh == '') {
                $error['gioi_tinh'] = 'Giới tính không được để trống';
            }   
            if($mat_khau == '') {
                $error['mat_khau'] = 'Mật khẩu không được để trống';
            }   
            if($error) {
                $_SESSION['errors'] = $error;
                header('Location: ' . BASE_URL . '?act=register');
                return;
            }

            $checkEmail = $this->modelTaiKhoan->getByEmail($email);
            if($checkEmail) {
                $_SESSION['errors'] = 'Email đã tồn tại';
                header('Location: ' . BASE_URL . '?act=form-register');
                return;
            }

            $this->modelTaiKhoan->addTaiKhoan([
                'ho_ten' => $ho_ten,
                'email' => $email,
                'mat_khau' => password_hash($mat_khau, PASSWORD_BCRYPT),
                'so_dien_thoai' => $so_dien_thoai,
                'dia_chi' => $dia_chi,
                'ngay_sinh' => $ngay_sinh,
                'gioi_tinh' => $gioi_tinh,
                'chuc_vu_id' => 2,
                'trang_thai' => 1
            ]);
            unset($_SESSION['errors']);
            header('Location: ' . BASE_URL . '?act=login');
        }
    }
    
    public function binhLuan()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_SESSION['user'])) {
                $noi_dung = $_POST['noi_dung'];
                $san_pham_id = $_POST['san_pham_id'];
                $tai_khoan_id = $_SESSION['user']['id'];
                $ngay_dang = new DateTime();
                $ngay_dang = $ngay_dang->format('Y-m-d');
                $trang_thai_id = 1;
                $this->modelSanPham->addBinhLuan([
                    'noi_dung' => $noi_dung,
                    'san_pham_id' => $san_pham_id,
                    'tai_khoan_id' => $tai_khoan_id,
                    'ngay_dang' => $ngay_dang,
                    'trang_thai_id' => $trang_thai_id
                ]);
                header('Location: ' . BASE_URL . '?act=chi-tiet-san-pham&id=' . $_POST['san_pham_id']);
            } else {
                header('Location: ' . BASE_URL . '?act=login');
            }
        }
    }   

}