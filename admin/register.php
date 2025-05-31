<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    .container {
        width: 400px;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 50px rgba(250, 150, 228, 0.3);
        background-color: #fff;
    }
    .logo{
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        align-content: center;
    }
    .container img{
        width: 70px;
        height: 70px;
        margin-bottom: 30px;
    }
    .input-group {
        margin-bottom: 25px;
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
        border-radius: 5px;
        background-color: rgb(0, 121, 250);
        color: white;
        cursor: pointer;
    }
    button:hover {
        background-color:rgb(52, 150, 255);
    }
    main {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background: #f79ced;
        background: linear-gradient(134deg, rgba(247, 156, 237, 1) 0%, rgba(237, 237, 237, 1) 100%);
    }
    * {
        margin: 0;
        padding: 0;
        font-family: "Poppins", sans-serif;
    }
</style>
<body>
    <main>
        <div class="container">
            <div class="logo">
                <a href="../tpwd.php"><img src="../img/logoadidas.png" alt=""></a>
            </div>
            <form action="" method="POST">
                <div class="input-group">
                    <input type="text" id="username" name="username" placeholder="Username" required>
                </div>
                <div class="input-group">
                    <input type="email" id="email" name="email" placeholder="Email" required>
                </div>
                <div class="input-group">
                    <input type="password" id="password" name="password" placeholder="Password" required>
                </div>
                <div class="input-group">
                    <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm Password" required>
                </div>
                <button name= "register" type="submit">Register</button>
            </form>
            <p>Already have an account? <a href="login.php">Login disini</a></p>
        </div>
    </main>
    
</body>
</html>

<?php
if (isset($_POST['register'])) {
        include  '../model/database.php';
        $koneksi = new Koneksi();
        $conn = $koneksi->getConnection();
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm-password'];

        if ($password!= $confirm_password) {
            echo "<script>alert('Passsword Tidak Sama !')</script>";
            return;
        }

    $query = "INSERT INTO user (username, email, password, confirm_password) VALUES ('$username','$email', '$password', '$confirm_password')";
    $result = mysqli_query($conn, $query);
    if($result){
        echo "<script>alert('Registrasi Berhasil')</script>";
        echo "<script>window.location='login.php'</script>";
    }else{
        echo "<script>alert('Registrasi GAGAL')</script>";
    }

}