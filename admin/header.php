<!DOCTYPE html>
<html>
    <head>
        <title>Sistem Informasi Penjualan</title>
        <link rel="stylesheet" type="text/css" href="../asset/css/bootstrap.css">
        <script type="text/javascript" src="../asset/js/jquery.js"></script>
        <script type="text/javascript" src="../asset/js/bootstrap.js"></script>
    </head>
<body style="background: #f0f0f0";>

    <?php
        session_start();
        if ($_SESSION['status']!="login") {
            header("location:../index.php?pesan=belum_login");
        }
    ?>
    <nav class="navbar navbar-inverse">
        <div class="Countainer-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php">Admin Penjualan</a>
            </div>

            <ul class="nav navbar-nav">
                <li><a href="index.php">Dashboard</a></li>
                <li><a href="barang.php">Barang</a></li>
                <li><a href="user.php">User</a></li>
                <li><a href="penjualan.php">Penjualan</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li class="navbar-text">Hallo, <b><?= $_SESSION['username']; ?></b></li>
                <li><a href="../logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>
</body>
</html>