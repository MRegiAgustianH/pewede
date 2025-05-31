<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
        *,html,body{
            margin: 0;
            padding: 0;
            font-family: "Poppins", sans-serif;
        }
        main{
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        form{
            width: 50%;
            height: 80vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .form-group{
            width: 100%;
            margin: 10px;
        }
        .form-group label{
            font-size: 20px;
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        .form-control {
            width: 100%;
            padding: 8px;
            font-size: 16px;
        }
        .btn {
            padding: 10px 20px;
            background-color: red;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <main>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama">Nama Produk</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="form-group">
                <label for="harga">Harga Produk</label>
                <input type="number" class="form-control" id="harga" name="harga" required>
            </div>
            <div class="form-group">
                <label for="ukuran">Ukuran</label>
                <input type="text" class="form-control" id="ukuran" name="ukuran" required>
            </div>
            <div class="form-group">
                <label for="image">Gambar Produk</label>
                <input type="file" class="form-control" id="image" name="image" required>
            </div>
            <button type="submit" class="btn" name="tambah">Simpan</button>
        </form>
    </main>
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
</body>
</html>