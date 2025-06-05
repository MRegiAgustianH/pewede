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

$result = $conn->query("DELETE FROM fav_produk WHERE user_id = $user_id AND produk_id = $product_id");

if ($conn->affected_rows > 0) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Produk tidak ditemukan di favorit']);
}
