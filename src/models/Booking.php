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
            $sql = "SELECT booking.*, tour.ten_tour FROM booking join tour on booking.tour_id = tour.id ORDER BY booking.id DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function addPolicy($ten_chinh_sach, $loai_chinh_sach, $ngay_ap_dung, $ngay_het_han, $trang_thai, $mo_ta)
    {
        try {
            $sql = "INSERT INTO chinh_sach (ten_chinh_sach, loai_chinh_sach, ngay_ap_dung, ngay_het_han, trang_thai, mo_ta) 
                    VALUES (:ten_chinh_sach, :loai_chinh_sach, :ngay_ap_dung, :ngay_het_han, :trang_thai, :mo_ta)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':ten_chinh_sach', $ten_chinh_sach);
            $stmt->bindParam(':loai_chinh_sach', $loai_chinh_sach);
            $stmt->bindParam(':ngay_ap_dung', $ngay_ap_dung);
            $stmt->bindParam(':ngay_het_han', $ngay_het_han);
            $stmt->bindParam(':trang_thai', $trang_thai);
            $stmt->bindParam(':mo_ta', $mo_ta);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function deletePolicy($id)
    {
        try {
            $sql = "DELETE FROM chinh_sach WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function getBookingById($id, $user_id = null)
    {
        try {
            if ($user_id) {
                $sql = "SELECT booking.*, tour.*, booking.trang_thai as booking_trang_thai 
                    FROM booking 
                    JOIN tour ON booking.tour_id = tour.id 
                    WHERE booking.id = :id AND booking.user_id = :user_id";
            } else {
                $sql = "SELECT booking.*, tour.*, booking.trang_thai as booking_trang_thai 
                    FROM booking 
                    JOIN tour ON booking.tour_id = tour.id 
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


    public function updatePolicy($id, $ten_chinh_sach, $loai_chinh_sach, $ngay_ap_dung, $ngay_het_han, $trang_thai, $mo_ta)
    {
        try {
            $sql = "UPDATE chinh_sach 
                    SET ten_chinh_sach = :ten_chinh_sach, 
                        loai_chinh_sach = :loai_chinh_sach, 
                        ngay_ap_dung = :ngay_ap_dung, 
                        ngay_het_han = :ngay_het_han, 
                        trang_thai = :trang_thai, 
                        mo_ta = :mo_ta 
                    WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':ten_chinh_sach', $ten_chinh_sach);
            $stmt->bindParam(':loai_chinh_sach', $loai_chinh_sach);
            $stmt->bindParam(':ngay_ap_dung', $ngay_ap_dung);
            $stmt->bindParam(':ngay_het_han', $ngay_het_han);
            $stmt->bindParam(':trang_thai', $trang_thai);
            $stmt->bindParam(':mo_ta', $mo_ta);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Lỗi: " . $e->getMessage();
        }
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
}
