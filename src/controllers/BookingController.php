<?php

class BookingController
{
    public $modelBooking;
    public function __construct()
    {
        $this->modelBooking = new Booking();
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
        } else {
            $bookings = $this->modelBooking->getBookingsByUserId($currentUser->id);
        }

        require_once "./views/hdv/booking/list_booking.php";
    }



    public function formAddPolicy()
    {
        if (!isLoggedIn()) {
            header('Location: ' . BASE_URL . 'welcome');
            exit;
        }
        require_once './views/admin/chinh_sach/form_add_policy.php';
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
            } else {
                $booking = $this->modelBooking->getBookingById($id, $currentUser->id);
                if (!$booking) {
                    view('not_found', [
                        'title' => 'Không tìm thấy trang',
                    ]);
                }
                $customers = $this->modelBooking->getCustomersByBookingId($booking['id']);
            }

            require_once './views/hdv/booking/detail_booking.php';
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
}
