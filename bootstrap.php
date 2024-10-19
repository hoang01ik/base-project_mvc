<?php
require_once 'controllers/TaiKhoanController.php';

require_once 'utils/routers.php';

// Định nghĩa router
$router = new Router();
$router->add('', ['controller' => 'TaiKhoanController', 'action' => 'index']);

$router->add('login', ['controller' => 'TaiKhoanController', 'action' => 'login']);
$router->add('logout', ['controller' => 'TaiKhoanController', 'action' => 'logout']);

// Lấy URL hiện tại từ REQUEST_URI
$url = $_SERVER['REQUEST_URI'];

// Loại bỏ chuỗi truy vấn nếu có (sau dấu ?)
if (strpos($url, '?') !== false) {
    $url = strstr($url, '?', true);
}
// print_r($url);
// Điều hướng đến controller/action
$router->dispatch(trim($url, '/'));