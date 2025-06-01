<?php
session_start();
include('model/database.php');
$koneksi = new Koneksi();
$conn = $koneksi->getConnection();
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$query = "SELECT * FROM produk WHERE id = $id";
$result = mysqli_query($conn, $query);
$produk = mysqli_fetch_assoc($result);

if (!$produk) {
    die("Produk tidak ditemukan");
}

$is_favorite = false;
if(isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
    $product_id = $produk['id'];
    $check = $conn->query("SELECT * FROM fav_produk WHERE user_id = $user_id AND produk_id = $product_id");
    $is_favorite = $check->num_rows > 0;
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Detail Produk - <?php echo htmlspecialchars($produk['nama']); ?></title>
    <link rel="stylesheet" href="mita.css">
</head>
<style>
    .favorite-btn.active img {
        filter: invert(25%) sepia(99%) saturate(7458%) hue-rotate(358deg) brightness(103%) contrast(118%);
    }
</style>
<body>
    <?php include('header.php')?>
    <div class="produk-detail">
        <div class="produk-image">
            <img src="admin/page/produk/images/<?php echo $produk['image']; ?>" alt="<?php echo htmlspecialchars($produk['nama']); ?>">
        </div>
        <div class="produk-info">
            <h1><?php echo htmlspecialchars($produk['nama']); ?></h1>
            <hr style="width:100%;text-align:left;margin-left:0">
            <p class="harga">Rp <?php echo number_format($produk['harga'], 0, ',', '.'); ?></p>
            <p><?= $produk['deskripsi']?></p>
            <button class="cart-btn">Tambahkan Keranjang</button>
            <button class="favorite-btn <?php echo $is_favorite ? 'active' : ''; ?>" 
                    onclick="<?php echo $is_favorite ? 'removeFromFavorites' : 'addToFavorites'; ?>(<?php echo $produk['id']; ?>)">
                <img src="img/favorite.png" alt="">
            </button>
        </div>
    </div>
    <hr style="width:100%;text-align:left; margin:0 10px;">
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
                    ?>
                </div>
            </div>
        </div>
    <?php include('footer.php')?>
    <button class="back-to-top" title="Go to top">↑</button>
    <script src="script.js"></script>
</body>
</html>

<script>
function addToFavorites(productId) {
    fetch('admin/page/produk/fav-produk.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'product_id=' + productId
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            alert('Produk berhasil ditambahkan ke favorit!');
            location.reload();
        } else {
            alert('Gagal: ' + data.message);
        }
    });
}

function removeFromFavorites(productId) {
    if(confirm('Yakin ingin menghapus dari favorit?')) {
        fetch('admin/page/produk/hapus-fav-produk.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'product_id=' + productId
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                alert('Produk dihapus dari favorit');
                location.reload(); 
            } else {
                alert('Gagal: ' + data.message);
            }
        });
    }
}
</script>