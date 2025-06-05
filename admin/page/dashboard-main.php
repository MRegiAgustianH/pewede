<?php
require_once('../model/produk.php');
require_once('../model/user.php');
require_once('../model/order.php');

$produk = new Produk();
$produkData = $produk->getAll();
$totalProduk = count($produkData);

$user = new User();
$userData = $user->getAll();
$totalUser = count($userData);

$order = new Order();
$orderData = $order->getALL();
$totalOrder = count($orderData);
?>

<h2 class="mt-4 mb-4"><i class="fas fa-tachometer-alt"></i> Dashboard</h2>
<div class="alert alert-info alert-dismissible fade show" role="alert">
    <strong>Hi,</strong> Selamat Datang Admin
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="row">
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2 bg-primary">
            <div class="card-body ">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-white mb-1">Pengguna</div>
                        <div class="h5 mb-0 font-weight-bold text-white"><?= $totalUser ?></div>
                        <div class="h5 mb-0 font-weight-bold text-white"></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-newspaper fa-4x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2 bg-warning">
            <div class="card-body ">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-white mb-1">Produk</div>
                        <div class="h5 mb-0 font-weight-bold text-white rounded-circle"><?= $totalProduk ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-address-card fa-4x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2 bg-success">
            <div class="card-body ">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-white mb-1">Pesanan</div>
                        <div class="h5 mb-0 font-weight-bold text-white"><?= $totalOrder ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-wrench fa-4x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!--END row-->