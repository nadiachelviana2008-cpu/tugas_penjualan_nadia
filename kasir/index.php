<?php
session_start();
include 'header.php';
include '../koneksi.php';

if ($_SESSION['user_status'] != 2) {
    header("location:../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
?>

<div class="container">
    <div class="alert alert-success text-center">
        <h4>
            <b>Selamat Datang Kasir!</b><br>
            Sistem Informasi Penjualan
        </h4>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <h1>
                        <i class="glyphicon glyphicon-shopping-cart"></i>
                        <span class="pull-right">
                            <?php
                            $jual = mysqli_query($koneksi,
                                "SELECT * FROM penjualan WHERE user_id='$user_id'"
                            );
                            echo mysqli_num_rows($jual);
                            ?>
                        </span>
                    </h1>
                    Total Transaksi Saya
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h1>
                        Rp.
                        <?php
                        $total = mysqli_query($koneksi,
                            "SELECT SUM(total_harga) AS total 
                             FROM penjualan 
                             WHERE user_id='$user_id'"
                        );
                        $t = mysqli_fetch_assoc($total);
                        echo number_format($t['total']);
                        ?>
                    </h1>
                    Total Penjualan Saya
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="panel panel-primary">
                <div class="panel-heading text-center">
                    <h3>
                        <i class="glyphicon glyphicon-plus"></i><br>
                        <a href="penjualan.php" style="color:white;">
                            Transaksi Baru
                        </a>
                    </h3>
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Riwayat Penjualan Saya</h4>
        </div>
        <div class="panel-body">

            <table class="table table-bordered table-striped">
                <tr>
                    <th>No</th>
                    <th>ID Jual</th>
                    <th>Tanggal</th>
                    <th>Total</th>
                </tr>

                <?php
                $data = mysqli_query($koneksi,"
                    SELECT * FROM penjualan
                    WHERE user_id='$user_id'
                    ORDER BY id_jual DESC
                    LIMIT 10
                ");

                $no = 1;
                while ($d = mysqli_fetch_assoc($data)) {
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $d['id_jual']; ?></td>
                    <td><?= $d['tgl_jual']; ?></td>
                    <td>Rp.<?= number_format($d['total_harga']); ?></td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</div>
