<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<style>
    *,
    html,
    body {
        margin: 0;
        padding: 0;
        font-family: "Poppins", sans-serif;
    }

    main {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background: #f79ced;
        /* background: linear-gradient(90deg,rgba(247, 156, 237, 1) 0%, rgba(237, 237, 237, 1) 100%); */
        background-image: url(../img/bg.webp);
    }

    .container {
        width: 300px;
        padding: 20px;
        border-radius: 20px;
        box-shadow: 0 0 50px rgba(250, 150, 228, 0.3);
        background-color: #fff;
    }

    .logo {
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        align-content: center;
        margin-bottom: 30px;
    }

    .container img {
        width: 70px;
        height: 70px;
    }

    .input-group {
        margin-bottom: 25px;
    }

    .input-group label {
        display: block;
        margin-bottom: 5px;
    }

    .input-group input {
        width: 90%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    p {
        text-align: center;
        margin-top: 10px;
    }

    p a {
        color: #007BFF;
        text-decoration: none;
    }

    p a:hover {
        text-decoration: underline;
    }

    button {
        width: 30%;
        padding: 10px;
        border: none;
        border-radius: 10px;
        background-color: rgb(252, 75, 75);
        color: white;
        font-size: 16px;
        cursor: pointer;
        margin-bottom: 20px;
    }
</style>

<body>
    <div class="bg"></div>
    <main>
        <div class="container">
            <div class="logo">
                <a href="../tpwd.php"><img src="../img/logoadidas.png" alt=""></a>
            </div>
            <form action="" method="POST">
                <div class="input-group">
                    <input type="text" id="username" name="username" placeholder="Enter Your Username" required>
                </div>
                <div class="input-group">
                    <input type="password" id="password" name="password" placeholder=" Enter Your Password" required>
                </div>
                <button name="login">Login</button>
            </form>
            <p>Punya akun ngga? <a href="register.php">Daftar disini</a></p>
        </div>
    </main>
</body>

</html>


<?php

if (isset($_POST['login'])) {
    session_start();
    include('../model/database.php');
    $koneksi = new Koneksi();
    $conn = $koneksi->getConnection();

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);
    echo mysqli_num_rows($result);
    if (mysqli_num_rows($result) > 0) {

        $data = mysqli_fetch_object($result);
        $_SESSION['status'] = true;
        $_SESSION['data_global'] = $data;
        $_SESSION['id'] = $data->id;
        $_SESSION['user_role'] = $data->role;
        $_SESSION['username'] = $data->username;
        if ($data->role == 0) {
            header('Location: dashboard.php');
        } else {
            header('Location: ../tpwd.php');
        }
        exit;
    } else {

        echo "<script>alert('Username atau password salah')</script>";
    }
}
?>