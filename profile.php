<?php
session_start();
require_once('model/database.php');
require_once('model/user.php');

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

$koneksi = new Koneksi();
$conn = $koneksi->getConnection();
$userModel = new User();
$currentUser = $userModel->getById($_SESSION['id']);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_profile'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    if (empty($username) || empty($email)) {
        $error = "Username dan email harus diisi";
    } else {
        $data = [
            'username' => $username,
            'email' => $email
        ];

        if (!empty($_POST['new_password'])) {
            if ($_POST['new_password'] === $_POST['confirm_password']) {
                $data['password'] = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
            } else {
                $error = "Password baru tidak cocok";
            }
        }

        if (!isset($error)) {
            if ($userModel->update($_SESSION['id'], $data)) {
                $success = "Profile berhasil diupdate";
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $email;
                $currentUser = $userModel->getById($_SESSION['id']);
            } else {
                $error = "Gagal mengupdate profile";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="mita.css">
    <style>
        .profile-container {
            max-width: 600px;
            margin: 2rem auto;
            padding: 2rem;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .profile-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .profile-picture {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 1rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
        }

        .form-group input {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .btn-update {
            background-color: #4CAF50;
            color: white;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .alert {
            padding: 0.75rem 1.25rem;
            margin-bottom: 1rem;
            border-radius: 4px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }

        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>

<body>
    <?php include('header.php') ?>

    <main>
        <div class="profile-container">
            <div class="profile-header">
                <img src="img/profile.png" alt="Profile Picture" class="profile-picture">
                <h2>Profile User</h2>
            </div>

            <?php if (isset($success)): ?>
                <div class="alert alert-success">
                    <?= $success ?>
                </div>
            <?php endif; ?>

            <?php if (isset($error)): ?>
                <div class="alert alert-error">
                    <?= $error ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username"
                        value="<?= htmlspecialchars($currentUser['username']) ?>" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email"
                        value="<?= htmlspecialchars($currentUser['email']) ?>" required>
                </div>

                <div class="form-group">
                    <label for="new_password">Password Baru (biarin kosong kalau ngga mau diubah)</label>
                    <input type="password" id="new_password" name="new_password">
                </div>

                <div class="form-group">
                    <label for="confirm_password">Konfirmasi Password Baru</label>
                    <input type="password" id="confirm_password" name="confirm_password">
                </div>

                <button type="submit" name="update_profile" class="btn-update">Update Profile</button>
            </form>
        </div>
    </main>

    <?php include('footer.php') ?>
</body>

</html>