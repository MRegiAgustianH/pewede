<?php
session_start();
if ($_SESSION['status'] != true) {

    header('Location: login.php');
}
include 'database.php';
if (isset($_SESSION['id']) &&!empty($_SESSION['id'])) {
    $query = "SELECT * FROM user WHERE id = '". $_SESSION['id']. "'";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_object($result);
} else {
    echo "<script>";
    echo "window.location='login.php';";
    echo "</script>";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
    *,html,body {
        margin: 0;
        padding: 0;
        font-family: "Poppins", sans-serif;

    }
    body{
        height: 100vh;
        display:grid;
        grid-template-columns: 300px 1fr;
        grid-template-rows: 60px 1fr;
        grid-template-areas: 
        "side header"
        "side main";
    }
    .header{
        background-color: rgb(224, 221, 221);
        grid-area: header;
    }
    .sidebar{
        background-color: rgb(20, 20, 20);
        grid-area: side;
    }
    .main{
        background-color: rgb(161, 159, 159);
        grid-area: main;
        padding: 25px;
        display: grid;
        grid-template-columns: 1fr ;
        grid-template-rows: 1fr;
    }
    .card{
        background-color: #f9f9f9;
        border-radius: 10px;
        text-align: center;
    }
    .card h2{
        margin: 20px 0;
        font-weight: 600;
    }
    
    .sidebar h2{
        color: white;
        text-align: center;
        padding-top: 20px;
    }
    .sidebar ul{
        list-style: none;
        padding: 0;
    }
    .sidebar ul li{
        margin: 20px 0;
    }
    .sidebar ul li a{
        text-decoration: none;
        color: white;
        padding: 10px 20px;
        display: block;
        transition: background-color 0.3s;
    }
    .sidebar ul li a:hover{
        background-color: rgb(255, 255, 255);
        color: black;
        border-radius: 5px;
    }
    .sidebar ul li a.active{
        background-color: rgb(255, 255, 255);
        color: black;
        border-radius: 5px;
    }
    .sidebar ul li a.active:hover{
        background-color: rgb(255, 255, 255);
        color: black;
    }

</style>
<body>
    <header class="header">

    </header>

    <section class="sidebar">
        <h2>DASHBOARD MITAAA</h2>
        <nav>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="about.php">About </a></li>
                <li><a href="produk.php">Produk</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="aboutshoes4.html">Setting</a></li>
            </ul>
        </nav>

    </section>
    <main class="main">
        <div class="card">
            <h2>PROFILE</h2>
            <p>Selamat Datang, <?php echo $data->username?></p>
        </div>
    </main>
</body>
</html>