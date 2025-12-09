<?php

class TourLichTrinh
{
    // Thuộc tính
    public $id;
    public $tour_id;
    public $tieu_de;
    public $noi_dung;
    public $ngay_thu;
    public $hinh_anh;
    public $thu_tu;
    public $created_at;
    public $updated_at;

    public $conn;

    public function __construct($data = [])
    {
        $this->conn = getDB();

        if (is_array($data)) {
            $this->id = $data['id'] ?? null;
            $this->tour_id = $data['tour_id'] ?? null;
            $this->tieu_de = $data['tieu_de'] ?? '';
            $this->noi_dung = $data['noi_dung'] ?? '';
            $this->ngay_thu = $data['ngay_thu'] ?? '';
            $this->hinh_anh = $data['hinh_anh'] ?? '';
            $this->thu_tu = $data['thu_tu'] ?? 1;
            $this->created_at = $data['created_at'] ?? null;
            $this->updated_at = $data['updated_at'] ?? null;
        }
    }

    // Lấy tất cả lịch trình
    public function getAll()
    {
        $sql = "SELECT lt.*, t.ten_tour 
                FROM tour_lich_trinh lt
                JOIN tour t ON lt.tour_id = t.id
                ORDER BY lt.tour_id, lt.thu_tu ASC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Lấy lịch trình theo tour
    public function getByTourId($tour_id)
    {
        $sql = "SELECT * FROM tour_lich_trinh 
                WHERE tour_id = :tour_id 
                ORDER BY thu_tu ASC";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':tour_id', $tour_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Lấy 1 lịch trình theo ID
    public function getById($id)
    {
        $sql = "SELECT * FROM tour_lich_trinh WHERE id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch();
    }

    // Thêm mới
    public function add($tour_id, $tieu_de, $noi_dung, $ngay_thu, $hinh_anh, $thu_tu)
    {
        $sql = "INSERT INTO tour_lich_trinh (tour_id, tieu_de, noi_dung, ngay_thu, hinh_anh, thu_tu, created_at, updated_at)
                VALUES (:tour_id, :tieu_de, :noi_dung, :ngay_thu, :hinh_anh, :thu_tu, NOW(), NOW())";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':tour_id', $tour_id);
        $stmt->bindParam(':tieu_de', $tieu_de);
        $stmt->bindParam(':noi_dung', $noi_dung);
        $stmt->bindParam(':ngay_thu', $ngay_thu);
        $stmt->bindParam(':hinh_anh', $hinh_anh);
        $stmt->bindParam(':thu_tu', $thu_tu);

        return $stmt->execute();
    }

    // Cập nhật
    public function update($id, $tour_id, $tieu_de, $noi_dung, $ngay_thu, $hinh_anh, $thu_tu)
    {
        $sql = "UPDATE tour_lich_trinh 
                SET 
                    tour_id = :tour_id,
                    tieu_de = :tieu_de,
                    noi_dung = :noi_dung,
                    ngay_thu = :ngay_thu,
                    hinh_anh = :hinh_anh,
                    thu_tu = :thu_tu,
                    updated_at = NOW()
                WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':tour_id', $tour_id);
        $stmt->bindParam(':tieu_de', $tieu_de);
        $stmt->bindParam(':noi_dung', $noi_dung);
        $stmt->bindParam(':ngay_thu', $ngay_thu);
        $stmt->bindParam(':hinh_anh', $hinh_anh);
        $stmt->bindParam(':thu_tu', $thu_tu);

        return $stmt->execute();
    }

    // Xóa
    public function delete($id)
    {
        $sql = "DELETE FROM tour_lich_trinh WHERE id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }
}
