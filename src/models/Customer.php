<?php

class Customer
{
    public $id;
    public $ho_ten;
    public $gioi_tinh;
    public $ngay_sinh;
    public $so_dien_thoai;
    public $email;
    public $dia_chi;
    public $cccd;
    public $quoc_tich;
    public $yeu_cau_dac_biet;
    public $ngay_dang_ky;
    public $trang_thai;
    public $conn;

    public function __construct($data = [])
    {
        $this->conn = getDB();

        if (is_array($data)) {
            $this->id = $data['id'] ?? null;
            $this->ho_ten = $data['ho_ten'] ?? '';
            $this->gioi_tinh = $data['gioi_tinh'] ?? '';
            $this->ngay_sinh = $data['ngay_sinh'] ?? '';
            $this->so_dien_thoai = $data['so_dien_thoai'] ?? '';
            $this->email = $data['email'] ?? '';
            $this->dia_chi = $data['dia_chi'] ?? '';
            $this->cccd = $data['cccd'] ?? '';
            $this->quoc_tich = $data['quoc_tich'] ?? '';
            $this->yeu_cau_dac_biet = $data['yeu_cau_dac_biet'] ?? '';
            $this->ngay_dang_ky = $data['ngay_dang_ky'] ?? null;
            $this->trang_thai = $data['trang_thai'] ?? 'đang hoạt động';
        }
    }

    public function getAll()
    {
        try {
            $sql = "SELECT * FROM khach_hang 
                    WHERE trang_thai != 'xóa' 
                    ORDER BY id DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function add($ho_ten, $gioi_tinh, $ngay_sinh, $so_dien_thoai, $email, $dia_chi, $cccd, $quoc_tich, $yeu_cau_dac_biet, $trang_thai)
    {
        try {
            $sql = "INSERT INTO khach_hang 
                    (ho_ten, gioi_tinh, ngay_sinh, so_dien_thoai, email, dia_chi, cccd, quoc_tich, yeu_cau_dac_biet, trang_thai)
                    VALUES 
                    (:ho_ten, :gioi_tinh, :ngay_sinh, :so_dien_thoai, :email, :dia_chi, :cccd, :quoc_tich, :yeu_cau_dac_biet, :trang_thai)";

            $stmt = $this->conn->prepare($sql);

            $stmt->bindValue(':ho_ten', $ho_ten);
            $stmt->bindValue(':gioi_tinh', $gioi_tinh);
            $stmt->bindValue(':ngay_sinh', $ngay_sinh ?: null);
            $stmt->bindValue(':so_dien_thoai', $so_dien_thoai);
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':dia_chi', $dia_chi);
            $stmt->bindValue(':cccd', $cccd);
            $stmt->bindValue(':quoc_tich', $quoc_tich);
            $stmt->bindValue(':yeu_cau_dac_biet', $yeu_cau_dac_biet);
            $stmt->bindValue(':trang_thai', $trang_thai);

            return $stmt->execute();
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function delete($id)
    {
        try {
            $sql = "DELETE FROM khach_hang WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function softDelete($id)
    {
        try {
            $sql = "UPDATE khach_hang 
                    SET trang_thai = 'xóa' 
                    WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function getById($id)
    {
        try {
            $sql = "SELECT * FROM khach_hang WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function update($id, $ho_ten, $gioi_tinh, $ngay_sinh, $so_dien_thoai, $email, $dia_chi, $cccd, $quoc_tich, $yeu_cau_dac_biet, $trang_thai)
    {
        try {
            $sql = "UPDATE khach_hang 
                    SET ho_ten = :ho_ten,
                        gioi_tinh = :gioi_tinh,
                        ngay_sinh = :ngay_sinh,
                        so_dien_thoai = :so_dien_thoai,
                        email = :email,
                        dia_chi = :dia_chi,
                        cccd = :cccd,
                        quoc_tich = :quoc_tich,
                        yeu_cau_dac_biet = :yeu_cau_dac_biet,
                        trang_thai = :trang_thai
                    WHERE id = :id";

            $stmt = $this->conn->prepare($sql);

            $stmt->bindValue(':ho_ten', $ho_ten);
            $stmt->bindValue(':gioi_tinh', $gioi_tinh);
            $stmt->bindValue(':ngay_sinh', $ngay_sinh ?: null);
            $stmt->bindValue(':so_dien_thoai', $so_dien_thoai);
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':dia_chi', $dia_chi);
            $stmt->bindValue(':cccd', $cccd);
            $stmt->bindValue(':quoc_tich', $quoc_tich);
            $stmt->bindValue(':yeu_cau_dac_biet', $yeu_cau_dac_biet);
            $stmt->bindValue(':trang_thai', $trang_thai);
            $stmt->bindValue(':id', $id);

            return $stmt->execute();
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function getByEmail($email)
    {
        try {
            $sql = "SELECT * FROM khach_hang 
                    WHERE email = :email 
                    AND trang_thai != 'xóa'";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':email', $email);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function getByPhone($so_dien_thoai)
    {
        try {
            $sql = "SELECT * FROM khach_hang 
                    WHERE so_dien_thoai = :so_dien_thoai 
                    AND trang_thai != 'xóa'";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':so_dien_thoai', $so_dien_thoai);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function search($keyword)
    {
        try {
            $sql = "SELECT * FROM khach_hang 
                    WHERE (ho_ten LIKE :keyword 
                        OR email LIKE :keyword 
                        OR so_dien_thoai LIKE :keyword 
                        OR cccd LIKE :keyword)
                    AND trang_thai != 'xóa'
                    ORDER BY id DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':keyword', '%' . $keyword . '%');
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function updateStatus($id, $trang_thai)
    {
        try {
            $sql = "UPDATE khach_hang 
                    SET trang_thai = :trang_thai 
                    WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':trang_thai', $trang_thai);
            $stmt->bindValue(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            throw $e;
        }
    }
}
