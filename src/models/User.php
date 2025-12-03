<?php

class User
{
    // Các thuộc tính của User
    public $id;
    public $username;
    public $password_hash;
    public $ho_ten;
    public $gioi_tinh;
    public $ngay_sinh;
    public $so_dien_thoai;
    public $email;
    public $dia_chi;
    public $cccd;
    public $chuc_vu;
    public $ngay_vao_lam;
    public $luong_co_ban;
    public $trang_thai;
    public $conn;
    
    // Constructor để khởi tạo thực thể User
    public function __construct($data = [])
    {
        $this->conn = getDB();

        if (is_array($data)) {
            $this->id = $data['id'] ?? null;
            $this->username = $data['username'] ?? '';
            $this->password_hash = $data['password_hash'] ?? '';
            $this->ho_ten = $data['ho_ten'] ?? '';
            $this->gioi_tinh = $data['gioi_tinh'] ?? '';
            $this->ngay_sinh = $data['ngay_sinh'] ?? '';
            $this->so_dien_thoai = $data['so_dien_thoai'] ?? '';
            $this->email = $data['email'] ?? '';
            $this->dia_chi = $data['dia_chi'] ?? '';
            $this->cccd = $data['cccd'] ?? '';
            $this->chuc_vu = $data['chuc_vu'] ?? 'Hướng dẫn viên';
            $this->ngay_vao_lam = $data['ngay_vao_lam'] ?? '';
            $this->luong_co_ban = $data['luong_co_ban'] ?? '';
            $this->trang_thai = $data['trang_thai'] ?? 1;
        } else {
            $this->username = $data;
        }
    }

    // Kiểm tra đăng nhập
    public function checkLogin($email, $password)
    {
        try {
            $sql = "SELECT * FROM users WHERE email = :email AND password_hash = :password_hash LIMIT 1";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            $stmt->bindValue(':password_hash', md5($password), PDO::PARAM_STR);
            $stmt->execute();
            
            $userData = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($userData) {
                return new User($userData);
            } else {
                return null;
            }
        } catch (PDOException $e) {
            echo "Lỗi: " . $e->getMessage();
            return null;
        }
    }

    // Trả về tên người dùng để hiển thị
    public function getName()
    {
        return $this->ho_ten;
    }

    // Kiểm tra xem user có phải là admin không
    public function isAdmin()
    {
        return $this->chuc_vu === 'Admin';
    }

    // Kiểm tra xem user có phải là hướng dẫn viên không
    public function isGuide()
    {
        return $this->chuc_vu === 'Hướng dẫn viên' || $this->chuc_vu === 'HDV';
    }
    
    // Lấy tất cả user (trừ Admin)
    public function getAllUser() 
    {
        try {
            $sql = "SELECT * FROM users WHERE chuc_vu <> 'Admin' ORDER BY id DESC";
            $stmt = $this->conn->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Lỗi: " . $e->getMessage();
            return [];
        }
    }

    // Thêm người dùng mới
    public function addUser($username, $password, $ho_ten, $gioi_tinh, $ngay_sinh, $so_dien_thoai, $email, $dia_chi, $cccd, $chuc_vu, $ngay_vao_lam, $luong_co_ban, $trang_thai)
    {
        try {
            $sql = "INSERT INTO users (username, password_hash, ho_ten, gioi_tinh, ngay_sinh, so_dien_thoai, email, dia_chi, cccd, chuc_vu, ngay_vao_lam, luong_co_ban, trang_thai)
                    VALUES (:username, :password_hash, :ho_ten, :gioi_tinh, :ngay_sinh, :so_dien_thoai, :email, :dia_chi, :cccd, :chuc_vu, :ngay_vao_lam, :luong_co_ban, :trang_thai)";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':username', $username, PDO::PARAM_STR);
            $stmt->bindValue(':password_hash', md5($password), PDO::PARAM_STR);
            $stmt->bindValue(':ho_ten', $ho_ten, PDO::PARAM_STR);
            $stmt->bindValue(':gioi_tinh', $gioi_tinh, PDO::PARAM_STR);
            $stmt->bindValue(':ngay_sinh', $ngay_sinh, PDO::PARAM_STR);
            $stmt->bindValue(':so_dien_thoai', $so_dien_thoai, PDO::PARAM_STR);
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            $stmt->bindValue(':dia_chi', $dia_chi, PDO::PARAM_STR);
            $stmt->bindValue(':cccd', $cccd, PDO::PARAM_STR);
            $stmt->bindValue(':chuc_vu', $chuc_vu, PDO::PARAM_STR);
            $stmt->bindValue(':ngay_vao_lam', $ngay_vao_lam, PDO::PARAM_STR);
            $stmt->bindValue(':luong_co_ban', $luong_co_ban, PDO::PARAM_STR);
            $stmt->bindValue(':trang_thai', $trang_thai, PDO::PARAM_STR);
            
            $success = $stmt->execute();
            if ($success) {
                return $this->conn->lastInsertId();
            }
            
            $err = $stmt->errorInfo();
            return ['error' => isset($err[2]) ? $err[2] : 'Thực thi SQL thất bại.'];
        } catch (PDOException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    // Cập nhật người dùng
    public function updateUser($id, $username, $password, $ho_ten, $gioi_tinh, $ngay_sinh, $so_dien_thoai, $email, $dia_chi, $cccd, $chuc_vu, $ngay_vao_lam, $luong_co_ban, $trang_thai)
    {
        try {
            if (!empty($password)) {
                $sql = "UPDATE users 
                        SET username = :username, 
                            password_hash = :password_hash, 
                            ho_ten = :ho_ten, 
                            gioi_tinh = :gioi_tinh, 
                            ngay_sinh = :ngay_sinh, 
                            so_dien_thoai = :so_dien_thoai, 
                            email = :email, 
                            dia_chi = :dia_chi, 
                            cccd = :cccd, 
                            chuc_vu = :chuc_vu, 
                            ngay_vao_lam = :ngay_vao_lam, 
                            luong_co_ban = :luong_co_ban, 
                            trang_thai = :trang_thai 
                        WHERE id = :id";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindValue(':password_hash', md5($password), PDO::PARAM_STR);
            } else {
                $sql = "UPDATE users 
                        SET username = :username, 
                            ho_ten = :ho_ten, 
                            gioi_tinh = :gioi_tinh, 
                            ngay_sinh = :ngay_sinh, 
                            so_dien_thoai = :so_dien_thoai, 
                            email = :email, 
                            dia_chi = :dia_chi, 
                            cccd = :cccd, 
                            chuc_vu = :chuc_vu, 
                            ngay_vao_lam = :ngay_vao_lam, 
                            luong_co_ban = :luong_co_ban, 
                            trang_thai = :trang_thai 
                        WHERE id = :id";
                $stmt = $this->conn->prepare($sql);
            }

            $stmt->bindValue(':username', $username, PDO::PARAM_STR);
            $stmt->bindValue(':ho_ten', $ho_ten, PDO::PARAM_STR);
            $stmt->bindValue(':gioi_tinh', $gioi_tinh, PDO::PARAM_STR);
            $stmt->bindValue(':ngay_sinh', $ngay_sinh, PDO::PARAM_STR);
            $stmt->bindValue(':so_dien_thoai', $so_dien_thoai, PDO::PARAM_STR);
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            $stmt->bindValue(':dia_chi', $dia_chi, PDO::PARAM_STR);
            $stmt->bindValue(':cccd', $cccd, PDO::PARAM_STR);
            $stmt->bindValue(':chuc_vu', $chuc_vu, PDO::PARAM_STR);
            $stmt->bindValue(':ngay_vao_lam', $ngay_vao_lam, PDO::PARAM_STR);
            $stmt->bindValue(':luong_co_ban', $luong_co_ban, PDO::PARAM_STR);
            $stmt->bindValue(':trang_thai', $trang_thai, PDO::PARAM_STR);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Lỗi khi cập nhật người dùng: " . $e->getMessage();
            return false;
        }
    }

    // Xóa người dùng theo id
    public function deleteUser($id)
    {
        try {
            $stmt = $this->conn->prepare("DELETE FROM users WHERE id = :id");
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Lỗi khi xóa người dùng: " . $e->getMessage();
            return false;
        }
    }

    // Lấy người dùng theo id
    public function getUserById($id)
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE id = :id LIMIT 1");
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Lỗi khi lấy người dùng: " . $e->getMessage();
            return null;
        }
    }
    
    // Lấy tất cả hướng dẫn viên (HDV)
    public function getAllHDV()
    {
        try {
            // SỬA: So sánh với 1 thay vì 'active'
            $sql = "SELECT * FROM users 
                    WHERE chuc_vu IN ('HDV', 'Hướng dẫn viên') 
                    AND trang_thai = 1 
                    ORDER BY ho_ten ASC";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Lỗi: " . $e->getMessage();
            return [];
        }
    }

   
}