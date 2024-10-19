<?php
require_once "models/TaiKhoan.php";
require_once "utils/Model.php";
class TaiKhoanServer extends Model {

    private $AllTaiKhoan = [];
    public function __construct() {
        parent::__construct();
        $taikhoans = $this->getAll('TaiKhoan');
        // print_r($taikhoans);
        foreach ($taikhoans as $tk) {
            $newTaiKhoan = new TaiKhoan();
            $newTaiKhoan->setId($tk['id']);
            $newTaiKhoan->setUsername($tk['username']);
            $newTaiKhoan->setPassword($tk['password']);
            $newTaiKhoan->setRole($tk['role']);
            $newTaiKhoan->setTrangThai($tk['trangthai']);
            $newTaiKhoan->setToken($tk['token']);
            $this->AllTaiKhoan[] = $newTaiKhoan;
        }
    }
    public function getAllTaiKhoan() {
        return $this->AllTaiKhoan;
    }
    public function getTaiKhoanById($id) {
        foreach ($this->AllTaiKhoan as $taiKhoan) {
            if ($taiKhoan->getId() == $id) {
                return $taiKhoan;
            }
        }
        return null;
    }
    public function findOne($data) {
        foreach ($this->AllTaiKhoan as $taiKhoan) {
            $matches = true;
            foreach ($data as $key => $value) {
                $getter = 'get' . ucfirst($key);
                if (method_exists($taiKhoan, $getter)) {
                    if ($taiKhoan->$getter() != $value) {
                        $matches = false;
                        break;
                    }
                } else {
                    $matches = false;
                    break;
                }
            }
            if ($matches) {
                return $taiKhoan;
            }
        }
        return null;
    }
    public function findAll($data) {
        $matchingAccounts = [];
        foreach ($this->AllTaiKhoan as $taiKhoan) {
            $matches = true;
            foreach ($data as $key => $value) {
                $getter = 'get' . ucfirst($key);
                if (method_exists($taiKhoan, $getter)) {
                    if ($taiKhoan->$getter() != $value) {
                        $matches = false;
                        break;
                    }
                } else {
                    $matches = false;
                    break;
                }
            }
            if ($matches) {
                $matchingAccounts[] = $taiKhoan;
            }
        }
        return $matchingAccounts;
    }
}