<?php

class DanhMucTourController
{
    public $modelDanhMuc;

    public function __construct()
    {
        $this->modelDanhMuc = new DanhMucTour();
    }
    public function getList()
    {

        if (!isLoggedIn()) {
            header('Location: ' . BASE_URL . 'welcome');
            exit;
        }
        $danhMucs = $this->modelDanhMuc->getAll();
        require_once "./views/admin/danh_muc_tour/list.php";
    }

    public function formAdd()
    {
        if (!isLoggedIn()) {
            header('Location: ' . BASE_URL . 'welcome');
            exit;
        }

        require_once "./views/admin/danh_muc_tour/form_add.php";
    }

    public function add()
    {
        if (!isLoggedIn()) {
            header('Location: ' . BASE_URL . 'welcome');
            exit;
        }

        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ten_danh_muc = trim($_POST['ten_danh_muc'] ?? '');
            $mo_ta = trim($_POST['mo_ta'] ?? '');
            $loai = $_POST['loai'] ?? '';

            if (empty($ten_danh_muc)) {
                $errors['ten_danh_muc'] = "Tên danh mục không được để trống.";
            }

            if (empty($loai)) {
                $errors['loai'] = "Loại danh mục không được để trống.";
            }

            if (empty($errors)) {
                $this->modelDanhMuc->add($ten_danh_muc, $mo_ta, $loai);
                header("Location: danh-muc-tour");
                exit();
            }
        }
        require_once "./views/admin/danh_muc_tour/form_add.php";
    }

    public function delete()
    {
        if (!isLoggedIn()) {
            header('Location: ' . BASE_URL . 'welcome');
            exit;
        }

        $id = $_GET['id'] ?? null;

        if ($id) {
            $this->modelDanhMuc->delete($id);
        }

        header("Location: danh-muc-tour");
        exit();
    }


    public function formUpdate()
    {
        if (!isLoggedIn()) {
            header('Location: ' . BASE_URL . 'welcome');
            exit;
        }

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $danhMuc = $this->modelDanhMuc->getById($id);

            if (!$danhMuc) {

                header("Location: danh-muc-tour");
                exit();
            }

            require_once "./views/admin/danh_muc_tour/form_update.php";
        }
    }
    public function update()
    {
        if (!isLoggedIn()) {
            header('Location: ' . BASE_URL . 'welcome');
            exit;
        }

        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'] ?? null;
            $ten_danh_muc = trim($_POST['ten_danh_muc'] ?? '');
            $mo_ta = trim($_POST['mo_ta'] ?? '');
            $loai = $_POST['loai'] ?? '';

            if (!$id) {
                header("Location: danh-muc-tour");
                exit();
            }

            if (empty($ten_danh_muc)) {
                $errors['ten_danh_muc'] = "Tên danh mục không được để trống.";
            }

            if (empty($loai)) {
                $errors['loai'] = "Loại danh mục không được để trống.";
            }

            if (empty($errors)) {
                $this->modelDanhMuc->update($id, $ten_danh_muc, $mo_ta, $loai);
                header("Location: danh-muc-tour");
                exit();
            } else {
                $danhMuc = [
                    'id' => $id,
                    'ten_danh_muc' => $ten_danh_muc,
                    'mo_ta' => $mo_ta,
                    'loai' => $loai
                ];
                require_once "./views/admin/danh_muc_tour/form_update.php";
            }
        }
    }


    public function detail()
    {
        if (!isLoggedIn()) {
            header('Location: ' . BASE_URL . 'welcome');
            exit;
        }

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $danhMuc = $this->modelDanhMuc->getById($id);
            if (!$danhMuc) {
                header("Location: danh-muc-tour");
                exit();
            }
            require_once "./views/admin/danh_muc_tour/detail.php";
        }
    }
}
