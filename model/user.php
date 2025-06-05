<?php
require_once 'database.php';
class User extends koneksi{
private $conn;

        public function __construct(){
            parent:: __construct();
            $this->conn = $this->getConnection();
        }

        public function getAll(){
            $query = "SELECT * FROM user ORDER BY id DESC";
            $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
        }

}