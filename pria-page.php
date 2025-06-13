<?php
include 'model/database.php';
$koneksi = new Koneksi();
$conn = $koneksi->getConnection();
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk Pria</title>
    <link rel="stylesheet" href="style1.css">
</head>
<style>
    .kategori-container {
        width: 100%;
        min-height: 100vh;
        padding: 40px 0; 
        box-sizing: border-box;
    }

    .kategori-title {
        text-align: center;
        font-size: 2.5rem; 
        font-weight: 600; 
        color: #333; 
        margin-bottom: 40px; 
    }
</style>

<body>
    <?php include('header.php') ?>
    <div class="kategori-container">
        <h1 class="kategori-title">Produk Pria</h1>
        <div class="produk-list">
            <?php
            $query = "SELECT * FROM produk WHERE kategori = 'pria'";
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
                echo "<p class='empty-message' style='text-align:center'>Tidak ada produk pria tersedia</p>";
            }
            ?>
        </div>
    </div>
    <?php include('footer.php') ?>
</body>

</html>