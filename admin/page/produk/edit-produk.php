<?php
require_once('../../../model/produk.php');
$produkModel = new Produk();
$id = $_GET['id'];
$produk = $produkModel->getById($id);

if(!$produk) {
    die("Produk tidak ditemukan");
}

if(isset($_POST['update'])) {
    $data = [
        'nama' => $_POST['nama'],
        'harga' => $_POST['harga'],
        'ukuran' => $_POST['ukuran']
    ];
    
    if(!empty($_FILES['image']['name'])) {
        $imageName = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], 'images/'.$imageName);
        $data['image'] = $imageName;
    } else {
        $data['image'] = $produk['image'];
    }
    
    if($produkModel->updateProduk($id, $data)) {
        echo "<script>window.location.href='../../dashboard.php?module=produk&page=daftar-produk';</script>";
        exit();
    } else {
        echo "<script>window.location.href='../../dashboard.php?module=produk&page=daftar-produk';</script>";
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Edit Produk</h2>
        
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Nama Produk</label>
                <input type="text" name="nama" class="form-control" value="<?= $produk['nama'] ?>" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Harga</label>
                <input type="number" name="harga" class="form-control" value="<?= $produk['harga'] ?>" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Ukuran</label>
                <input type="text" name="ukuran" class="form-control" value="<?= $produk['ukuran'] ?>" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Gambar Saat Ini:</label><br>
                <img src="images/<?= $produk['image'] ?>" width="100" class="mb-2">
                <input type="file" name="image" class="form-control">
                <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar</small>
            </div>
            
            <button type="submit" name="update" class="btn btn-primary">Update Produk</button>
            <a href="<?='../../dashboard.php?module=produk&page=daftar-produk'?>" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>