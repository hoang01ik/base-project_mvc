<?php
class TaiKhoan {

    private $id;
    private $username;
    private $password;
    private $role;
    private $trangthai;
    private $token;

    public function __construct() {
        
    }
    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id = $id;
    }

    public function getUsername(){
        return $this->username;
    }

    public function setUsername($username){
        $this->username = $username;
    }
    public function getPassword(){
        return $this->password;
    }
    public function setPassword($password){
        $this->password = $password;
    }
    public function getRole(){
        return $this->role;
    }
    public function setRole($role){
        $this->role = $role;
    }
    public function getTrangThai(){
        return $this->trangthai;
    }
    public function setTrangThai($trangthai){
        $this->trangthai = $trangthai;
    }
    public function getToken(){
        return $this->token;
    }
    public function setToken($token){
        $this->token = $token;
    }
    public function toArray() {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'password' => $this->password,
            'role' => $this->role,
            'trangthai' => $this->trangthai,
            'token' => $this->token,
        ];
    }
}