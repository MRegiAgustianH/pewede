<?php
session_start();
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    $_SESSION['error'] = "ID produk tidak valid!";
    header("Location: ../../dashboard.php?module=produk&page=daftar-produk");
    exit();
}
require_once('../../../model/database.php');
require_once('../../../model/produk.php');
$koneksi = new Koneksi();
$conn = $koneksi->getConnection();
if (!$conn) {
    $_SESSION['error'] = "Koneksi database gagal: " . mysqli_connect_error();
    header("Location: ../../dashboard.php?module=produk&page=daftar-produk");
    exit();
}
$id = $_GET['id'];
$produkModel = new Produk();
$produk = $produkModel->getById($id);
if (!$produk) {
    $_SESSION['error'] = "Produk tidak ditemukan!";
    header("Location: ../../dashboard.php?module=produk&page=daftar-produk");
    exit();
}
$imagePath = './images/' . $produk['image'];
if (!empty($produk['image']) && file_exists($imagePath)) {
    if (!unlink($imagePath)) {
        $_SESSION['error'] = "Gagal menghapus file gambar!";
        header("Location: ../../dashboard.php?module=produk&page=daftar-produk");
        exit();
    }
}
$result = $produkModel->delete($id);

if ($result) {
    $_SESSION['success'] = "Produk berhasil dihapus!";
} else {
    $_SESSION['error'] = "Gagal menghapus produk: " . $conn->error;
}
header("Location: ../../dashboard.php?module=produk&page=daftar-produk");
exit();
?>