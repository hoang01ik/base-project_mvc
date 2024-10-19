<?php
require_once 'config/config.php';

class Model {
    private $conn;
    public function __construct() {
        $this->conn = new mysqli(HOST, USERNAME, PASSWORD, DATABASE);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
        error_log("Kết nối thành công!");
        $this->conn->set_charset("utf8");
    }
    // public function __destruct() {
    //     $this->conn->close();
    // }
    public function query($sql)
    {
        return $this->conn->query($sql);
    }
    public function fetchAll($sql)
    {
        $result = $this->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function fetchOne($sql)
    {
        $result = $this->query($sql);
        return $result->fetch_assoc();
    }
    public function getAll($table)
    {
        $sql = "SELECT * FROM $table";
        return $this->fetchAll($sql);
    }
    public function getOne($table, $id)
    {
        $sql = "SELECT * FROM $table WHERE id = $id";
        return $this->fetchOne($sql);
    }
    public function create($table, $data)
    {
        $keys = implode(",", array_keys($data));
        $values = implode(",", array_map(function ($value) {
            return "'" . $this->conn->real_escape_string($value) . "'";
        }, array_values($data)));
        $sql = "INSERT INTO $table ($keys) VALUES ($values)";
        return $this->query($sql);
    }
    public function insert($table, $data)
    {
        $keys = implode(",", array_keys($data));
        $values = implode(",", array_map(function ($value) {
            return "'" . $this->conn->real_escape_string($value) . "'";
        }, array_values($data)));
        $sql = "INSERT INTO $table ($keys) VALUES ($values)";
        return $this->query($sql);
    }
    public function update($table, $data, $id)
    {
        $set = implode(",", array_map(function ($key, $value) {
            return "$key = '$value'";
        }, array_keys($data), array_values($data)));
        $sql = "UPDATE $table SET $set WHERE id = $id";
        return $this->query($sql);
    }
    public function delete($table, $id)
    {
        $sql = "DELETE FROM $table WHERE id = $id";
        return $this->query($sql);
    }
    public function getLastId()
    {
        return $this->conn->insert_id;
    }
    public function getError()
    {
        return $this->conn->error;
    }
    public function getAffectedRows()
    {
        return $this->conn->affected_rows;
    }
    public function getNumRows($sql)
    {
        $result = $this->query($sql);
        return $result->num_rows;
    }
    public function getInsertId()
    {
        return $this->conn->insert_id;
    }
}