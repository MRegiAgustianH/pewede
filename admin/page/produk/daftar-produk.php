<h2 class="mt-4 mb-4"><i class="fas fa-layer-group"></i> Produk</h2>

<div class="row">
    <div class="col">
        <div class="mb-2">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i>
                Tambah Produk
            </button>
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Ukuran</th>
                    <th>Type</th>
                    <th>Kategori</th>
                    <th>Deskripsi</th>
                    <th>Promo</th>
                    <th>Gambar</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once("../model/produk.php");
                $produk = new Produk();
                $produkData = $produk->getAll();
                $nomor = 1;

                foreach ($produkData as $row) {
                ?>
                    <tr>
                        <td><?= $nomor++; ?></td>
                        <td><?= htmlspecialchars($row['nama']); ?></td>
                        <td>Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
                        <td><?= htmlspecialchars($row['ukuran']); ?></td>
                        <td><?= htmlspecialchars($row['type']); ?></td>
                        <td><?= htmlspecialchars($row['kategori']); ?></td>
                        <td><?= htmlspecialchars(substr($row['deskripsi'], 0, 10)) . (strlen($row['deskripsi']) > 10 ? '...' : ''); ?></td>
                        <td><?= htmlspecialchars($row['promo']); ?></td>
                        <td>
                            <?php
                            $baseUrl = '/tpwdmita/admin/page/produk/images/';
                            $imageUrl = $baseUrl . $row['image'];
                            $fullPath = $_SERVER['DOCUMENT_ROOT'] . $imageUrl;

                            if (!empty($row['image']) || file_exists($fullPath)):
                            ?>
                                <img src="<?= $imageUrl ?>"
                                    alt="<?= htmlspecialchars($row['nama']) ?>"
                                    style="max-width: 100px; max-height: 100px;"
                                    onerror="this.onerror=null;this.src='/path/to/default-image.jpg'">
                            <?php else: ?>
                                <div class="text-danger small">
                                    Gambar tidak ditemukan<br>
                                    (<?= htmlspecialchars($row['image']) ?>)
                                </div>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <a href="page/produk/edit-produk.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-warning">
                                <i class="fa fa-edit"></i> Edit
                            </a>
                            <a href="page/produk/hapus-produk.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
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

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">FORM TAMBAH PRODUK</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nama">Nama Produk</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga Produk</label>
                        <input type="number" class="form-control" id="harga" name="harga" required>
                    </div>
                    <div class="form-group">
                        <label for="ukuran">Ukuran</label>
                        <input type="text" class="form-control" id="ukuran" name="ukuran" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="type">Type Produk</label>
                        <select class="form-control" id="type" name="type" required>
                            <option value="" disabled selected>Pilih Tipe Produk</option>
                            <option value="olahraga">Olahraga</option>
                            <option value="brand">Brand</option>
                            <option value="original">Original</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <select class="form-control" id="kategori" name="kategori" required>
                            <option value="" disabled selected>Pilih Kategori</option>
                            <option value="pria">Pria</option>
                            <option value="wanita">Wanita</option>
                            <option value="anak">Anak</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="promo">Status Promo</label>
                        <select class="form-control" id="promo" name="promo" required>
                            <option value="tidak">Tidak</option>
                            <option value="ya">Ya</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="image">Gambar Produk</label>
                        <input type="file" class="form-control" id="image" name="image" style="border:none;" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="tambah">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_POST['tambah'])) {
    $imageName = $_FILES['image']['name'];
    $path = "page/produk/images/" . $imageName;
    move_uploaded_file($_FILES['image']['tmp_name'], $path);

    $datas = [
        'nama' => $_POST['nama'],
        'harga' => $_POST['harga'],
        'ukuran' => $_POST['ukuran'],
        'type' => $_POST['type'],
        'kategori' => $_POST['kategori'],
        'deskripsi' => $_POST['deskripsi'],
        'promo' => $_POST['promo'], 
        'image' => $imageName
    ];

    if ($produk->tambahProduk($datas)) {
        echo "<script>window.location.href='dashboard.php?module=produk&page=daftar-produk';</script>";
    } else {
        echo "<script>window.location.href='dashboard.php?module=produk&page=daftar-produk';</script>";
    }
}
?>