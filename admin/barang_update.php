<?php
    include '../koneksi.php';

    $id = $_POST['id'];
    $nama_barang = $_POST['nama_barang'];
    $harga_beli = $_POST['harga_beli'];
    $harga_jual = $_POST['harga_jual'];
    $stok = $_POST['stok'];


    mysqli_query($koneksi,"update barang set nama_barang='$nama_barang', harga_beli='$harga_beli', harga_jual='$harga_jual', stok='$stok' where id_barang='$id'");

    echo "<script>alert('Data Telah Diubah'); window.location.href='barang.php'</script>";
?>