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
                </tr>
            </thead>
            <tbody>
                <?php
                require_once("../model/order.php");
                $order = new Order();
                $orderData = $order->getAll();
                $koneksi = new Koneksi();
                $conn = $koneksi->getConnection();
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
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>