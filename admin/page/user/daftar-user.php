<?php
require_once("../model/user.php");
$userModel = new User();


if (isset($_POST['tambah_user'])) {
    if ($_POST['password'] !== $_POST['confirm_password']) {
        echo "<script>alert('Password dan Konfirmasi Password tidak cocok!'); window.history.back();</script>";
        exit();
    }

    $datas = [
        'username' => $_POST['username'],
        'email' => $_POST['email'],
        'password' => $_POST['password'],
        'confirm_password' => $_POST['confirm_password'],
        'role' => $_POST['role']
    ];
    
    if ($userModel->tambahUser($datas)) {
        echo "<script>window.location.href=window.location.pathname;</script>";
        exit();
    }
}

if (isset($_POST['update_user'])) {
    $id = $_POST['id'];
  
    $data = [
        'username' => $_POST['username'],
        'email' => $_POST['email'],
    ];

    if (!empty($_POST['password'])) {
        $data['password'] = $_POST['password'];
        $data['confirm_password'] = $_POST['password']; 
    }

    if ($userModel->update($id, $data)) {
        echo "<script>window.location.href=window.location.pathname;</script>";
        exit();
    }
}

if (isset($_GET['hapus_id'])) {
    $id = $_GET['hapus_id'];
    if ($userModel->hapusUser($id)) {
        echo "<script>window.location.href='dashboard.php?module=user&page=daftar-user';</script>";
        exit();
    }
}
?>

<h2 class="mt-4 mb-4"><i class="fas fa-users"></i> Daftar User</h2>

<div class="row">
    <div class="col">
        <div class="mb-2">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahUserModal">
                <i class="fa fa-plus"></i> Tambah User
            </button>
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $userData = $userModel->getAll();
                foreach ($userData as $row) {
                ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= htmlspecialchars($row['username']); ?></td>
                        <td><?= htmlspecialchars($row['email']); ?></td>
                        <td>
                            <span class="badge bg-<?= $row['role'] == 0 ? 'info' : 'secondary' ?>">
                                <?= $row['role'] == 0 ? 'Admin' : 'Customer' ?>
                            </span>
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-sm btn-warning edit-btn" data-toggle="modal" data-target="#editUserModal" 
                                data-id="<?= $row['id'] ?>" 
                                data-username="<?= htmlspecialchars($row['username']) ?>" 
                                data-email="<?= htmlspecialchars($row['email']) ?>" 
                                data-role="<?= $row['role'] ?>">
                                <i class="fa fa-edit"></i> Edit
                            </button>
                            <a href="?module=user&page=daftar-user&hapus_id=<?= $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus user ini?')">
                                <i class="fa fa-trash"></i> Hapus
                            </a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="tambahUserModal" tabindex="-1" role="dialog" aria-labelledby="tambahUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahUserModalLabel">FORM TAMBAH USER</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Konfirmasi Password</label>
                        <input type="password" class="form-control" name="confirm_password" required>
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select class="form-control" name="role" required>
                            <option value="1">Customer</option>
                            <option value="0">Admin</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" name="tambah_user">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">FORM EDIT USER</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <input type="hidden" name="id" id="editUserId">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" id="editUsername" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="editEmail" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="editPassword">
                        <small class="text-muted">Biarkan kosong jika tidak ingin mengubah password.</small>
                    </div>
                    <button type="submit" class="btn btn-primary" name="update_user">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const editButtons = document.querySelectorAll('.edit-btn');
    editButtons.forEach(button => {
        button.addEventListener('click', function () {
            const userId = this.getAttribute('data-id');
            const username = this.getAttribute('data-username');
            const email = this.getAttribute('data-email');

            document.getElementById('editUserId').value = userId;
            document.getElementById('editUsername').value = username;
            document.getElementById('editEmail').value = email;
        });
    });
});
</script>



