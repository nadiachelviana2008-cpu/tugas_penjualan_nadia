<?php
include 'header.php';
include '../koneksi.php';
?>

<div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4>Laporan Penjualan</h4>
        </div>
        <div class="panel-body">

            <form method="get">
                <div class="row">
                    <div class="col-md-4">
                        <label>Dari Tanggal</label>
                        <input type="date" name="dari" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label>Sampai Tanggal</label>
                        <input type="date" name="sampai" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <br>
                        <button class="btn btn-success">Tampilkan</button>
                    </div>
                </div>
            </form>

            <hr>

            <?php if (isset($_GET['dari'])) { 
                $dari   = $_GET['dari'];
                $sampai = $_GET['sampai'];
            ?>

            <a href="laporan_penjualan_cetak.php?dari=<?= $dari; ?>&sampai=<?= $sampai; ?>" 
               target="_blank" class="btn btn-primary pull-right">
               Cetak Laporan
            </a>

            <br><br>

            <table class="table table-bordered table-striped">
                <tr>
                    <th>No</th>
                    <th>Invoice</th>
                    <th>Tanggal</th>
                    <th>Kasir</th>
                    <th>Total Transaksi</th>
                </tr>

                <?php
                $no = 1;
                $data = mysqli_query($koneksi,"
                    SELECT p.id_jual, p.tgl_jual, u.user_nama,
                    SUM(p.total_harga) AS total
                    FROM penjualan p
                    JOIN user u ON p.user_id = u.user_id
                    WHERE p.tgl_jual BETWEEN '$dari' AND '$sampai'
                    GROUP BY p.id_jual
                ");

                while ($d = mysqli_fetch_assoc($data)) {
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td>INVOICE-<?= $d['id_jual']; ?></td>
                    <td><?= $d['tgl_jual']; ?></td>
                    <td><?= $d['user_nama']; ?></td>
                    <td>Rp. <?= number_format($d['total']); ?></td>
                </tr>
                <?php } ?>
            </table>

            <?php } ?>

        </div>
    </div>
</div>