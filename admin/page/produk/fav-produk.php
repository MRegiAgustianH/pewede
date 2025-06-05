<?php
session_start();
require_once('../../../model/database.php');
if (!isset($_SESSION['id'])) {
    echo json_encode(['success' => false, 'message' => 'Silakan login terlebih dahulu']);
    exit;
}
$product_id = $_POST['product_id'] ?? 0;
$user_id = $_SESSION['id'];

if ($product_id <= 0) {
    echo json_encode(['success' => false, 'message' => 'Produk tidak valid']);
    exit;
}

$koneksi = new Koneksi();
$conn = $koneksi->getConnection();

$check = $conn->query("SELECT * FROM fav_produk WHERE user_id = $user_id AND produk_id = $product_id");
if ($check->num_rows > 0) {
    echo json_encode(['success' => false, 'message' => 'Produk sudah ada di favorit']);
    exit;
}

$result = $conn->query("INSERT INTO fav_produk (user_id, produk_id) VALUES ($user_id, $product_id)");

if ($result) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Gagal menyimpan ke database']);
}
