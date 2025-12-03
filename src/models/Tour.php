<?php

class Tour
{
    // Các thuộc tính của Tour
    public $id;
    public $ten_tour;
    public $id_danh_muc;
    public $lich_trinh;
    public $hinh_anh;
    public $gia;
    public $chinh_sach_ids; 
    public $nha_cung_cap;
    public $loai_tour;
    public $trang_thai;
    public $ngay_tao;
    public $ngay_cap_nhat;
    public $dia_diem;
    public $price;

    public $conn;

    // Constructor để khởi tạo thực thể Tour
    public function __construct($data = [])
    {
        $this->conn = getDB();
        if (is_array($data)) {
            $this->id = $data['id'] ?? null;
            $this->ten_tour = $data['ten_tour'] ?? '';
            $this->id_danh_muc = $data['id_danh_muc'] ?? null;
            $this->lich_trinh = $data['lich_trinh'] ?? '';
            $this->hinh_anh = $data['hinh_anh'] ?? '';
            $this->gia = $data['gia'] ?? 0;
            $this->chinh_sach_ids = $data['chinh_sach_ids'] ?? null; 
            $this->nha_cung_cap = $data['nha_cung_cap'] ?? '';
            $this->loai_tour = $data['loai_tour'] ?? '';
            $this->trang_thai = $data['trang_thai'] ?? '';
            $this->ngay_tao = $data['ngay_tao'] ?? null;
            $this->ngay_cap_nhat = $data['ngay_cap_nhat'] ?? null;
            $this->dia_diem = $data['dia_diem'] ?? '';
            $this->price = $data['price'] ?? 0;
        } else {
            $this->ten_tour = $data;
        }
    }

    public function getAllTours()
    {
        try {
            $sql = "SELECT * FROM tour ORDER BY id DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function addTour($ten_tour, $id_danh_muc, $lich_trinh, $hinh_anh, $gia, 
        $chinh_sach_ids, $nha_cung_cap, $loai_tour, $trang_thai, $dia_diem, $price)
    {
        try {
            $sql = "INSERT INTO tour (ten_tour, id_danh_muc, lich_trinh, hinh_anh, gia, 
                    chinh_sach_ids, nha_cung_cap, loai_tour, trang_thai, ngay_tao, 
                    ngay_cap_nhat, dia_diem, price)
                    VALUES (:ten_tour, :id_danh_muc, :lich_trinh, :hinh_anh, :gia, 
                    :chinh_sach_ids, :nha_cung_cap, :loai_tour, :trang_thai, NOW(), 
                    NOW(), :dia_diem, :price)";
            
            $stmt = $this->conn->prepare($sql);
            
            $stmt->bindParam(':ten_tour', $ten_tour);
            $stmt->bindParam(':id_danh_muc', $id_danh_muc);
            $stmt->bindParam(':lich_trinh', $lich_trinh);
            $stmt->bindParam(':hinh_anh', $hinh_anh);
            $stmt->bindParam(':gia', $gia);
            $stmt->bindParam(':chinh_sach_ids', $chinh_sach_ids);
            $stmt->bindParam(':nha_cung_cap', $nha_cung_cap);
            $stmt->bindParam(':loai_tour', $loai_tour);
            $stmt->bindParam(':trang_thai', $trang_thai);
            $stmt->bindParam(':dia_diem', $dia_diem);
            $stmt->bindParam(':price', $price);
            
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Lỗi addTour: " . $e->getMessage();
            return false;
        }
    }

    public function deleteTour($id)
    {
        try {
            $sql = "DELETE FROM tour WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function getTourById($id)
    {
        try {
            $sql = "SELECT * FROM tour WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function updateTour($id, $ten_tour, $id_danh_muc, $lich_trinh, $hinh_anh, 
        $gia, $chinh_sach_ids, $nha_cung_cap, $loai_tour, $trang_thai, $dia_diem, $price)
    {
        try {
            $sql = "UPDATE tour SET 
                        ten_tour = :ten_tour,
                        id_danh_muc = :id_danh_muc,
                        lich_trinh = :lich_trinh,
                        hinh_anh = :hinh_anh,
                        gia = :gia,
                        chinh_sach_ids = :chinh_sach_ids,
                        nha_cung_cap = :nha_cung_cap,
                        loai_tour = :loai_tour,
                        trang_thai = :trang_thai,
                        ngay_cap_nhat = NOW(),
                        dia_diem = :dia_diem,
                        price = :price
                    WHERE id = :id";
            
            $stmt = $this->conn->prepare($sql);
            
            $stmt->bindParam(':ten_tour', $ten_tour);
            $stmt->bindParam(':id_danh_muc', $id_danh_muc);
            $stmt->bindParam(':lich_trinh', $lich_trinh);
            $stmt->bindParam(':hinh_anh', $hinh_anh);
            $stmt->bindParam(':gia', $gia);
            $stmt->bindParam(':chinh_sach_ids', $chinh_sach_ids);
            $stmt->bindParam(':nha_cung_cap', $nha_cung_cap);
            $stmt->bindParam(':loai_tour', $loai_tour);
            $stmt->bindParam(':trang_thai', $trang_thai);
            $stmt->bindParam(':dia_diem', $dia_diem);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':id', $id);
            
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Lỗi updateTour: " . $e->getMessage();
            return false;
        }
    }
}