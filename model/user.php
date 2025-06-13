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

    public function tambahUser($data)
    {
        $username = $this->conn->real_escape_string($data['username']);
        $email = $this->conn->real_escape_string($data['email']);
        $password = $this->conn->real_escape_string($data['password']);
        $confirm_password = $this->conn->real_escape_string($data['confirm_password']);
        $role = (int)$data['role'];

        $query = "INSERT INTO user (username, email, password, confirm_password, role) VALUES ('$username', '$email', '$password', '$confirm_password', $role)";
        
        $result = $this->conn->query($query);
        return $result;
    }

    public function update($id, $data)
    {
        $query = "UPDATE user SET username = ?, email = ?";
        $params = [$data['username'], $data['email']];
        $types = "ss";

        if (!empty($data['password'])) {
            $query .= ", password = ?, confirm_password = ?";
            $params[] = $data['password'];
            $params[] = $data['confirm_password'];
            $types .= "ss";
        }

        $query .= " WHERE id = ?";
        $params[] = $id;
        $types .= "i";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param($types, ...$params);

        return $stmt->execute();
    }

    public function hapusUser($id)
    {
        $query = "DELETE FROM user WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}