<?php
    include '../koneksi.php';

    $id = $_GET['id'];

    mysqli_query($koneksi,"
        DELETE FROM penjualan WHERE id_jual='$id'
    ");

    header("location:penjualan.php");
?>