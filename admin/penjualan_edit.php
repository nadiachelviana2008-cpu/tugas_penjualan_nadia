<?php
include 'header.php';
include '../koneksi.php';

$id_jual = $_GET['id'];
$tanggal = date('Y-m-d');
$user_id = $_SESSION['user_id'];


if (isset($_POST['update'])) {

    $lama = mysqli_query($koneksi,"
        SELECT id_barang, total_harga 
        FROM penjualan 
        WHERE id_jual='$id_jual'
    ");

    while ($l = mysqli_fetch_assoc($lama)) {
        mysqli_query($koneksi,"
            UPDATE barang 
            SET stok = stok + (
                SELECT SUM(total_harga/harga_jual) 
                FROM penjualan 
                JOIN barang USING(id_barang)
                WHERE id_jual='$id_jual' 
                AND id_barang='{$l['id_barang']}'
            )
            WHERE id_barang='{$l['id_barang']}'
        ");
    }

    mysqli_query($koneksi,"DELETE FROM penjualan WHERE id_jual='$id_jual'");

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

        mysqli_query($koneksi,"
            INSERT INTO penjualan
            (id_barang, tgl_jual, total_harga, user_id)
            VALUES
            ('$id_barang','$tanggal','$subtotal','$user_id')
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
    <div class="panel panel-info">
        <div class="panel-heading">
            <h4>Edit Penjualan - Invoice <?= $id_jual; ?></h4>
        </div>
        <div class="panel-body">
            <form method="post">
                <table class="table table-bordered">
                    <tr>
                        <th>Barang</th>
                        <th>Jumlah Baru</th>
                    </tr>

                    <?php
                    $barang = mysqli_query($koneksi,"SELECT * FROM barang");
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

                <button name="update" class="btn btn-primary">
                    Update Transaksi
                </button>
            </form>
        </div>
    </div>
</div>