<?php
session_start();
include 'model/database.php';
$koneksi = new Koneksi();
$conn = $koneksi->getConnection();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <link rel="stylesheet" href="mita.css">
    <style>
        .checkout-section {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: white;
            padding: 15px;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .checkout-btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .item-checkbox {
            width: 30px;
            height: 30px;
        }

        .item-container {
            display: flex;
            align-items: center;
        }
    </style>
</head>

<body>
    <?php include('header.php') ?>
    <main>
        <h1>KERANJANG ANDA</h1>
        <form id="cartForm">
            <div class="produk">
                <div class="produk-container">
                    <div class="produk-list">
                        <?php
                        if (isset($_SESSION['id'])) {
                            $user_id = $_SESSION['id'];
                            $total = 0;

                            $query = "SELECT p.* FROM produk p
                                JOIN cart fp ON p.id = fp.produk_id
                                WHERE fp.user_id = $user_id";
                            $result = mysqli_query($conn, $query);

                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_array($result)) {
                                    echo "<div class='item-container'>";

                                    echo "<a href='detail-produk.php?id=" . $row['id'] . "'>";
                                    echo    "<div class='item'>";
                                    echo       "<div class='picture'>";
                                    echo           "<img src='admin/page/produk/images/" . $row['image'] . "' alt='" . htmlspecialchars($row['nama']) . "'>";
                                    echo       "</div>";
                                    echo       "<div class='description'>";
                                    echo           "<h3>" . htmlspecialchars($row['nama']) . "</h3>";
                                    echo           "<p>Rp " . number_format($row['harga'], 0, ',', '.') . "</p>";
                                    echo "<input type='checkbox' class='item-checkbox' name='selected_items[]' value='" . $row['id'] . "' data-price='" . $row['harga'] . "' checked>";
                                    echo       "</div>";
                                    echo    "</div>";
                                    echo "</a>";
                                    echo "</div>";

                                    $total += $row['harga'];
                                }
                            } else {
                                echo "<p class='notif' style='text-align:center; font-size:25px;'>Belum ada produk di keranjang</p>";
                            }
                        } else {
                            echo "<p class='notif' style='text-align:center; font-size:25px;'>Silakan login untuk melihat keranjang anda</p>";
                        }
                        ?>
                    </div>
                </div>
            </div>

            <div class="checkout-section">
                <div>
                    <strong>Total: </strong>
                    <span id="totalPrice">Rp <?= number_format($total ?? 0, 0, ',', '.') ?></span>
                </div>
                <button type="button" class="checkout-btn" onclick="checkout()">Checkout</button>
            </div>
        </form>
    </main>
    <?php include('footer.php') ?>
    <button class="back-to-top" title="Go to top">↑</button>

    <script>
        document.querySelectorAll('.item-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', calculateTotal);
        });

        function calculateTotal() {
            let total = 0;
            document.querySelectorAll('.item-checkbox:checked').forEach(checkbox => {
                total += parseFloat(checkbox.dataset.price);
            });
            document.getElementById('totalPrice').textContent = 'Rp ' + total.toLocaleString('id-ID');
        }

        function checkout() {
            const selectedItems = [];
            document.querySelectorAll('.item-checkbox:checked').forEach(checkbox => {
                selectedItems.push(checkbox.value);
            });

            if (selectedItems.length === 0) {
                alert('Pilih minimal 1 produk untuk checkout');
                return;
            }
            fetch('admin/page/produk/proses-checkout.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'items=' + JSON.stringify(selectedItems)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Checkout berhasil!');
                        window.location.reload();
                    } else {
                        alert('Error: ' + data.message);
                    }
                });
        }
    </script>
</body>

</html>