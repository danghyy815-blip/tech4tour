<?php

class TourController
{
    public $modelTour;

    public function __construct()
    {
        $this->modelTour = new Tour();
    }

    // ==========================
    // 1. DANH SÁCH TOUR
    // ==========================
    public function getListTour()
    {
        if (!isLoggedIn()) {
            header("Location: " . BASE_URL . "welcome");
            exit;
        }

        $tours = $this->modelTour->getAllTours();
        require_once "./views/admin/tour/list_tour.php";
    }

    // ==========================
    // 2. FORM THÊM TOUR
    // ==========================
    public function formAddTour(): void
    {
        if (!isLoggedIn()) {
            header("Location: " . BASE_URL . "welcome");
            exit;
        }

        $policyModel = new ChinhSach();
        $listChinhSach = $policyModel->getAllPolicies();

        require_once "./views/admin/tour/form_add_tour.php";
    }


    // ==========================
    // 3. XỬ LÝ THÊM TOUR
    // ==========================
    public function addTour()
{
    if (!isLoggedIn()) {
        header("Location: " . BASE_URL . "welcome");
        exit;
    }

    $errors = [];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $ten_tour = trim($_POST['ten_tour']);
        $id_danh_muc = $_POST['id_danh_muc'];
        $lich_trinh = trim($_POST['lich_trinh']);
        $gia = $_POST['gia'];
        $nha_cung_cap = trim($_POST['nha_cung_cap']);
        $loai_tour = $_POST['loai_tour'];
        $trang_thai = $_POST['trang_thai'];
        $dia_diem = trim($_POST['dia_diem']);
        $price = $_POST['price'];

        // Lấy mảng chính sách từ form
        $chinh_sach_id = $_POST['chinh_sach_id'] ?? [];
        $chinh_sach_id_str = !empty($chinh_sach_id) ? implode(',', $chinh_sach_id) : '';

        // HANDLE FILE UPLOAD
        $hinh_anh = "";
        if (!empty($_FILES['hinh_anh']['name'])) {
            $targetDir = "uploads/tours/";
            if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);

            $fileName = time() . "_" . basename($_FILES["hinh_anh"]["name"]);
            $targetFile = $targetDir . $fileName;

            if (move_uploaded_file($_FILES["hinh_anh"]["tmp_name"], $targetFile)) {
                $hinh_anh = $fileName;
            } else {
                $errors['hinh_anh'] = "Lỗi upload ảnh.";
            }
        } else {
            $errors['hinh_anh'] = "Vui lòng chọn ảnh.";
        }

        // VALIDATE
        if (empty($ten_tour)) $errors['ten_tour'] = "Tên tour không được để trống.";
        if (empty($gia) || $gia < 0) $errors['gia'] = "Giá tour không hợp lệ.";
        if (empty($dia_diem)) $errors['dia_diem'] = "Địa điểm không được để trống.";
        if (empty($nha_cung_cap)) $errors['nha_cung_cap'] = "Nhà cung cấp không được để trống.";

        if (empty($errors)) {
            // Thêm tour vào DB
            $this->modelTour->addTour(
                $ten_tour,
                $id_danh_muc,
                $lich_trinh,
                $hinh_anh,
                $gia,
                $chinh_sach_id_str,
                $nha_cung_cap,
                $loai_tour,
                $trang_thai,
                $dia_diem,
                $price
            );
            header("Location: ?act=tour");
            exit;
        } else {
            // Giữ dữ liệu cũ để form hiển thị lại
            $old = [
                'ten_tour' => $ten_tour,
                'id_danh_muc' => $id_danh_muc,
                'lich_trinh' => $lich_trinh,
                'gia' => $gia,
                'price' => $price,
                'nha_cung_cap' => $nha_cung_cap,
                'loai_tour' => $loai_tour,
                'trang_thai' => $trang_thai,
                'dia_diem' => $dia_diem,
                'chinh_sach_id' => $chinh_sach_id
            ];

            $policyModel = new ChinhSach();
            $listChinhSach = $policyModel->getAllPolicies();
            $selectedPolicies = $chinh_sach_id;

            require_once "./views/admin/tour/form_add_tour.php";
            exit;
        }
    }

    require_once "./views/admin/tour/form_add_tour.php";
}

    // ==========================
    // 4. XÓA TOUR
    // ==========================
    public function deleteTour()
    {
        if (!isLoggedIn()) {
            header("Location: " . BASE_URL . "welcome");
            exit;
        }

        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->modelTour->deleteTour($id);
        }

        header("Location: ?act=tour");
        exit;
    }

    // ==========================
    // 5. FORM UPDATE TOUR
    // ==========================
    public function formUpdateTour()
    {
        if (!isLoggedIn()) {
            header("Location: " . BASE_URL . "welcome");
            exit;
        }

        if (!isset($_GET['id'])) {
            header("Location: ?act=tour");
            exit;
        }

        $id = $_GET['id'];
        $tour = $this->modelTour->getTourById($id);

        $policyModel = new ChinhSach();
        $listChinhSach = $policyModel->getAllPolicies();

        // Chuẩn bị mảng chọn chính sách
        $selectedPolicies = !empty($tour['chinh_sach_id']) ? array_map('intval', explode(',', $tour['chinh_sach_id'])) : [];

        require_once "./views/admin/tour/form_update_tour.php";
    }

    // ==========================
    // 6. XỬ LÝ UPDATE TOUR
    // ==========================
    public function updateTour()
{
    if (!isLoggedIn()) {
        header("Location: " . BASE_URL . "welcome");
        exit;
    }

    $errors = [];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['id'];
        $ten_tour = trim($_POST['ten_tour']);
        $id_danh_muc = $_POST['id_danh_muc'];
        $lich_trinh = trim($_POST['lich_trinh']);
        $gia = $_POST['gia'];
        $nha_cung_cap = trim($_POST['nha_cung_cap']);
        $loai_tour = $_POST['loai_tour'];
        $trang_thai = $_POST['trang_thai'];
        $dia_diem = trim($_POST['dia_diem']);
        $price = $_POST['price'];

        // Lấy mảng chính sách từ form
        $chinh_sach_id = $_POST['chinh_sach_id'] ?? [];
        if (empty($chinh_sach_id) && !empty($_POST['old_chinh_sach_id'])) {
            $chinh_sach_id = explode(',', $_POST['old_chinh_sach_id']);
        }
        $chinh_sach_id_str = !empty($chinh_sach_id) ? implode(',', $chinh_sach_id) : '';

        // Xử lý ảnh
        $hinh_anh = $_POST['old_image'] ?? '';
        if (!empty($_FILES['hinh_anh']['name'])) {
            $targetDir = "uploads/tours/";
            if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);

            $fileName = time() . "_" . basename($_FILES["hinh_anh"]["name"]);
            $targetFile = $targetDir . $fileName;

            if (move_uploaded_file($_FILES["hinh_anh"]["tmp_name"], $targetFile)) {
                $hinh_anh = $fileName;
            } else {
                $errors['hinh_anh'] = "Lỗi upload ảnh.";
            }
        }

        // VALIDATE
        if (empty($ten_tour)) $errors['ten_tour'] = "Tên tour không được để trống.";
        if (empty($gia) || $gia < 0) $errors['gia'] = "Giá tour không hợp lệ.";
        if (empty($dia_diem)) $errors['dia_diem'] = "Địa điểm không được để trống.";
        if (empty($nha_cung_cap)) $errors['nha_cung_cap'] = "Nhà cung cấp không được để trống.";

        if (empty($errors)) {
            // Cập nhật tour
            $this->modelTour->updateTour(
                $id,
                $ten_tour,
                $id_danh_muc,
                $lich_trinh,
                $hinh_anh,
                $gia,
                $chinh_sach_id_str,
                $nha_cung_cap,
                $loai_tour,
                $trang_thai,
                $dia_diem,
                $price
            );

            header("Location: ?act=tour");
            exit;
        } else {
            // Hiển thị lại form với dữ liệu đã nhập
            $tour = [
                'id' => $id,
                'ten_tour' => $ten_tour,
                'id_danh_muc' => $id_danh_muc,
                'lich_trinh' => $lich_trinh,
                'hinh_anh' => $hinh_anh,
                'gia' => $gia,
                'chinh_sach_id' => implode(',', $chinh_sach_id),
                'nha_cung_cap' => $nha_cung_cap,
                'loai_tour' => $loai_tour,
                'trang_thai' => $trang_thai,
                'dia_diem' => $dia_diem,
                'price' => $price
            ];

            $policyModel = new ChinhSach();
            $listChinhSach = $policyModel->getAllPolicies();
            $selectedPolicies = $chinh_sach_id;

            require_once "./views/admin/tour/form_update_tour.php";
        }
    }
}




    // ==========================
    // 7. CHI TIẾT TOUR
    // ==========================
    public function detailTour()
    {
        if (!isLoggedIn()) {
            header("Location: " . BASE_URL . "welcome");
            exit;
        }

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $tour = $this->modelTour->getTourById($id);

            // Lấy các ID chính sách từ tour (lưu dưới dạng chuỗi "1,2,3")
            $policyIds = !empty($tour['chinh_sach_id']) ? explode(',', $tour['chinh_sach_id']) : [];

            $policyModel = new ChinhSach();
            $policies = $policyModel->getPoliciesByIds($policyIds);

            require_once "./views/admin/tour/detail_tour.php";
        }
    }


}
