<?php

class DanhMucTour
{
    public $id;
    public $ten_danh_muc;
    public $mo_ta;
    public $loai;
    public $conn;

    public function __construct($data = [])
    {
        $this->conn = getDB();

        if (is_array($data)) {
            $this->id = $data['id'] ?? null;
            $this->ten_danh_muc = $data['ten_danh_muc'] ?? '';
            $this->mo_ta = $data['mo_ta'] ?? '';
            $this->loai = $data['loai'] ?? '';
        }
    }


    public function getAll()
    {
        try {
            $sql = "SELECT * FROM danh_muc_tour ORDER BY id DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {

            throw $e;
        }
    }

    public function add($ten_danh_muc, $mo_ta, $loai)
    {
        try {
            $sql = "INSERT INTO danh_muc_tour (ten_danh_muc, mo_ta, loai)
                     VALUES (:ten_danh_muc, :mo_ta, :loai)";
            $stmt = $this->conn->prepare($sql);

            $stmt->bindValue(':ten_danh_muc', $ten_danh_muc);
            $stmt->bindValue(':mo_ta', $mo_ta);
            $stmt->bindValue(':loai', $loai);

            return $stmt->execute();
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function delete($id)
    {
        try {
            $this->conn->beginTransaction();
            $sqlUpdate = "UPDATE tour SET id_danh_muc = NULL WHERE id_danh_muc = :id";
            $stmtUpdate = $this->conn->prepare($sqlUpdate);
            $stmtUpdate->bindValue(':id', $id);
            $stmtUpdate->execute();
            $sqlDelete = "DELETE FROM danh_muc_tour WHERE id = :id";
            $stmtDelete = $this->conn->prepare($sqlDelete);
            $stmtDelete->bindValue(':id', $id);
            $stmtDelete->execute();
            $this->conn->commit();
            return true;
        } catch (PDOException $e) {
            $this->conn->rollBack();
            throw $e;
        }
    }


    public function getById($id)
    {
        try {
            $sql = "SELECT * FROM danh_muc_tour WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw $e;
        }
    }


    public function update($id, $ten_danh_muc, $mo_ta, $loai)
    {
        try {
            $sql = "UPDATE danh_muc_tour 
                    SET ten_danh_muc = :ten_danh_muc,
                        mo_ta = :mo_ta,
                        loai = :loai
                    WHERE id = :id";
            $stmt = $this->conn->prepare($sql);

            $stmt->bindValue(':ten_danh_muc', $ten_danh_muc);
            $stmt->bindValue(':mo_ta', $mo_ta);
            $stmt->bindValue(':loai', $loai);
            $stmt->bindValue(':id', $id);

            return $stmt->execute();
        } catch (PDOException $e) {
            throw $e;
        }
    }
}
