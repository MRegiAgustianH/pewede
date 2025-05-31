<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    <link rel="stylesheet" href="mita.css">
</head>
<style>
    .main-about {
        width: 100%;
        min-height: 50vh;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-content: start;
        padding-bottom: 30px;
        margin-bottom: 30px;
    }
    main h1 {
        width: 100%;
        height: 50px;
        font-size: 40px;
        font-weight: 400;
        margin-bottom: 20px;
        color: black;
    }
    .about-container {
        width: 70%;
        min-height: 300px;
        background-color:#f9f9f9;
        border-radius: 20px;
        border: 1px solidrgb(196, 194, 194);
        box-shadow: 0px 0px 9px 3px #f9f9f9;
    }
    .about-container h1{
        padding-left: 30px;
        padding-top: 30px;
        font-size: clamp(1rem, 30px, 5rem);
        text-align: start;
    }
    .about-item {
        width: 100%;
        height: 100%;
        padding: 20px;
        box-sizing: border-box;
        font-size: 18px;
        line-height: 1.6;
        color: #333;
    }
    .about-item p {
        font-size: 18px;
        margin: 0;
    }

</style>
<body>
    <?php include 'header.php'; ?>
    <div class="banner"></div>
     <main class="main-about">
        <h1>About Mitaaa</h1>
        <div class="about-container">
            <h1>
                Lihat Dunia Lebih Murah
            </h1>
            <?php
                include 'model/database.php';
                $koneksi = new Koneksi();
                $conn = $koneksi->getConnection();
                $query = "SELECT * FROM about";
                $result = mysqli_query($conn, $query);
                while($row = mysqli_fetch_array($result)) {
                    echo '<div class="about-item">';
                    echo '<p>' . $row['deskripsi'] . '</p>';
                    echo '</div>';
                }
            ?>
        </div>
        
    </main>
    <?php include 'footer.php'; ?>
    <button class="back-to-top" title="Go to top">↑</button>
    <script src="script.js"></script>
</body>
</html>