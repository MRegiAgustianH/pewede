<?php

class Koneksi
{
    private $conn;

    public function __construct()
    {
        $this->conn = null;
    }

    public function getConnection()
    {
        $this->conn = mysqli_connect('localhost', 'root', '', 'db_mita');
        return $this->conn;
    }
}
