<?php

class UserController
{
    public $modelUser;
    public function __construct()
    {
        $this->modelUser = new User();
    }

    // Lấy danh sách chính sách
    public function getListUser()
    {
        // Yêu cầu phải đăng nhập, nếu chưa thì redirect về welcome
        if (!isLoggedIn()) {
            header('Location: ' . BASE_URL . 'welcome');
            exit;
        }
        $users = $this->modelUser->getAllUser();
        require_once "./views/admin/user/list_user.php";
    }

    public function formAddUser()
    {
        if (!isLoggedIn()) {
            header('Location: ' . BASE_URL . 'welcome');
            exit;
        }
        require_once './views/admin/user/form_add_user.php';
    }

    public function addUser()
    {
        if (!isLoggedIn()) {
            header('Location: ' . BASE_URL . 'welcome');
            exit;
        }
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = trim($_POST['username']);
            $password_hash = $_POST['password_hash'];
            $ho_ten = $_POST['ho_ten'];
            $gioi_tinh = $_POST['gioi_tinh'];
            $ngay_sinh = $_POST['ngay_sinh'];
            $so_dien_thoai = $_POST['so_dien_thoai'];
            $email = $_POST['email'];
            $dia_chi = $_POST['dia_chi'];
            $cccd = $_POST['cccd'];
            $chuc_vu = $_POST['chuc_vu'];
            $ngay_vao_lam = $_POST['ngay_vao_lam'];
            $luong_co_ban = $_POST['luong_co_ban'];
            $trang_thai = $_POST['trang_thai'];

            if (empty($username)) {
                $errors['username'] = "Tên người dùng không được để trống.";
            }
            if (empty($password_hash)) {
                $errors['password_hash'] = "Mật khẩu không được để trống";
            }
            if (empty($ho_ten)) {
                $errors['ho_ten'] = "Họ&tên không được để trống.";
            }
            if (empty($gioi_tinh)) {
                $errors['gioi_tinh'] = "Giới tính không được để trống.";
            }
            if (empty($ngay_sinh)) {
                $errors['ngay_sinh'] = "Ngày sinh không được để trống.";
            }
            if (empty($so_dien_thoai)) {
                $errors['so_dien_thoai'] = "Số điện thoại không được để trống.";
            }
            if (empty($email)) {
                $errors['email'] = "Email không được để trống.";
            }
            if (empty($dia_chi)) {
                $errors['dia_chi'] = "Địa chỉ không được để trống.";
            }
            if (empty($cccd)) {
                $errors['cccd'] = "Cccd không được để trống.";
            }
            if (empty($chuc_vu)) {
                $errors['chuc_vu'] = "Chức vụ không được để trống.";
            }
            if (empty($ngay_vao_lam)) {
                $errors['ngay_vao_lam'] = "Ngày vào làm không được để trống.";
            }
            if (empty($luong_co_ban)) {
                $errors['luong_co_ban'] = "Lương không được để trống.";
            }
             if (empty($trang_thai)) {
                $errors['trang_thai'] = "Trạng thái không được để trống.";
            }
            

            if (empty($errors)) {
                $res = $this->modelUser->addUser($username, $password_hash, $ho_ten, $gioi_tinh, $ngay_sinh, $so_dien_thoai, $email, $dia_chi, $cccd, $chuc_vu, $ngay_vao_lam, $luong_co_ban, $trang_thai);
                if (is_array($res) && isset($res['error'])) {
                    setFlash('error', 'Thêm nhân viên thất bại: ' . $res['error']);
                } elseif ($res) {
                    setFlash('success', 'Thêm nhân viên thành công.');
                } else {
                    setFlash('error', 'Thêm nhân viên thất bại.');
                }
                // Sau khi thêm, chuyển về trang quản lý người dùng
                header("Location: user");
                exit();
            }
        }

        require_once './views/admin/user/form_add_user.php';
    }

    public function deleteUser()
    {
        if (!isLoggedIn()) {
            header('Location: ' . BASE_URL . 'welcome');
            exit;
        }
        $id = $_GET['id'] ?? null;
        if ($id) {
            $current = getCurrentUser();
            if ($current && isset($current->id) && $current->id == $id) {
                // Không cho xóa chính tài khoản đang đăng nhập
                setFlash('error', 'Không thể xóa chính bạn.');
                header("Location: user");
                exit();
            }

            $deleted = $this->modelUser->deleteUser($id);
            if ($deleted) {
                setFlash('success', 'Xóa nhân viên thành công.');
            } else {
                setFlash('error', 'Xóa nhân viên thất bại.');
            }
        }
        header("Location: user");
        exit();
    }

    public function formUpdateUser()
    {
        if (!isLoggedIn()) {
            header('Location: ' . BASE_URL . 'welcome');
            exit;
        }
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $user = $this->modelUser->getUserById($id);
            require_once './views/admin/user/form_update_user.php';
        }
    }

    public function updateUser()
    {
        if (!isLoggedIn()) {
            header('Location: ' . BASE_URL . 'welcome');
            exit;
        }
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $username = trim($_POST['username']);
            $password_hash = $_POST['password_hash'];
            $ho_ten = $_POST['ho_ten'];
            $gioi_tinh = $_POST['gioi_tinh'];
            $ngay_sinh = $_POST['ngay_sinh'];
            $so_dien_thoai = trim($_POST['so_dien_thoai']);
            $email = trim($_POST['email']);
            $dia_chi = $_POST['dia_chi'];
            $cccd = $_POST['cccd'];
            $chuc_vu = $_POST['chuc_vu'];
            $ngay_vao_lam = $_POST['ngay_vao_lam'];
            $luong_co_ban = trim($_POST['luong_co_ban']);
            $trang_thai = trim($_POST['trang_thai']);


            if (empty($username)) {
                $errors['username'] = "Tên người dùng không được để trống.";
            }
            if (empty($ho_ten)) {
                $errors['ho_ten'] = "Họ&tên không được để trống.";
            }
            if (empty($gioi_tinh)) {
                $errors['gioi_tinh'] = "Giới tính không được để trống.";
            }
            if (empty($ngay_sinh)) {
                $errors['ngay_sinh'] = "Ngày sinh không được để trống.";
            }
            if (empty($so_dien_thoai)) {
                $errors['so_dien_thoai'] = "Số điện thoại không được để trống.";
            }
            if (empty($email)) {
                $errors['email'] = "Email không được để trống.";
            }
            if (empty($dia_chi)) {
                $errors['dia_chi'] = "Địa chỉ không được để trống.";
            }
            if (empty($cccd)) {
                $errors['cccd'] = "Cccd không được để trống.";
            }
            if (empty($chuc_vu)) {
                $errors['chuc_vu'] = "Chức vụ không được để trống.";
            }
            if (empty($ngay_vao_lam)) {
                $errors['ngay_vao_lam'] = "Ngày vào làm không được để trống.";
            }
            if (empty($luong_co_ban)) {
                $errors['luong_co_ban'] = "Lương không được để trống.";
            }
            if (!isset($_POST['trang_thai']) || $_POST['trang_thai'] === '') {
                $errors['trang_thai'] = "Trạng thái không được để trống.";
            }

            if (empty($errors)) {
                $updated = $this->modelUser->updateUser($id, $username, $password_hash, $ho_ten, $gioi_tinh, $ngay_sinh, $so_dien_thoai, $email, $dia_chi, $cccd, $chuc_vu, $ngay_vao_lam, $luong_co_ban, $trang_thai);
                if ($updated) {
                    setFlash('success', 'Cập nhật nhân viên thành công.');
                } else {
                    setFlash('error', 'Cập nhật nhân viên thất bại.');
                }
                header("Location: user");
                exit();
            } else {
                $user = [
                    'id' => $id,
                    'username' => $username,
                    'password_hash' => $password_hash,
                    'ho_ten' => $ho_ten,
                    'gioi_tinh' => $gioi_tinh,
                    'ngay_sinh' => $ngay_sinh,
                    'so_dien_thoai' => $so_dien_thoai,
                    'email' => $email,
                    'dia_chi' => $dia_chi,
                    'cccd' => $cccd,
                    'chuc_vu' => $chuc_vu,
                    'ngay_vao_lam' => $ngay_vao_lam,
                    'luong_co_ban' => $luong_co_ban,
                    'trang_thai' => $trang_thai
                ];
                require_once './views/admin/user/form_update_user.php';
            }
        }
    }

    public function detailUser()
    {
        if (!isLoggedIn()) {
            header('Location: ' . BASE_URL . 'welcome');
            exit;
        }
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $user = $this->modelUser->getUserById($id);
            require_once './views/admin/user/detail_user.php';
        }
    }
}
