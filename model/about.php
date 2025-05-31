<?php 
    require_once('database.php');
    class About extends koneksi{
        private $conn;

        public function __construct(){
            parent:: __construct();
            $this->conn = $this->getConnection();
        }

        public function getAll(){
            $query = "SELECT * FROM about ORDER BY id DESC";
            $result = $this->conn->query($query);

        $data = array();
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $data[] = $row;
            }
        }
        return $data;
        
    }
    public function getById($id) {
        $id = $this->conn->real_escape_string($id);
        $query = "SELECT * FROM about WHERE id = '$id'";
        $result = $this->conn->query($query);
        
        if($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }
    public function updateAbout($id, $deskripsi) {
        $id = $this->conn->real_escape_string($id);
        $deskripsi = $this->conn->real_escape_string($deskripsi);
        
        $query = "UPDATE about SET deskripsi = '$deskripsi' WHERE id = '$id'";
        
        if($this->conn->query($query)) {
            return true;
        } else {
            return false;
        }
    }
}