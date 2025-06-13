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
    <title>pwdmita</title>
    <link rel="stylesheet" href="style1.css">
</head>

<body>
    <?php include 'header.php'; ?>
    <div class="banner"></div>
    <div class="promo-banner">
        <div class="promo-banner-container">
            <div class="promo-banner-item"><img src="img/promobanner.png" alt=""></div>
            <div class="promo-banner-item"><img src="img/promobanneroyo.png" alt=""></div>
            <div class="promo-banner-item"><img src="img/promobanner1.png" alt=""></div>
        </div>
    </div>
    </div>
    <main>
        <h1>BEST OF ADIDAS</h1>
        <section>
            <div><a href="#"><img src="img/sandal.jpg" alt=""></a></div>
            <div><a href="#"><img src="img/jaketpink.jpg" alt=""></a></div>
            <div><a href="#"><img src="img/rok.jpg" alt=""></a></div>
            <div><a href="#"><img src="img/sambapink.jpg" alt=""></a></div>
        </section>
        <div class="produk">
            <div class="produk-container">
                <div class="sort">
                    <div class="sort-list">
                        <form action="" method="POST">
                            <select name="" id="">
                                <option value="">HARGA</option>
                                <option value="">100k</option>
                                <option value="">200k</option>
                                <option value="">300k</option>
                                <option value="">400k</option>
                            </select>
                            <select name="" id="">
                                <option value="">UKURAN</option>
                                <option value="">38-40</option>
                                <option value="">41-45</option>
                            </select>
                            <select name="" id="">
                                <option value="">DISKON</option>
                                <option value="">10%</option>
                                <option value="">25%</option>
                                <option value="">50%</option>
                                <option value="">75%</option>
                            </select>
                            <select name="" id="">
                                <option value="">TIPE PRODUK</option>
                                <option value="">Tas</option>
                                <option value="">Sepatu</option>
                                <option value="">Sandal</option>
                                <option value="">Jaket</option>
                            </select>
                            <select name="" id="">
                                <option value="">SPORT/BRAND</option>
                                <option value="">Outdoor</option>
                                <option value="">Original</option>
                                <option value="">Basket</option>
                                <option value="">Running</option>
                            </select>
                        </form>
                    </div>
                    <div class="sort-extend">
                        <form action="" method="POST">
                            <Button>Lebih Banyak Filter</Button>
                            <select name="" id="">
                                <option value="">RECOMMENDED</option>
                                <option value="">Paling Populer</option>
                            </select>
                        </form>
                    </div>
                </div>
                <div class="produk-list">
                    <?php
                    $query = "SELECT * FROM produk";
                    $result = mysqli_query($conn, $query);
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
                    ?>
                </div>
            </div>
        </div>
    </main>
    <?php include 'footer.php'; ?>
    <button class="back-to-top" title="Go to top">↑</button>
    <script src="script.js"></script>
</body>

</html>