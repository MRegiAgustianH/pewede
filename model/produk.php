<?php
require_once('database.php');
class Produk extends koneksi
{
    private $conn;

    public function __construct()
    {
        parent::__construct();
        $this->conn = $this->getConnection();
    }

    public function getAll()
    {
        $query = "SELECT * FROM produk ORDER BY id DESC";
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getById($id)
    {
        $query = "SELECT * FROM produk WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function delete($id)
    {
        $query = "DELETE FROM produk WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function tambahProduk($datas)
    {
        $columns = implode(", ", array_keys($datas));
        $values = "'" . implode("', '", array_values($datas)) . "'";

        $query = "INSERT INTO produk ($columns) VALUES ($values)";

        return $this->conn->query($query);
    }

    public function updateProduk($id, $data)
    {
        $setClause = [];
        foreach ($data as $key => $value) {
            $setClause[] = "$key = '" . $this->conn->real_escape_string($value) . "'";
        }

        $query = "UPDATE produk SET " . implode(", ", $setClause) . " WHERE id = " . (int)$id;
        return $this->conn->query($query);
    }
}
