<?php
require_once('../../../model/produk.php');
$produkModel = new Produk();
$id = $_GET['id'];
$produk = $produkModel->getById($id);

if (!$produk) {
    die("Produk tidak ditemukan");
}

if (isset($_POST['update'])) {
    $data = [
        'nama' => $_POST['nama'],
        'harga' => $_POST['harga'],
        'ukuran' => $_POST['ukuran'],
        'type' => $_POST['type'],
        'kategori' => $_POST['kategori'],
        'deskripsi' => $_POST['deskripsi'],
        'promo' => $_POST['promo'] 
    ];

    if (!empty($_FILES['image']['name'])) {
        $imageName = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], 'images/' . $imageName);
        $data['image'] = $imageName;
    } else {
        $data['image'] = $produk['image'];
    }

    if ($produkModel->updateProduk($id, $data)) {
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
                <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($produk['nama']) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Harga</label>
                <input type="number" name="harga" class="form-control" value="<?= htmlspecialchars($produk['harga']) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Ukuran</label>
                <input type="text" name="ukuran" class="form-control" value="<?= htmlspecialchars($produk['ukuran']) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Type Produk</label>
                <select name="type" class="form-control" required>
                    <option value="olahraga" <?= ($produk['type'] == 'olahraga') ? 'selected' : '' ?>>Olahraga</option>
                    <option value="brand" <?= ($produk['type'] == 'brand') ? 'selected' : '' ?>>Brand</option>
                    <option value="original" <?= ($produk['type'] == 'original') ? 'selected' : '' ?>>Original</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <select name="kategori" class="form-control" required>
                    <option value="pria" <?= ($produk['kategori'] == 'pria') ? 'selected' : '' ?>>Pria</option>
                    <option value="wanita" <?= ($produk['kategori'] == 'wanita') ? 'selected' : '' ?>>Wanita</option>
                    <option value="anak" <?= ($produk['kategori'] == 'anak') ? 'selected' : '' ?>>Anak</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control" required><?= htmlspecialchars($produk['deskripsi']) ?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Status Promo</label>
                <select name="promo" class="form-control" required>
                    <option value="tidak" <?= ($produk['promo'] == 'tidak') ? 'selected' : '' ?>>Tidak</option>
                    <option value="ya" <?= ($produk['promo'] == 'ya') ? 'selected' : '' ?>>Ya</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Gambar Saat Ini:</label><br>
                <img src="images/<?= htmlspecialchars($produk['image']) ?>" width="100" class="mb-2">
                <input type="file" name="image" class="form-control">
                <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar</small>
            </div>

            <button type="submit" name="update" class="btn btn-primary">Update Produk</button>
            <a href="<?= '../../dashboard.php?module=produk&page=daftar-produk' ?>" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>

</html>