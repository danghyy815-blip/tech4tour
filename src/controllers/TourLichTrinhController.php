<?php

class TourLichTrinhController
{
    public $model;
    public $modelTour;

    public function __construct()
    {
        $this->model = new TourLichTrinh();
        $this->modelTour = new Tour();
    }

    public function index()
    {
        $data = $this->model->getAll();
        require_once "./views/admin/tour_lich_trinh/list.php";
    }

    public function formAdd()
    {
        $tours = $this->modelTour->getAllTours();
        require_once "./views/admin/tour_lich_trinh/form_add.php";
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $tour_id = $_POST['tour_id'];
            $tieu_de = $_POST['tieu_de'];
            $noi_dung = $_POST['noi_dung'];
            $ngay_bat_dau = $_POST['ngay_bat_dau'];
            $ngay_ket_thuc = $_POST['ngay_ket_thuc'];
            $thu_tu = $_POST['thu_tu'];

            // HANDLE FILE UPLOAD
            $hinh_anh = "";
            $errors = [];

            if (!empty($_FILES['hinh_anh']['name'])) {
                $targetDir = BASE_PATH . "/public/uploads/tour_lich_trinh/";

                // Tạo thư mục nếu chưa có
                if (!is_dir($targetDir)) {
                    mkdir($targetDir, 0777, true);
                }

                // Tạo tên file unique
                $fileExtension = pathinfo($_FILES["hinh_anh"]["name"], PATHINFO_EXTENSION);
                $fileName = time() . "_" . uniqid() . "." . $fileExtension;
                $targetFile = $targetDir . $fileName;

                // Kiểm tra loại file
                $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                if (!in_array(strtolower($fileExtension), $allowedTypes)) {
                    $errors['hinh_anh'] = "Chỉ chấp nhận file ảnh (jpg, jpeg, png, gif, webp)";
                }
                // Kiểm tra kích thước file (max 5MB)
                elseif ($_FILES["hinh_anh"]["size"] > 5242880) {
                    $errors['hinh_anh'] = "File ảnh quá lớn (max 5MB)";
                }
                // Upload file
                elseif (move_uploaded_file($_FILES["hinh_anh"]["tmp_name"], $targetFile)) {
                    $hinh_anh = $fileName;
                } else {
                    $errors['hinh_anh'] = "Lỗi upload ảnh. Kiểm tra quyền thư mục.";
                }
            } else {
                $errors['hinh_anh'] = "Vui lòng chọn ảnh.";
            }

            // Chỉ lưu vào DB nếu không có lỗi
            if (empty($errors)) {
                $this->model->add($tour_id, $tieu_de, $noi_dung, $ngay_bat_dau, $ngay_ket_thuc, $hinh_anh, $thu_tu);
                header("Location: tour-lich-trinh");
                exit;
            } else {
                // Quay lại form với lỗi
                $tours = $this->modelTour->getAllTours();
                require_once "./views/admin/tour_lich_trinh/form_add.php";
            }
        }
    }

    public function formUpdate()
    {
        $id = $_GET['id'];
        $item = $this->model->getById($id);
        $tours = $this->modelTour->getAllTours();

        require_once "./views/admin/tour_lich_trinh/form_update.php";
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id = $_POST['id'];
            $tour_id = $_POST['tour_id'];
            $tieu_de = $_POST['tieu_de'];
            $noi_dung = $_POST['noi_dung'];
            $ngay_bat_dau = $_POST['ngay_bat_dau'];
            $ngay_ket_thuc = $_POST['ngay_ket_thuc'];
            $thu_tu = $_POST['thu_tu'];

            // Giữ ảnh cũ
            $hinh_anh = $_POST['hinh_anh_old'] ?? null;

            /* ---- Xử lý upload ảnh mới ---- */
            if (!empty($_FILES['hinh_anh']['name'])) {
                $file = $_FILES['hinh_anh'];

                $targetDir = BASE_PATH . "/public/uploads/tour_lich_trinh/";

                if (!is_dir($targetDir)) {
                    mkdir($targetDir, 0777, true);
                }

                $fileName = time() . "_" . preg_replace('/\s+/', '_', basename($file['name']));
                $targetFile = $targetDir . $fileName;

                if (move_uploaded_file($file['tmp_name'], $targetFile)) {

                    // Xóa ảnh cũ nếu có
                    if (!empty($hinh_anh) && file_exists($targetDir . $hinh_anh)) {
                        unlink($targetDir . $hinh_anh);
                    }

                    $hinh_anh = $fileName;
                }
            }

            $this->model->update($id, $tour_id, $tieu_de, $noi_dung, $ngay_bat_dau, $ngay_ket_thuc, $hinh_anh, $thu_tu);
        }

        header("Location: tour-lich-trinh");
        exit;
    }

    public function delete()
    {
        $id = $_GET['id'];

        // Lấy ảnh cũ để xóa
        $item = $this->model->getById($id);
        $oldImage = $item['hinh_anh'] ?? null;

        // Xóa DB
        $this->model->delete($id);

        // Xóa file ảnh
        if ($oldImage) {
            $path = BASE_PATH . "/public/uploads/tour_lich_trinh/" . $oldImage;
            if (file_exists($path))
                unlink($path);
        }

        header("Location: tour-lich-trinh");
        exit;
    }
}