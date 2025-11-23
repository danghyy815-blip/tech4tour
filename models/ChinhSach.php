<?php

class ChinhSach
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getAllPolicies()
    {
        try {
            $sql = "SELECT * FROM chinh_sach ORDER BY id DESC";
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
            throw $e;
        }
    }

    public function getPolicyById($id)
    {
        try {
            $sql = "SELECT * FROM chinh_sach WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch();
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
}