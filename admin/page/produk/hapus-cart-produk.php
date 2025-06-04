<?php
session_start();
require_once('../../../model/database.php');

if(!isset($_SESSION['id'])) {
    echo json_encode(['success' => false, 'message' => 'Silakan login terlebih dahulu']);
    exit;
}

$product_id = $_POST['product_id'] ?? 0;
$user_id = $_SESSION['id'];

$koneksi = new Koneksi();
$conn = $koneksi->getConnection();

$result = $conn->query("DELETE FROM cart WHERE user_id = $user_id AND produk_id = $product_id");

echo json_encode(['success' => $conn->affected_rows > 0]);
?>