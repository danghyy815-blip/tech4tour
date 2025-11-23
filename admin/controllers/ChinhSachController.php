<?php

class ChinhSachController
{
    public $modelPolicy;
    public function __construct()
    {
        $this->modelPolicy = new ChinhSach();
    }

    public function getListPolicy()
    {
        $policies = $this->modelPolicy->getAllPolicies();
        require_once './views/chinh_sach/list_policy.php';
    }
    
    public function formAddPolicy()
    {
        require_once './views/chinh_sach/form_add_policy.php';
    }

    public function addPolicy()
    {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ten_chinh_sach = trim($_POST['ten_chinh_sach']);
            $loai_chinh_sach = $_POST['loai_chinh_sach'];
            $ngay_ap_dung = $_POST['ngay_ap_dung'];
            $ngay_het_han = $_POST['ngay_het_han'];
            $trang_thai = $_POST['trang_thai'];
            $mo_ta = trim($_POST['mo_ta']);

            if (empty($ten_chinh_sach)) {
                $errors['ten_chinh_sach'] = "Tên chính sách không được để trống.";
            }
            if (empty($mo_ta)) {
                $errors['mo_ta'] = "Mô tả khóa hàng.";
            }
            if(empty($ngay_ap_dung)) {
                $errors['ngay_ap_dung'] = "Ngày áp dụng không được để trống.";
            }
            if(empty($ngay_het_han)) {
                $errors['ngay_het_han'] = "Ngày hết hạn không được để trống.";
            }
            if($ngay_ap_dung && $ngay_het_han && ($ngay_het_han < $ngay_ap_dung)) {
                $errors['ngay_het_han'] = "Ngày hết hạn phải sau ngày áp dụng.";
            }

            if (empty($errors)) {
                $this->modelPolicy->addPolicy($ten_chinh_sach, $loai_chinh_sach, $ngay_ap_dung, $ngay_het_han, $trang_thai, $mo_ta);
                header("Location: ?act=policy");
                exit();
            }
        }

        require_once './views/chinh_sach/form_add_policy.php';
    }

    public function deletePolicy()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            try {
                $this->modelPolicy->deletePolicy($id);
                header("Location: ?act=policy");
                exit();
            } catch (PDOException $e) {
                echo "Lỗi: " . $e->getMessage();
            }
        }
    }

    public function formUpdatePolicy()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $policy = $this->modelPolicy->getPolicyById($id);
            require_once './views/chinh_sach/form_update_policy.php';
        }
    }

    public function updatePolicy()
    {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $ten_chinh_sach = trim($_POST['ten_chinh_sach']);
            $loai_chinh_sach = $_POST['loai_chinh_sach'];
            $ngay_ap_dung = $_POST['ngay_ap_dung'];
            $ngay_het_han = $_POST['ngay_het_han'];
            $trang_thai = $_POST['trang_thai'];
            $mo_ta = trim($_POST['mo_ta']);

            if (empty($ten_chinh_sach)) {
                $errors['ten_chinh_sach'] = "Tên chính sách không được để trống.";
            }
            if (empty($mo_ta)) {
                $errors['mo_ta'] = "Mô tả khóa hàng.";
            }
            if(empty($ngay_ap_dung)) {
                $errors['ngay_ap_dung'] = "Ngày áp dụng không được để trống.";
            }
            if(empty($ngay_het_han)) {
                $errors['ngay_het_han'] = "Ngày hết hạn không được để trống.";
            }
            if($ngay_ap_dung && $ngay_het_han && ($ngay_het_han < $ngay_ap_dung)) {
                $errors['ngay_het_han'] = "Ngày hết hạn phải sau ngày áp dụng.";
            }

            if (empty($errors)) {
                $this->modelPolicy->updatePolicy($id, $ten_chinh_sach, $loai_chinh_sach, date('d/m/Y', strtotime($ngay_ap_dung)), date('d/m/Y', strtotime($ngay_het_han)), $trang_thai, $mo_ta);
                header("Location: ?act=policy");
                exit();
            } else {
                $policy = [
                    'id' => $id,
                    'ten_chinh_sach' => $ten_chinh_sach,
                    'loai_chinh_sach' => $loai_chinh_sach,
                    'ngay_ap_dung' => $ngay_ap_dung,
                    'ngay_het_han' => $ngay_het_han,
                    'trang_thai' => $trang_thai,
                    'mo_ta' => $mo_ta
                ];
                require_once './views/chinh_sach/form_update_policy.php';
            }
        }
    }

    public function detailPolicy()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $policy = $this->modelPolicy->getPolicyById($id);
            require_once './views/chinh_sach/detail_policy.php';
        }
    }
}