<?php

// Model User đại diện cho thực thể người dùng trong hệ thống
class User
{
    // Các thuộc tính của User
    public $id;
    public $ho_ten;
    public $email;
    public $role;
    public $status;
    public $chuc_vu;
    public $conn;

    // Constructor để khởi tạo thực thể User
    public function __construct($data = [])
    {
        $this->conn = getDB();
        // Nếu truyền vào mảng dữ liệu thì gán vào các thuộc tính

        if (is_array($data)) {
            $this->id = $data['id'] ?? null;
            $this->ho_ten = $data['ho_ten'] ?? '';
            $this->email = $data['email'] ?? '';
            $this->status = $data['status'] ?? 1;
            $this->chuc_vu = $data['chuc_vu'] ?? 'huong_dan_vien';
        } else {
            // Nếu truyền vào string thì coi như tên (tương thích với code cũ)
            $this->ho_ten = $data;
        }
    }

    public function checkLogin($email, $password)
    {
        try {
            $sql = "SELECT * FROM users WHERE email = :email AND password_hash = :password_hash LIMIT 1";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':password_hash', md5($password));
            $stmt->execute();
            $userData = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($userData) {
                return new User($userData);
            } else {
                return null;
            }
        } catch (PDOException $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    // Trả về tên người dùng để hiển thị
    public function getName()
    {
        return $this->ho_ten;
    }

    // Kiểm tra xem user có phải là admin không
    // @return bool true nếu là admin, false nếu không
    public function isAdmin()
    {

        return $this->chuc_vu === 'Admin';
    }

    // Kiểm tra xem user có phải là hướng dẫn viên không
    // @return bool true nếu là hướng dẫn viên, false nếu không
    public function isGuide()
    {
        return $this->chuc_vu === 'huong_dan_vien';
    }
}
