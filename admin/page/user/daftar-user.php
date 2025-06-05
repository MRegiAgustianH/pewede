<h2 class="mt-4 mb-4"><i class="fas fa-layer-group"></i> Daftar User</h2>

<div class="row">
    <div class="col">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>email</th>
                    <th>role</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once("../model/user.php");
                $user = new User();
                $userData = $user->getAll();
                $koneksi = new Koneksi();
                $conn = $koneksi->getConnection();
                foreach ($userData as $row) {
                ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= htmlspecialchars($row['username']); ?></td>
                        <td><?= htmlspecialchars($row['email']); ?></td>
                        <td>
                            <?= $row['role'] == 0 ? 'Admin' : 'Customer' ?>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>