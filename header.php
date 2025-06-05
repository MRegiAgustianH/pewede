<?php
require_once 'model/user.php';
$user = new User();
$userData = $user->getAll();
?>
<header>
    <nav>
        <div class="logo"><a href="tpwd.php"><img src="img/agodalogo.png" alt=""></a></div>
        <div class="nav">
            <ul>
                <li>
                    <a href="tpwd.php">Beranda</a>
                    <a href="about-page.php">About</a>
                    <a href="pria-page.php">Produk Pria</a>
                    <a href="wanita-page.php">Produk Wanita</a>
                    <a href="anak-page.php">Produk Anak</a>
                </li>
            </ul>
        </div>
        <div class="actions">
            <a href="">
                <img src="img/indonesia.png" alt="">
            </a>
            <a href="">Rp</a>
            <?php
            if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 1) {
                echo '<button style="border:none;">
                        <a href="admin/login.php" style="font-weight: 500; font-size:clamp(5px,20px,2rem); color: rgb(44, 119, 231);">Masuk</a>
                    </button>
                    <button>
                        <a href="admin/register.php" style="font-weight: 500; font-size:clamp(5px,20px,2rem); color: rgb(44, 119, 231);">Daftar</a>
                    </button>';
            }
            ?>
            <a href="cart.php">
                <img src="img/cart.png" alt="">
            </a>
            <a href="#" class="menu-toggle">
                <img src="img/menu.png" alt="">
            </a>
        </div>
    </nav>
    <div class="hamburger-menu" id="hamburgerMenu">
        <div class="hamburger-content">
            <?php
            if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 1) {
                echo '<a href="" class="profile-item">
                        <img src="img/profile.png" alt="Profile" style="width: 32px; height: 32px; border-radius: 50%; opacity:0.5;">
                        <span>' . $_SESSION['username'] . '</span>
                      </a>
                      <a href="favorite.php" class="menu-button">
                      Favorite
                      </a>
                      <a href="admin/logout.php" class="menu-button"  style="background-color:#EF233C;">
                      Logout
                      </a>';
            } else {
                echo '<a href="admin/login.php" class="menu-button">Masuk</a>
                      <a href="admin/register.php" class="menu-button">Daftar</a>';
            }
            ?>
        </div>
    </div>
</header>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const menuToggle = document.querySelector('.menu-toggle');
        const hamburgerMenu = document.getElementById('hamburgerMenu');

        menuToggle.addEventListener('click', function(e) {
            e.preventDefault();
            hamburgerMenu.classList.toggle('active');
        });

        document.addEventListener('click', function(e) {
            if (!hamburgerMenu.contains(e.target) && e.target !== menuToggle && !menuToggle.contains(e.target)) {
                hamburgerMenu.classList.remove('active');
            }
        });
    });
</script>