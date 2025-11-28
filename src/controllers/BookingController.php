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
            header('Location: ' . BASE_URL_HDV . 'welcome');
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
}
