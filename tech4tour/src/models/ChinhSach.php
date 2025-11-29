<?php


class ChinhSach
{
    // Các thuộc tính của User
    public $id;
    public $ten_chinh_sach;
    public $loai_chinh_sach;
    public $ngay_ap_dung;
    public $ngay_het_han;
    public $trang_thai;
    public $mo_ta;
    public $conn;

    // Constructor để khởi tạo thực thể User
    public function __construct($data = [])
    {
        $this->conn = getDB();
        if (is_array($data)) {
            $this->id = $data['id'] ?? null;
            $this->ten_chinh_sach = $data['ten_chinh_sach'] ?? '';
            $this->loai_chinh_sach = $data['loai_chinh_sach'] ?? '';
            $this->ngay_ap_dung = $data['ngay_ap_dung'] ?? '';
            $this->ngay_het_han = $data['ngay_het_han'] ?? "";
            $this->trang_thai = $data['trang_thai'] ?? "";
            $this->mo_ta = $data['mo_ta'] ?? "";
        } else {
            // Nếu truyền vào string thì coi như tên (tương thích với code cũ)
            $this->ten_chinh_sach = $data;
        }
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
            echo "Lỗi: " . $e->getMessage();
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
