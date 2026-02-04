<?php
    include '../koneksi.php';

    $id = $_POST['id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $nama = $_POST['nama'];
    $status = $_POST['status'];


    mysqli_query($koneksi,"update user set username='$username', password='$password', user_nama='$nama', user_status='$status' where user_id='$id'");

    echo "<script>alert('Data Telah Diubah'); window.location.href='user.php'</script>";
?>