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
    <title>Favorite</title>
    <link rel="stylesheet" href="mita.css">
</head>
<body>
    <?php include ('header.php') ?>
    <main>
        <div class="produk">
            <div class="produk-container">
                <div class="produk-list">
                    <?php
                    if(isset($_SESSION['id'])) {
                        $user_id = $_SESSION['id'];
                        
                        $query = "SELECT p.* FROM produk p
                                JOIN fav_produk fp ON p.id = fp.produk_id
                                WHERE fp.user_id = $user_id";
                        $result = mysqli_query($conn, $query);
                        if(mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_array($result)) {
                                echo "<a href='detail-produk.php?id=".$row['id']."'>";  
                                echo    "<div class='item'>";
                                echo       "<div class='picture'>";
                                echo           "<img src='admin/page/produk/images/".$row['image']."' alt='".htmlspecialchars($row['nama'])."'>";
                                echo       "</div>";
                                echo       "<div class='description'>";
                                echo           "<h3>".htmlspecialchars($row['nama'])."</h3>";
                                echo           "<p>Rp ".number_format($row['harga'], 0, ',', '.')."</p>";
                                echo       "</div>";
                                echo    "</div>";
                                echo "</a>";
                            }
                        } else {
                            echo "<p class='text-center'>Belum ada produk favorit</p>";
                        }
                    } else {
                        echo "<p class='text-center'>Silakan login untuk melihat produk favorit</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </main>
</body>
</html>