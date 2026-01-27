<?php
    include 'header.php';
    include '../koneksi.php';

    if (isset($_POST['simpan'])) {
        mysqli_query($koneksi, "
            INSERT INTO barang 
            (nama_barang, harga_beli, harga_jual, stok)
            VALUES (
                '$_POST[nama_barang]',
                '$_POST[harga_beli]',
                '$_POST[harga_jual]',
                '$_POST[stok]'
            )
        ");
        header("location:barang.php");
    }
?>

<div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4>Tambah Data Barang</h4>
        </div>
        <div class="panel-body">
            <form method="post">
                <div class="form-group">
                    <label>Nama Barang</label>
                    <input type="text" name="nama_barang" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Harga Beli</label>
                    <input type="number" name="harga_beli" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Harga Jual</label>
                    <input type="number" name="harga_jual" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Stok</label>
                    <input type="number" name="stok" class="form-control" required>
                </div>

                <button name="simpan" class="btn btn-primary">
                    <i class="glyphicon glyphicon-save"></i> Simpan
                </button>
            </form>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Data Barang</h4>
        </div>
        <div class="panel-body">

            <table class="table table-bordered table-striped">
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>

                <?php
                    $no = 1;
                    $data = mysqli_query($koneksi,"SELECT * FROM barang");
                    while ($d = mysqli_fetch_assoc($data)) {
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $d['nama_barang']; ?></td>
                        <td>Rp.<?= number_format($d['harga_beli']); ?></td>
                        <td>Rp.<?= number_format($d['harga_jual']); ?></td>
                        <td><?= $d['stok']; ?></td>
                        <td>
                            <a href="barang_hapus.php?id=<?= $d['id_barang']; ?>" 
                            class="btn btn-danger btn-xs"
                            onclick="return confirm('Hapus data?')">
                                Hapus
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</div>
