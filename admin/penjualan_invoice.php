<html>
<head>
    <title>Sistem Penjualan</title>
    <link rel="stylesheet" type="text/css" href="../asset/css/bootstrap.css">
</head>
<body>

<?php
session_start();
include '../koneksi.php';

$id = $_GET['id'];

$header = mysqli_fetch_assoc(mysqli_query($koneksi,"
    SELECT p.tgl_jual, u.user_nama
    FROM penjualan p
    JOIN user u ON p.user_id = u.user_id
    WHERE p.id_jual='$id'
    LIMIT 1
"));
?>

<div class="col-md-10 col-md-offset-1">

    <center>
        <h2>TOKO NADIA HABIBATUL CHELVIANA</h2>
    </center>

    <a href="penjualan_invoice_cetak.php?id=<?= $id; ?>" target="_blank" class="btn btn-primary pull-right">
        <i class="glyphicon glyphicon-print"></i> Cetak
    </a>

    <br><br>

    <table class="table">
        <tr>
            <th width="20%">No. Invoice</th>
            <th>:</th>
            <th>INVOICE-<?= $id; ?></th>
        </tr>
        <tr>
            <th>Tanggal</th>
            <th>:</th>
            <th><?= $header['tgl_jual']; ?></th>
        </tr>
        <tr>
            <th>Kasir</th>
            <th>:</th>
            <th><?= $header['user_nama']; ?></th>
        </tr>
    </table>

    <h4 class="text-center">Detail Barang</h4>

    <table class="table table-bordered table-striped">
        <tr>
            <th>Nama Barang</th>
            <th width="15%">Jumlah</th>
            <th width="20%">Harga</th>
            <th width="20%">Subtotal</th>
        </tr>

        <?php
        $total = 0;

        $data = mysqli_query($koneksi,"
            SELECT p.*, b.nama_barang, b.harga_jual
            FROM penjualan p
            JOIN barang b ON p.id_barang = b.id_barang
            WHERE p.id_jual='$id'
        ");

        while ($d = mysqli_fetch_assoc($data)) {

            $jumlah = $d['total_harga'] / $d['harga_jual'];
            $total += $d['total_harga'];
        ?>
        <tr>
            <td><?= $d['nama_barang']; ?></td>
            <td><?= $jumlah; ?></td>
            <td>Rp. <?= number_format($d['harga_jual']); ?></td>
            <td>Rp. <?= number_format($d['total_harga']); ?></td>
        </tr>
        <?php } ?>

        <tr>
            <th colspan="3" class="text-right">Total Bayar</th>
            <th>Rp. <?= number_format($total); ?></th>
        </tr>
    </table>

    <p class="text-center"><i>Terima Kasih Telah Berbelanja di TOKO NADIA</i></p>

</div>
</body>
</html>