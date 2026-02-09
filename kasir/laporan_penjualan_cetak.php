<?php
include '../koneksi.php';

$dari   = $_GET['dari'];
$sampai = $_GET['sampai'];
?>

<html>
<head>
    <title>Cetak Laporan</title>
    <link rel="stylesheet" href="../asset/css/bootstrap.css">
</head>
<body onload="window.print()">

<div class="container">
    <center>
        <h3>LAPORAN PENJUALAN</h3>
        <p>Tanggal: <?= $dari; ?> s/d <?= $sampai; ?></p>
    </center>

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Invoice</th>
            <th>Tanggal</th>
            <th>Kasir</th>
            <th>Total Transaksi</th>
        </tr>

        <?php
        $no = 1;
        $grand_total = 0;

        $data = mysqli_query($koneksi,"
            SELECT p.id_jual, p.tgl_jual, u.user_nama,
            SUM(p.total_harga) AS total
            FROM penjualan p
            JOIN user u ON p.user_id = u.user_id
            WHERE p.tgl_jual BETWEEN '$dari' AND '$sampai'
            GROUP BY p.id_jual
        ");

        while ($d = mysqli_fetch_assoc($data)) {
            $grand_total += $d['total'];
        ?>
        <tr>
            <td><?= $no++; ?></td>
            <td>INV-<?= $d['id_jual']; ?></td>
            <td><?= $d['tgl_jual']; ?></td>
            <td><?= $d['user_nama']; ?></td>
            <td>Rp. <?= number_format($d['total']); ?></td>
        </tr>
        <?php } ?>

        <tr>
            <th colspan="4" class="text-right">Grand Total</th>
            <th>Rp. <?= number_format($grand_total); ?></th>
        </tr>
    </table>
</div>

</body>
</html>