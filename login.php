<?php
    session_start();
    include 'koneksi.php';
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $data = mysqli_query($koneksi,"select * from user where username='$username' and  password='$password'");

    $cek = mysqli_num_rows($data);

    if ($cek > 0) {
        $d = mysqli_fetch_assoc($data);

        $_SESSION['user_id'] = $d['user_id'];
        $_SESSION['username']   = $d['username'];
        $_SESSION['user_nama']  = $d['user_nama'];
        $_SESSION['user_status'] = $d['user_status'];
        $_SESSION['status'] = "login";

        if ($d['user_status'] == 1) {
            header("Location: admin/index.php");
            exit();
        } 
        else if ($d['user_status'] == 2) {
            header("Location: kasir/index.php");
            exit();
        } 
        else {
            header("Location: index.php?pesan=status_tidak_valid"); 
        }
        exit();

    } else {
        header("Location: index.php?pesan=gagal");
        exit();
    }
?>