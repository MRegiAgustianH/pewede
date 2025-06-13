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
    <title>Pesanan</title>
    <link rel="stylesheet" href="style1.css">
    <style>
        .sub-nav {
            text-align: center;
            margin: 20px 0 30px 0;
            border-bottom: 1px solid #eee;
            padding-bottom: 20px;
        }

        .sub-nav a {
            text-decoration: none;
            color: #333;
            padding: 10px 25px;
            margin: 0 5px;
            border-radius: 20px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .sub-nav a:hover {
            background-color: #f0f0f0;
        }

        .sub-nav a.active {
            background-color: #2c77e7;
            color: white;
        }
    </style>
</head>

<body>
    <?php include('header.php') ?>
    <main>
        <h1>PESANAN ANDA</h1>

        <?php
        if (isset($_SESSION['id'])) {
            $status = isset($_GET['status']) && in_array($_GET['status'], ['pending', 'success']) ? $_GET['status'] : 'pending';
        ?>
            <div class="sub-nav">
                <a href="pesanan.php?status=pending" class="<?= ($status == 'pending') ? 'active' : '' ?>">Pending</a>
                <a href="pesanan.php?status=success" class="<?= ($status == 'success') ? 'active' : '' ?>">Success</a>
            </div>

            <div class="produk">
                <div class="produk-container">
                    <div class="produk-list">
                        <?php
                        $user_id = $_SESSION['id'];
                        $query = "SELECT DISTINCT p.* FROM produk p
                                    JOIN order_items oi ON p.id = oi.product_id
                                    JOIN orders o ON oi.order_id = o.order_id
                                    WHERE o.user_id = $user_id AND o.status = '$status'";

                        $result = mysqli_query($conn, $query);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_array($result)) {
                                echo "<a href='detail-produk.php?id=" . $row['id'] . "'>";
                                echo    "<div class='item'>";
                                echo       "<div class='picture'>";
                                echo           "<img src='admin/page/produk/images/" . $row['image'] . "' alt='" . htmlspecialchars($row['nama']) . "'>";
                                echo       "</div>";
                                echo       "<div class='description'>";
                                echo           "<h3>" . htmlspecialchars($row['nama']) . "</h3>";
                                echo           "<p>Rp " . number_format($row['harga'], 0, ',', '.') . "</p>";
                                echo       "</div>";
                                echo    "</div>";
                                echo "</a>";
                            }
                        } else {
                          
                            echo "<p class='notif' style='text-align:center; font-size:25px;'>Anda Tidak Memiliki Pesanan</p>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        <?php
        } else {

            echo "<p class='notif' style='text-align:center; font-size:25px;'>Silakan login untuk melihat riwayat pesanan Anda.</p>";
        }
        ?>
    </main>
    <?php include('footer.php') ?>
    <button class="back-to-top" title="Go to top">↑</button>
    <script src="script.js"></script>

</body>

</html>