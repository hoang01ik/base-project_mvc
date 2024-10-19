<?php
namespace App\Controllers;
require_once 'servers/TaiKhoanServer.php';
require_once 'utils/Controller.php';
require_once 'utils/utility.php';
class TaiKhoanController extends \Controller {
    public function __construct(){
        $this->folder = null;
    }
    public function index() {
        $this->render('default/home',['title'=> 'admin page']);
    }
    public function login() {
        if (isset($_SESSION['user'])){
            header('Location: /');
        }else {
            $this->render('login',['title'=> 'Đăng nhập']);
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $TaiKhoanServer = new \TaiKhoanServer();
                $data = [
                    'username' => getPost('username'),
                    'password' => getPost('password')
                ];
                $taiKhoan = $TaiKhoanServer->findOne($data);
                if ($taiKhoan) {
                    $_SESSION['user'] = $taiKhoan->toArray();
                    // print_r($_SESSION['user']);
                    header('Location:  /');
                } else {
                    echo "Tên đăng nhập hoặc mật khẩu không đúng.";
                }
            }
        }
    }
    public function logout() {
        // Xóa tất cả các thông tin trong $_SESSION
        session_unset();
        session_destroy();
        // Chuyển hướng về trang đăng nhập hoặc trang chủ
        header('Location: /login');
        exit(); // Dừng thực hiện các lệnh tiếp theo để tránh lỗi
    }
}