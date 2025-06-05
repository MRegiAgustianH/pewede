<?php
session_start();
include '../../../model/database.php';

if (!isset($_SESSION['id'])) {
    echo json_encode(['success' => false, 'message' => 'Silakan login terlebih dahulu']);
    exit;
}

$user_id = $_SESSION['id'];
$items = json_decode($_POST['items']);

if (empty($items)) {
    echo json_encode(['success' => false, 'message' => 'Tidak ada item yang dipilih']);
    exit;
}

$koneksi = new Koneksi();
$conn = $koneksi->getConnection();


$conn->begin_transaction();

try {
    $query = "INSERT INTO orders (user_id, order_date, status) VALUES (?, NOW(), 'pending')";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $order_id = $conn->insert_id;

    foreach ($items as $product_id) {
        $query = "INSERT INTO order_items (order_id, product_id, quantity) VALUES (?, ?, 1)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ii", $order_id, $product_id);
        $stmt->execute();

        $query = "DELETE FROM cart WHERE user_id = ? AND produk_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ii", $user_id, $product_id);
        $stmt->execute();
    }

    $conn->commit();
    echo json_encode(['success' => true]);
} catch (Exception $e) {
    $conn->rollback();
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
