<h2 class="mt-4 mb-4"><i class="fas fa-layer-group"></i> Produk</h2>

<div class="row">
    <div class="col">
        <div class="mb-2">
            <a href="page/produk/tambah-produk.php" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Tambah Produk</a>
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Ukuran</th>           
                    <th>Gambar</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    require_once('../model/produk.php');
                    $produk = new Produk();
                    $produkData = $produk->getAll();
                    $nomor = 1;

                    foreach($produkData as $row){
                ?>
                    <tr>
                        <td><?= $nomor++; ?></td>
                        <td><?= htmlspecialchars($row['nama']); ?></td>
                        <td>Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
                        <td><?= htmlspecialchars($row['ukuran']); ?></td>
    
                        <td>
                            <?php 
                            $baseUrl = '/tpwdmita/admin/page/img/'; 
                            $imageUrl = $baseUrl . $row['image'];
                            $fullPath = $_SERVER['DOCUMENT_ROOT'] . $imageUrl;
                            
                            if(!empty($row['image']) && file_exists($fullPath)): 
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

<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>







