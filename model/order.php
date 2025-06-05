<?php
require_once 'database.php';
class Order extends koneksi
{
    private $conn;

    public function __construct()
    {
        parent::__construct();
        $this->conn = $this->getConnection();
    }

    public function getAll()
    {
        $query = "SELECT o.*, u.username 
          FROM orders o
          JOIN user u ON o.user_id = u.id
          ORDER BY o.order_date DESC";
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
