<?php
require_once("../model/order.php");
$order = new Order();
$koneksi = new Koneksi();
$conn = $koneksi->getConnection();

if (isset($_POST['selesaikan_pesanan'])) {
    $orderIdToComplete = $_POST['order_id_to_complete'];

    $updateQuery = "UPDATE orders SET status = 'success' WHERE order_id = ?";
    $stmt = $conn->prepare($updateQuery);
    if ($stmt) {
        $stmt->bind_param("i", $orderIdToComplete);
        $stmt->execute();
        $stmt->close();
        echo "<script>window.location.href=window.location.href;</script>";
        exit();
    }
}
?>

<h2 class="mt-4 mb-4"><i class="fas fa-layer-group"></i> Daftar Order</h2>

<div class="row">
    <div class="col">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Total</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th class="text-center">Aksi</th> </tr>
            </thead>
            <tbody>
                <?php
                $orderData = $order->getAll();

                foreach ($orderData as $row) {
                    $totalQuery = "SELECT SUM(p.harga * oi.quantity) as total FROM order_items oi JOIN produk p ON oi.product_id = p.id WHERE oi.order_id = " . $row['order_id'];
                    $totalResult = $conn->query($totalQuery);
                    $totalRow = $totalResult->fetch_assoc();
                    $total = $totalRow['total'] ?? 0;
                ?>
                    <tr>
                        <td><?= $row['order_id'] ?></td>
                        <td><?= htmlspecialchars($row['username']); ?></td>
                        <td>Rp <?= number_format($total, '0', ',', '.') ?></td>
                        <td><?= htmlspecialchars($row['order_date']); ?></td>
                        <td><?= htmlspecialchars($row['status']); ?></td>
                        
                        <td class="text-center">
                            <?php if ($row['status'] == 'pending'): ?>
                                <form action="" method="POST" style="display:inline;">
                                    <input type="hidden" name="order_id_to_complete" value="<?= $row['order_id'] ?>">
                                    <button type="submit" name="selesaikan_pesanan" class="btn btn-sm btn-success">
                                        Selesaikan
                                    </button>
                                </form>
                            <?php else: ?>
                                <span class="btn btn-sm btn-success">Selesai</span>
                            <?php endif; ?>
                        </td>

                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>