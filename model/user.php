<?php
require_once 'database.php';
class User extends koneksi
{
    private $conn;

    public function __construct()
    {
        parent::__construct();
        $this->conn = $this->getConnection();
    }

    public function getAll()
    {
        $query = "SELECT * FROM user ORDER BY id DESC";
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getById($id)
    {
        $query = "SELECT * FROM user WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function update($id, $data)
    {
        $query = "UPDATE user SET 
                  username = ?, 
                  email = ? 
                  " . (!empty($data['password']) ? ", password = ?" : "") . " 
                  WHERE id = ?";

        $stmt = $this->conn->prepare($query);

        if (!empty($data['password'])) {
            $stmt->bind_param(
                "sssi",
                $data['username'],
                $data['email'],
                $data['password'],
                $id
            );
        } else {
            $stmt->bind_param(
                "ssi",
                $data['username'],
                $data['email'],
                $id
            );
        }

        return $stmt->execute();
    }
}
