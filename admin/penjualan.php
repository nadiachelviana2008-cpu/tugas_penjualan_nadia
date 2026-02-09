<?php
    include 'header.php';
    include '../koneksi.php';

    $tanggal = date('Y-m-d');
    $user_id = $_SESSION['user_id'];

    if (isset($_POST['simpan'])) {
        $q = mysqli_query($koneksi,"SELECT MAX(id_jual) AS last FROM penjualan");
        $d = mysqli_fetch_assoc($q);
        $id_jual = $d['last'] + 1;

        $total_transaksi = 0;

        for ($i = 0; $i < count($_POST['id_barang']); $i++) {

            $id_barang = $_POST['id_barang'][$i];
            $jumlah    = $_POST['jumlah'][$i];

            if ($jumlah <= 0) continue;

            $b = mysqli_fetch_assoc(mysqli_query($koneksi,"
                SELECT harga_jual, stok 
                FROM barang 
                WHERE id_barang='$id_barang'
            "));

            if ($jumlah > $b['stok']) continue;

            $subtotal = $jumlah * $b['harga_jual'];
            $total_transaksi += $subtotal;

            mysqli_query($koneksi,"
                INSERT INTO penjualan
                (id_jual, id_barang, tgl_jual, total_harga, user_id)
                VALUES
                ('$id_jual','$id_barang','$tanggal','$subtotal','$user_id')
            ");

            mysqli_query($koneksi,"
                UPDATE barang 
                SET stok = stok - $jumlah
                WHERE id_barang='$id_barang'
            ");
        }
        header("location:index.php");
    }
?>

<div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4>Form Penjualan</h4>
        </div>
        <div class="panel-body">
            <form method="post">
                <table class="table table-bordered">
                    <tr>
                        <th>Barang</th>
                        <th>Jumlah</th>
                    </tr>

                    <?php
                    $barang = mysqli_query($koneksi,"SELECT * FROM barang WHERE stok > 0");
                    while ($b = mysqli_fetch_assoc($barang)) {
                    ?>
                    <tr>
                        <td>
                            <input type="hidden" name="id_barang[]" value="<?= $b['id_barang']; ?>">
                            <?= $b['nama_barang']; ?> (Stok: <?= $b['stok']; ?>)
                        </td>
                        <td>
                            <input type="number" name="jumlah[]" class="form-control" min="0" value="0">
                        </td>
                    </tr>
                    <?php } ?>
                </table>

                <button name="simpan" class="btn btn-success">
                    <i class="glyphicon glyphicon-shopping-cart"></i>
                    Simpan Transaksi
                </button>
            </form>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Data Penjualan</h4>
        </div>
        <div class="panel-body">

            <table class="table table-bordered table-striped">
                <tr>
                    <th>No</th>
                    <th>Invoice</th>
                    <th>Tanggal</th>
                    <th>Kasir</th>
                    <th>Total Haga</th>
                    <th>Aksi</th>
                </tr>

                <?php
                    $no = 1;
                    $data = mysqli_query($koneksi,"SELECT penjualan.*, user.user_nama 
                    FROM penjualan 
                    JOIN user ON penjualan.user_id = user.user_id");
                
                    while ($d = mysqli_fetch_assoc($data)) {
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $d['id_jual']; ?></td>
                    <td><?= $d['tgl_jual']; ?></td>
                    <td><?= $d['user_nama']; ?></td>
                    
                    <td>Rp. <?= number_format($d['total_harga']); ?></td>
                
                    <td>
                        <a href="penjualan_invoice.php?id=<?= $d['id_jual']; ?>" target="_blank" class="btn btn-sm btn-warning">Invoice</a>
                        <a href="penjualan_edit.php?id=<?= $d['id_jual']; ?>" class="btn btn-sm btn-info">Edit</a>
                        <a href="penjualan_batal.php?id=<?= $d['id_jual']; ?>" class="btn btn-sm btn-danger">Batalkan</a>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</div>
