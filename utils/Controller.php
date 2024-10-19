<?php
require_once 'utils/utility.php';
require_once 'models/TaiKhoan.php';
class Controller {
    protected $folder = null;            

    public function render($view, $data = array()) {
        // Xác định đường dẫn đến file view
        if ($this->folder === null) {
            $view_file = 'views/' . $view . '.php';
        } else {
            $view_file = 'views/' . $this->folder . '/' . $view . '.php';
        }
        

        // Kiểm tra file view có tồn tại không
        if (is_file($view_file)) {
            extract($data); // Truyền dữ liệu đến view
            ob_start(); // Bắt đầu ghi đè đầu ra
            require_once($view_file); // Gọi file view
            $content = ob_get_clean(); // Lấy nội dung và xóa bộ đệm

            if (isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin') {
                require_once('views/layouts/admin.php'); 
            } else {
                require_once('views/layouts/application.php'); // Layout cho người dùng bình thường
            }
            // Kiểm tra quyền người dùng
            
        } else {
            // Nếu không tìm thấy file view, chuyển hướng về trang chính
            header('Location: /');
            exit(); // Dừng thực hiện thêm để tránh lỗi
        }
    }   
}
