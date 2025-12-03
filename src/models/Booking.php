<?php


class Booking
{
    public $conn;

    // Constructor để khởi tạo thực thể User
    public function __construct($data = [])
    {
        $this->conn = getDB();
    }

    public function getBookingsByUserId($user_id)
    {
        $sql = "SELECT booking.*, tour.ten_tour FROM booking join tour on booking.tour_id = tour.id WHERE user_id = :user_id ORDER BY booking.id DESC";
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function getAllBookings()
    {
        try {
            $sql = "SELECT b.*, t.ten_tour, u.ho_ten as user_ho_ten, u.email as user_email
            FROM booking b
            JOIN tour t ON b.tour_id = t.id
            LEFT JOIN users u ON b.user_id = u.id
            ORDER BY b.id DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function addBooking($tour_id, $user_id, $ngay_dat, $gia_tien, $trang_thai, $ghi_chu)
    {
        $sql = "INSERT INTO booking (tour_id, user_id, ngay_dat, gia_tien, trang_thai, ghi_chu)
                VALUES (:tour_id, :user_id, :ngay_dat, :gia_tien, :trang_thai, :ghi_chu)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':tour_id', $tour_id, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':ngay_dat', $ngay_dat, PDO::PARAM_STR);
        $stmt->bindParam(':gia_tien', $gia_tien, PDO::PARAM_STR);
        $stmt->bindParam(':trang_thai', $trang_thai, PDO::PARAM_STR);
        $stmt->bindParam(':ghi_chu', $ghi_chu, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function deleteBooking($id)
    {
        try {
            $this->conn->beginTransaction();

            $stmt1 = $this->conn->prepare("DELETE FROM booking_khach_hang WHERE booking_id = :id");
            $stmt1->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt1->execute();

            $stmt2 = $this->conn->prepare("DELETE FROM booking WHERE id = :id");
            $stmt2->bindParam(':id', $id, PDO::PARAM_INT);
            $result = $stmt2->execute();

            $this->conn->commit();
            return $result;
        } catch (PDOException $e) {
            $this->conn->rollBack();
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }
    public function getBookingById($id, $user_id = null)
    {
        try { 
            if ($user_id) {
                $sql = "SELECT booking.*, tour.*, booking.trang_thai as booking_trang_thai, booking.id as id, u.ho_ten as user_ho_ten, 
                    u.email as user_email
                    FROM booking 
                    JOIN tour ON booking.tour_id = tour.id 
                    LEFT JOIN users u ON booking.user_id = u.id
                    WHERE booking.id = :id AND booking.user_id = :user_id";
            } else {
                $sql = "SELECT booking.*, tour.*, booking.trang_thai as booking_trang_thai, booking.id as id, u.ho_ten as user_ho_ten, 
                    u.email as user_email
                    FROM booking 
                    JOIN tour ON booking.tour_id = tour.id 
                    LEFT JOIN users u ON booking.user_id = u.id
                    WHERE booking.id = :id";
            }

            $stmt = $this->conn->prepare($sql);

            // Bind chung
            $stmt->bindParam(':id', $id);

            // Bind thêm khi có user
            if ($user_id) {
                $stmt->bindParam(':user_id', $user_id);
            }

            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function updateBooking($id, $tour_id, $user_id, $ngay_dat, $gia_tien, $trang_thai, $ghi_chu)
    {
        $sql = "UPDATE booking
                SET tour_id = :tour_id,
                    user_id = :user_id,
                    ngay_dat = :ngay_dat,
                    gia_tien = :gia_tien,
                    trang_thai = :trang_thai,
                    ghi_chu = :ghi_chu
                WHERE id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':tour_id', $tour_id, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':ngay_dat', $ngay_dat, PDO::PARAM_STR);
        $stmt->bindParam(':gia_tien', $gia_tien, PDO::PARAM_STR);
        $stmt->bindParam(':trang_thai', $trang_thai, PDO::PARAM_STR);
        $stmt->bindParam(':ghi_chu', $ghi_chu, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function getCustomersByBookingId($booking_id)
    {
        try {
            $sql = "SELECT khach_hang.*, booking_khach_hang.*
                    FROM khach_hang 
                    JOIN booking_khach_hang ON khach_hang.id = booking_khach_hang.khach_hang_id 
                    WHERE booking_khach_hang.booking_id = :booking_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':booking_id', $booking_id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function updateCheckinMultiple($bookingId, $data)
    {
        $sql = "UPDATE booking_khach_hang 
            SET ghi_chu = :ghichu, diem_danh = :diemdanh
            WHERE booking_id = :bid AND khach_hang_id = :kid";

        $stmt = $this->conn->prepare($sql);

        foreach ($data as $khachHangId => $info) {
            $stmt->bindParam(':ghichu', $info['ghi_chu']);
            $stmt->bindParam(':diemdanh', $info['diem_danh']);
            $stmt->bindParam(':bid', $bookingId);
            $stmt->bindParam(':kid', $khachHangId);
            $stmt->execute();
        }

        return true;
    }

    public function updateHDVBooking($bookingId, $status, $notes)
    {
        try {
            $sql = "UPDATE booking 
                SET trang_thai = :status,
                    ghi_chu = :notes
                WHERE id = :id";

            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':notes', $notes);
            $stmt->bindParam(':id', $bookingId);

            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }

    
    public function addCustomersToBooking($booking_id, $customer_ids)
    {

        foreach ($customer_ids as $cid) {
            $cid = intval($cid);
            $stmt = $this->conn->prepare(
                "INSERT INTO booking_khach_hang (booking_id, khach_hang_id, diem_danh)
                 VALUES (:booking_id, :customer_id, :diem_danh)"
            );
            $dd = '0';
            $stmt->bindParam(':booking_id', $booking_id, PDO::PARAM_INT);
            $stmt->bindParam(':customer_id', $cid, PDO::PARAM_INT);
            $stmt->bindParam(':diem_danh',$dd, PDO::PARAM_INT);
            $stmt->execute();
        }
        return true;
    }   

    // Xóa khách hàng khỏi booking
    public function removeCustomerFromBooking($booking_id, $customer_id)
    {
        $stmt = $this->conn->prepare(
            "DELETE FROM booking_khach_hang WHERE booking_id=:booking_id AND khach_hang_id=:customer_id"
        );
        $stmt->bindParam(':booking_id', $booking_id, PDO::PARAM_INT);
        $stmt->bindParam(':customer_id', $customer_id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}