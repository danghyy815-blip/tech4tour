<?php

class CustomerController
{
    public $modelCustomer;

    public function __construct()
    {
        $this->modelCustomer = new Customer();
    }

    public function getList()
    {
        if (!isLoggedIn()) {
            header('Location: ' . BASE_URL . '?act=welcome');
            exit;
        }
        $customers = $this->modelCustomer->getAll();
        require_once "./views/admin/customer/list.php";
    }

    public function formAdd()
    {
        if (!isLoggedIn()) {
            header('Location: ' . BASE_URL . '?act=welcome');
            exit;
        }

        require_once "./views/admin/customer/form_add.php";
    }

    public function add()
    {
        if (!isLoggedIn()) {
            header('Location: ' . BASE_URL . '?act=welcome');
            exit;
        }

        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ho_ten = trim($_POST['ho_ten'] ?? '');
            $gioi_tinh = $_POST['gioi_tinh'] ?? '';
            $ngay_sinh = $_POST['ngay_sinh'] ?? '';
            $so_dien_thoai = trim($_POST['so_dien_thoai'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $dia_chi = trim($_POST['dia_chi'] ?? '');
            $cccd = trim($_POST['cccd'] ?? '');
            $quoc_tich = trim($_POST['quoc_tich'] ?? '');
            $yeu_cau_dac_biet = trim($_POST['yeu_cau_dac_biet'] ?? '');
            $trang_thai = $_POST['trang_thai'] ?? 'đang hoạt động';

            if (empty($ho_ten)) {
                $errors['ho_ten'] = "Họ tên không được để trống.";
            }

            if (empty($gioi_tinh)) {
                $errors['gioi_tinh'] = "Giới tính không được để trống.";
            }

            if (empty($so_dien_thoai)) {
                $errors['so_dien_thoai'] = "Số điện thoại không được để trống.";
            } elseif (!preg_match('/^[0-9]{10,11}$/', $so_dien_thoai)) {
                $errors['so_dien_thoai'] = "Số điện thoại không hợp lệ.";
            }

            if (empty($email)) {
                $errors['email'] = "Email không được để trống.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "Email không hợp lệ.";
            }

            if (!empty($cccd) && !preg_match('/^[0-9]{9,12}$/', $cccd)) {
                $errors['cccd'] = "CCCD không hợp lệ.";
            }

            if (empty($errors)) {
                $this->modelCustomer->add(
                    $ho_ten,
                    $gioi_tinh,
                    $ngay_sinh,
                    $so_dien_thoai,
                    $email,
                    $dia_chi,
                    $cccd,
                    $quoc_tich,
                    $yeu_cau_dac_biet,
                    $trang_thai
                );
                header("Location: " . BASE_URL . "?act=khach-hang");
                exit();
            }
        }
        require_once "./views/admin/customer/form_add.php";
    }

    public function delete()
    {
        if (!isLoggedIn()) {
            header('Location: ' . BASE_URL . '?act=welcome');
            exit;
        }

        $id = $_GET['id'] ?? null;

        if ($id) {
            $this->modelCustomer->softDelete($id);
        }

        header("Location: " . BASE_URL . "?act=khach-hang");
        exit();
    }

    public function formUpdate()
    {
        if (!isLoggedIn()) {
            header('Location: ' . BASE_URL . '?act=welcome');
            exit;
        }

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $customer = $this->modelCustomer->getById($id);

            if (!$customer) {
                header("Location: " . BASE_URL . "?act=khach-hang");
                exit();
            }

            require_once "./views/admin/customer/form_update.php";
        }
    }

    public function update()
    {
        if (!isLoggedIn()) {
            header('Location: ' . BASE_URL . '?act=welcome');
            exit;
        }

        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'] ?? null;
            $ho_ten = trim($_POST['ho_ten'] ?? '');
            $gioi_tinh = $_POST['gioi_tinh'] ?? '';
            $ngay_sinh = $_POST['ngay_sinh'] ?? '';
            $so_dien_thoai = trim($_POST['so_dien_thoai'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $dia_chi = trim($_POST['dia_chi'] ?? '');
            $cccd = trim($_POST['cccd'] ?? '');
            $quoc_tich = trim($_POST['quoc_tich'] ?? '');
            $yeu_cau_dac_biet = trim($_POST['yeu_cau_dac_biet'] ?? '');
            $trang_thai = $_POST['trang_thai'] ?? 'đang hoạt động';

            if (!$id) {
                header("Location: " . BASE_URL . "?act=khach-hang");
                exit();
            }

            if (empty($ho_ten)) {
                $errors['ho_ten'] = "Họ tên không được để trống.";
            }

            if (empty($gioi_tinh)) {
                $errors['gioi_tinh'] = "Giới tính không được để trống.";
            }

            if (empty($so_dien_thoai)) {
                $errors['so_dien_thoai'] = "Số điện thoại không được để trống.";
            } elseif (!preg_match('/^[0-9]{10,11}$/', $so_dien_thoai)) {
                $errors['so_dien_thoai'] = "Số điện thoại không hợp lệ.";
            }

            if (empty($email)) {
                $errors['email'] = "Email không được để trống.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "Email không hợp lệ.";
            }

            if (!empty($cccd) && !preg_match('/^[0-9]{9,12}$/', $cccd)) {
                $errors['cccd'] = "CCCD không hợp lệ.";
            }

            if (empty($errors)) {
                $this->modelCustomer->update(
                    $id,
                    $ho_ten,
                    $gioi_tinh,
                    $ngay_sinh,
                    $so_dien_thoai,
                    $email,
                    $dia_chi,
                    $cccd,
                    $quoc_tich,
                    $yeu_cau_dac_biet,
                    $trang_thai
                );
                header("Location: " . BASE_URL . "?act=khach-hang");
                exit();
            } else {
                $customer = [
                    'id' => $id,
                    'ho_ten' => $ho_ten,
                    'gioi_tinh' => $gioi_tinh,
                    'ngay_sinh' => $ngay_sinh,
                    'so_dien_thoai' => $so_dien_thoai,
                    'email' => $email,
                    'dia_chi' => $dia_chi,
                    'cccd' => $cccd,
                    'quoc_tich' => $quoc_tich,
                    'yeu_cau_dac_biet' => $yeu_cau_dac_biet,
                    'trang_thai' => $trang_thai
                ];
                require_once "./views/admin/customer/form_update.php";
            }
        }
    }

    public function detail()
    {
        if (!isLoggedIn()) {
            header('Location: ' . BASE_URL . '?act=welcome');
            exit;
        }

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $customer = $this->modelCustomer->getById($id);
            if (!$customer) {
                header("Location: " . BASE_URL . "?act=khach-hang");
                exit();
            }
            require_once "./views/admin/customer/detail.php";
        }
    }
}
