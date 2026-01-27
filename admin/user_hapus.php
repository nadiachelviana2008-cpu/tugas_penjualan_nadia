<?php
    include '../koneksi.php';

    $id = $_GET['id'];

    mysqli_query($koneksi,"
        DELETE FROM user WHERE user_id='$id'
    ");

    header("location:user.php");
?>