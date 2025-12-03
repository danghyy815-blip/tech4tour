<?php

class BookingController
{
    private $modelBooking;
    private $modelTour;
    private $modelUser;
    private $modelCustomer;

    public function __construct()
    {
        $this->modelBooking = new Booking();
        $this->modelTour = new Tour();
        $this->modelUser = new User();
        $this->modelCustomer = new Customer();
    }

    // Lấy danh sách chính sách
    public function getListBooking()
    {
        // Yêu cầu phải đăng nhập, nếu chưa thì redirect về welcome
        if (!isLoggedIn()) {
            header('Location: ' . BASE_URL . 'welcome');
            exit;
        }
        $currentUser = getCurrentUser();
        if ($currentUser->isAdmin()) {
            $bookings = $this->modelBooking->getAllBookings();
            require_once "./views/admin/booking/list_booking.php";
        } else {
            $bookings = $this->modelBooking->getBookingsByUserId($currentUser->id);
            require_once "./views/hdv/booking/list_booking.php";
        }
    }

    public function detailBooking()
    {
        if (!isLoggedIn()) {
            header('Location: ' . BASE_URL . 'welcome');
            exit;
        }
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $currentUser = getCurrentUser();
            if ($currentUser->isAdmin()) {
                $booking = $this->modelBooking->getBookingById($id);
                $customers = $this->modelBooking->getCustomersByBookingId($booking['id']);
                require_once './views/admin/booking/detail_booking.php';
            } else {
                $booking = $this->modelBooking->getBookingById($id, $currentUser->id);
                if (!$booking) {
                    view('not_found', [
                        'title' => 'Không tìm thấy trang',
                    ]);
                }
                $customers = $this->modelBooking->getCustomersByBookingId($booking['id']);
                require_once './views/hdv/booking/detail_booking.php';
            }
        }
    }

    public function checkInCustomer()
    {
        if (!isLoggedIn()) {
            header('Location: ' . BASE_URL . 'welcome');
            exit;
        }
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $currentUser = getCurrentUser();
            if ($currentUser->isAdmin()) {
                echo "<script>
                        alert('Admin không thể điểm danh khách hàng.');
                        window.history.back();
                    </script>";
                exit;
            } else {
                $booking = $this->modelBooking->getBookingById($id, $currentUser->id);
                if (!$booking) {
                    view('not_found', [
                        'title' => 'Không tìm thấy trang',
                    ]);
                }
                $customers = $this->modelBooking->getCustomersByBookingId($id);
            }

            require_once './views/hdv/booking/checkin.php';
            exit;
        }
    }

    public function updateCheckin()
    {
        if (!isLoggedIn()) {
            header('Location: ' . BASE_URL . 'welcome');
            exit;
        }
        if (isset($_GET['booking_id'])) {
            $id = $_GET['booking_id'];
            $currentUser = getCurrentUser();
            if ($currentUser->isAdmin()) {
                echo "<script>
                        alert('Admin không thể điểm danh khách hàng.');
                        window.history.back();
                    </script>";
                exit;
            } else {
                $bookingId = $_POST['booking_id'] ?? $_GET['booking_id'] ?? null;
                $ghiChuList    = $_POST['ghi_chu'] ?? [];
                $diemDanhList     = $_POST['diem_danh'] ?? [];
                $data = [];
                foreach ($diemDanhList as $khachHangId => $value) {
                    $data[$khachHangId] = [
                        'ghi_chu'   => $ghiChuList[$khachHangId] ?? '',
                        'diem_danh' => $value
                    ];
                }
                $ok = $this->modelBooking->updateCheckinMultiple($bookingId, $data);
                $booking = $this->modelBooking->getBookingById($bookingId, $currentUser->id);
                $customers = $this->modelBooking->getCustomersByBookingId($bookingId);

                require_once './views/hdv/booking/detail_booking.php';
            }
        }
    }
    public function updateHDVBookingForm()
    {
        if (!isLoggedIn()) {
            header('Location: ' . BASE_URL . 'welcome');
            exit;
        }
        if (isset($_GET['booking_id'])) {
            $id = $_GET['booking_id'];
            $currentUser = getCurrentUser();
            if ($currentUser->isAdmin()) {
                echo "<script>
                        alert('Admin không thể vào chức năng này.');
                        window.history.back();
                    </script>";
                exit;
            } else {
                $bookingId = $_POST['booking_id'] ?? $_GET['booking_id'] ?? null;
                $booking = $this->modelBooking->getBookingById($bookingId, $currentUser->id);
                if (!$booking) {
                    view('not_found', [
                        'title' => 'Không tìm thấy trang',
                    ]);
                }
                require_once './views/hdv/booking/update_booking.php';
            }
        }
    }

    public function updateBookingHDV()
    {
        if (!isLoggedIn()) {
            header('Location: ' . BASE_URL . 'welcome');
            exit;
        }
        if (isset($_POST['booking_id'])) {
            $bookingId = $_POST['booking_id'];
            $currentUser = getCurrentUser();
            if ($currentUser->isAdmin()) {
                echo "<script>
                        alert('Admin không thể vào chức năng này.');
                        window.history.back();
                    </script>";
                exit;
            } else {
                $status = $_POST['trang_thai'] ?? '';
                $notes = $_POST['ghi_chu'] ?? '';
                $ok = $this->modelBooking->updateHDVBooking($bookingId, $status, $notes);
                $booking = $this->modelBooking->getBookingById($bookingId, $currentUser->id);
                $customers = $this->modelBooking->getCustomersByBookingId($bookingId);

                require_once './views/hdv/booking/detail_booking.php';
            }
        }
    }

    public function formAddBooking()
    {
        if (!isLoggedIn()) {
            header('Location: ' . BASE_URL . 'welcome');
            exit;
        }
        $currentUser = getCurrentUser();
        if ($currentUser->isAdmin()) {
            $tours = $this->modelTour->getAllTours();
            $users = $this->modelUser->getAllHDV();
    
            require_once './views/admin/booking/form_add_booking.php';
        } else {
            view('not_found', [
                'title' => 'Không tìm thấy trang',
            ]);
        }

    }

    public function addBooking()
    {
        if (!isLoggedIn()) {
            header('Location: ' . BASE_URL . 'welcome');
            exit;
        }
        $currentUser = getCurrentUser();
        if ($currentUser->isAdmin()) {
            $tour_id = intval($_POST['tour_id'] ?? 0);
            $user_id = intval($_POST['user_id'] ?? 0);
            $ngay_dat = $_POST['ngay_dat'] ?? null;
            $gia_tien = floatval($_POST['gia_tien'] ?? 0);
            $trang_thai = $_POST['trang_thai'] ?? 'ChoDuyet';
            $ghi_chu = trim($_POST['ghi_chu'] ?? '');
    
            if ($tour_id <= 0 || $user_id <= 0 || empty($ngay_dat) || $gia_tien <= 0) {
                echo "<script>alert('Vui lòng điền đầy đủ thông tin.'); window.history.back();</script>";
                exit;
            }
    
            if (!$this->modelTour->getTourById($tour_id) || !$this->modelUser->getUserById($user_id)) {
                echo "<script>alert('Tour hoặc Hướng dẫn viên không tồn tại!'); window.history.back();</script>";
                exit;
            }
    
            $ok = $this->modelBooking->addBooking($tour_id, $user_id, $ngay_dat, $gia_tien, $trang_thai, $ghi_chu);
    
            echo "<script>alert('" . ($ok ? "Thêm booking thành công!" : "Thêm booking thất bại!") . "'); 
            window.location.href='" . BASE_URL . "booking';</script>";
            } else {
            view('not_found', [
                'title' => 'Không tìm thấy trang',
            ]);
        }

    }

    
    public function formUpdateBooking()
    {
        if (!isLoggedIn()) {
            header('Location: ' . BASE_URL . 'welcome');
            exit;
        }
        $currentUser = getCurrentUser();
        if ($currentUser->isAdmin()) {
            $id = intval($_GET['id'] ?? 0);
            if ($id <= 0) {
                header('Location: ' . BASE_URL . 'booking');
                exit;
            }
    
            $booking = $this->modelBooking->getBookingById($id);

            if (!$booking) {
                echo "<script>alert('Booking không tồn tại!'); window.location='" . BASE_URL . "booking';</script>";
                exit;
            }
    
            $tours = $this->modelTour->getAllTours();
            $users = $this->modelUser->getAllHDV();
    
            require_once './views/admin/booking/update_booking.php';
        } else {
            view('not_found', [
                'title' => 'Không tìm thấy trang',
            ]);
        }
    }

    public function updateBooking()
    {
        if (!isLoggedIn()) {
            header('Location: ' . BASE_URL . 'welcome');
            exit;
        }
        $currentUser = getCurrentUser();
        if ($currentUser->isAdmin()) {
            $id       = intval($_POST['booking_id'] ?? 0);
            $tour_id  = intval($_POST['tour_id'] ?? 0);
            $user_id  = intval($_POST['user_id'] ?? 0);
            $ngay_dat = $_POST['ngay_dat'] ?? null;
            $gia_tien = floatval($_POST['gia_tien'] ?? 0);
            $trang_thai = $_POST['trang_thai'] ?? 'ChoDuyet';
            $ghi_chu    = trim($_POST['ghi_chu'] ?? '');
    
            // Validate dữ liệu cơ bản
            if ($id <= 0 || $tour_id <= 0 || $user_id <= 0 || empty($ngay_dat) || $gia_tien <= 0) {
                echo "<script>alert('Vui lòng điền đầy đủ thông tin hợp lệ.'); window.history.back();</script>";
                exit;
            }
    
            // Kiểm tra booking tồn tại
            $booking = $this->modelBooking->getBookingById($id);

            if (!$booking) {
                echo "<script>alert('Booking không tồn tại!'); window.location='" . BASE_URL . "booking';</script>";
                exit;
            }
    
            // Kiểm tra tour & HDV tồn tại
            if (!$this->modelTour->getTourById($tour_id)) {
                echo "<script>alert('Tour không tồn tại!'); window.history.back();</script>";
                exit;
            }
            if (!$this->modelUser->getUserById($user_id)) {
                echo "<script>alert('Hướng dẫn viên không tồn tại!'); window.history.back();</script>";
                exit;
            }
    
            // Cập nhật booking
            $ok = $this->modelBooking->updateBooking($id, $tour_id, $user_id, $ngay_dat, $gia_tien, $trang_thai, $ghi_chu);
    
            echo "<script>alert('" . ($ok ? "Cập nhật thành công!" : "Cập nhật thất bại!") . "'); 
            window.location.href='" . BASE_URL . "booking';</script>";
        } else {
            view('not_found', [
                'title' => 'Không tìm thấy trang',
            ]);
        }
    }

    public function deleteBooking()
    {
        if (!isLoggedIn()) {
            header('Location: ' . BASE_URL . 'welcome');
            exit;
        }
        $currentUser = getCurrentUser();
        if ($currentUser->isAdmin()) {
            $id = intval($_GET['id'] ?? 0);
            if ($id <= 0) {
                header('Location: ' . BASE_URL . 'booking');
                exit;
            }
    
            if (!$this->modelBooking->getBookingById($id)) {
                echo "<script>alert('Booking không tồn tại!'); window.location='" . BASE_URL . "booking';</script>";
                exit;
            }
    
            $ok = $this->modelBooking->deleteBooking($id);
    
            echo "<script>alert('" . ($ok ? "Xóa thành công!" : "Xóa thất bại!") . "'); 
            window.location.href='" . BASE_URL . "booking';</script>";
        } else {
            view('not_found', [
                'title' => 'Không tìm thấy trang',
            ]);
        }

    }

    public function formAddCustomerToBooking()
    {
        if (!isLoggedIn()) {
            header('Location: ' . BASE_URL . 'welcome');
            exit;
        }
        $currentUser = getCurrentUser();
        if ($currentUser->isAdmin()) {

            $booking_id = intval($_GET['id'] ?? 0);
            if ($booking_id <= 0) {
                view('not_found', ['title' => 'Không tìm thấy trang']);
                exit;
            }
    
            $booking = $this->modelBooking->getBookingById($booking_id);
            if (!$booking) {
                view('not_found', ['title' => 'Không tìm thấy trang']);
                exit;
            }
    
            $allCustomers = $this->modelCustomer->getAll();
            $bookingCustomers = $this->modelBooking->getCustomersByBookingId($booking_id);
            $bookingCustomerIds = array_column($bookingCustomers, 'khach_hang_id');
    
            require_once './views/admin/booking/form_add_customer.php';
        } else {
            view('not_found', [
                'title' => 'Không tìm thấy trang',
            ]);
        }
    }

    public function addCustomerToBooking()
    {
        if (!isLoggedIn()) {
            header('Location: ' . BASE_URL . 'welcome');
            exit;
        }
        $currentUser = getCurrentUser();
        if ($currentUser->isAdmin()) {
            $booking_id = intval($_POST['booking_id'] ?? 0);
            $customer_ids = $_POST['customer_ids'] ?? [];
    
            if ($booking_id <= 0 || empty($customer_ids)) {
                echo "<script>alert('Vui lòng chọn khách hàng.'); window.history.back();</script>";
                exit;
            }
    
            $booking = $this->modelBooking->getBookingById($booking_id);
            if (!$booking) {
                echo "<script>alert('Booking không tồn tại.'); window.location='" . BASE_URL . "booking';</script>";
                exit;
            }
    
            // lọc id hợp lệ
            $customer_ids = array_filter(array_map('intval', $customer_ids));
    
            if (empty($customer_ids)) {
                echo "<script>alert('Danh sách khách hàng không hợp lệ.'); window.history.back();</script>";
                exit;
            }
    
            $ok = $this->modelBooking->addCustomersToBooking($booking_id, $customer_ids);
    
            echo "<script>alert('" . ($ok ? "Thêm khách hàng thành công!" : "Thêm thất bại!") . "'); 
            window.location.href='" . BASE_URL . "detail-booking&id=" . $booking_id . "';</script>";
        } else {
            view('not_found', [
                'title' => 'Không tìm thấy trang',
            ]);
        }

    }

    /* ============================================================
        REMOVE CUSTOMER
    ============================================================ */
    public function removeCustomerFromBooking()
    {
        if (!isLoggedIn()) {
            header('Location: ' . BASE_URL . 'welcome');
            exit;
        }
        $currentUser = getCurrentUser();
        if ($currentUser->isAdmin()) {
            $booking_id = intval($_GET['booking_id'] ?? 0);
            $customer_id = intval($_GET['customer_id'] ?? 0);
    
            if ($booking_id <= 0 || $customer_id <= 0) {
                echo "<script>alert('Dữ liệu không hợp lệ!'); window.history.back();</script>";
                exit;
            }
    
            $booking = $this->modelBooking->getBookingById($booking_id);
            if (!$booking) {
                echo "<script>alert('Booking không tồn tại!'); window.location='" . BASE_URL . "booking';</script>";
                exit;
            }
    
            $ok = $this->modelBooking->removeCustomerFromBooking($booking_id, $customer_id);
    
            echo "<script>alert('" . ($ok ? "Xóa thành công!" : "Xóa thất bại!") . "'); 
            window.location.href='" . BASE_URL . "detail-booking&id=" . $booking_id . "';</script>";
        } else {
            view('not_found', [
                'title' => 'Không tìm thấy trang',
            ]);
        }


    }
}
