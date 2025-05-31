<?php
    if (isset($_POST['tambah'])) {
        include '../../../model/database.php';
        $koneksi = new Koneksi();
        $conn = $koneksi->getConnection();
        if (!$conn) {
            die("<script>alert('Koneksi database gagal: " . mysqli_connect_error() . "')</script>");
        }
        $nama = $_POST['nama'];
        $harga = $_POST['harga'];
        $ukuran = $_POST['ukuran'];
        if (empty($nama) || empty($harga) || empty($ukuran) || empty($_FILES['image']['name'])) {
            echo "<script>alert('Semua field harus diisi!')</script>";
            exit();
        }
        $target_dir = "../img/";  
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0755, true);
        }
        $nama_fileawal = basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($nama_fileawal, PATHINFO_EXTENSION));

        $nama_file_baru = uniqid() . '.' . $imageFileType;
        $target_file = $target_dir . $nama_file_baru;
        $uploadOk = 1;
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if($check === false) {
            echo "<script>alert('File bukan gambar.')</script>";
            $uploadOk = 0;
        }
        if ($_FILES["image"]["size"] > 2000000) {
            echo "<script>alert('Ukuran gambar terlalu besar (max 2MB).')</script>";
            $uploadOk = 0;
        }
        $allowed_types = ["jpg", "png", "jpeg", "gif"];
        if(!in_array($imageFileType, $allowed_types)) {
            echo "<script>alert('Hanya format JPG, JPEG, PNG & GIF yang diizinkan.')</script>";
            $uploadOk = 0;
        }
        if ($uploadOk == 0) {
            echo "<script>alert('Gambar tidak terupload.')</script>";
        } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $image = $nama_file_baru;
                $stmt = $conn->prepare("INSERT INTO produk (nama, harga, ukuran, image) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("sdss", $nama, $harga, $ukuran, $image);
                $result = $stmt->execute();
                
                if($result){
                    echo "<script>alert('Tambah Produk Berhasil')</script>";
                    echo "<script>window.location='../../dashboard.php?module=produk&page=daftar-produk'</script>";
                    exit();
                } else {
                    echo "<script>alert('Gagal menambahkan produk: " . addslashes($stmt->error) . "')</script>";
                }
            } else {
                echo "<script>alert('Terjadi kesalahan saat mengupload gambar.')</script>";
            }
        }
    }
    ?>