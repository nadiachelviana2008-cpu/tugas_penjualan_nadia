<?php
    include 'header.php';
    include '../koneksi.php';
?>

<div class="container">
    <div class="alert alert-info text-center">
        <h4><b>Selamat Datang!</b> Sistem Informasi Penjualan</h4>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h1>
                        <i class="glyphicon glyphicon-user"></i>
                        <span class="pull-right">
                            <?php
                            $user = mysqli_query($koneksi,"SELECT * FROM user");
                            echo mysqli_num_rows($user);
                            ?>
                        </span>
                    </h1>
                    Jumlah User
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h1>
                        <i class="glyphicon glyphicon-th-large"></i>
                        <span class="pull-right">
                            <?php
                            $barang = mysqli_query($koneksi,"SELECT * FROM barang");
                            echo mysqli_num_rows($barang);
                            ?>
                        </span>
                    </h1>
                    Jumlah Barang
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <h1>
                        <i class="glyphicon glyphicon-shopping-cart"></i>
                        <span class="pull-right">
                            <?php
                            $jual = mysqli_query($koneksi,"SELECT * FROM penjualan");
                            echo mysqli_num_rows($jual);
                            ?>
                        </span>
                    </h1>
                    Total Transaksi
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h1>
                        Rp.
                        <?php
                        $total = mysqli_query($koneksi,"SELECT SUM(total_harga) AS total FROM penjualan");
                        $t = mysqli_fetch_assoc($total);
                        echo number_format($t['total']);
                        ?>
                    </h1>
                    Total Pendapatan
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Riwayat Penjualan Terakhir</h4>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped">
                <tr>
                    <th>No</th>
                    <th>ID Jual</th>
                    <th>Tanggal</th>
                    <th>Kasir</th>
                    <th>Total</th>
                </tr>

                <?php
                    $data = mysqli_query($koneksi,"
                        SELECT penjualan.*, user.user_nama 
                        FROM penjualan 
                        JOIN user ON penjualan.user_id = user.user_id
                        ORDER BY penjualan.id_jual DESC
                        LIMIT 10
                    ");

                    $no = 1;
                    while ($d = mysqli_fetch_assoc($data)) {
                ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $d['id_jual']; ?></td>
                        <td><?= $d['tgl_jual']; ?></td>
                        <td><?= $d['user_nama']; ?></td>
                        <td>Rp.<?= number_format($d['total_harga']); ?></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</div>