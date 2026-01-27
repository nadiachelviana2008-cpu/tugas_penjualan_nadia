<!DOCTYPE html>
<html>
<head>
    <title>Sistem Informasi Penjualan</title>
    <link rel="stylesheet" type="text/css" href="asset/css/bootstrap.css">
    <script type="text/javascript" src="asset/js/jquery.js"></script>
    <script type="text/javascript" src="asset/js/bootstrap.js"></script>
</head>

<body style="background:#f0f0f0;">
    <br><br><br>

    <center>
        <h2>SISTEM INFORMASI PENJUALAN<br>NADIA HABIBATUL CHELVIANA</h2>
    </center>

    <br><br><br>

    <div class="container">
        <div class="col-md-4 col-md-offset-4">

            <?php
            if (isset($_GET['pesan'])) {
                if ($_GET['pesan'] == "gagal") {
                    echo "<div class='alert alert-danger'>Login gagal! Username atau password salah!</div>";
                } elseif ($_GET['pesan'] == "logout") {
                    echo "<div class='alert alert-info'>Anda telah berhasil logout!</div>";
                } elseif ($_GET['pesan'] == "belum_login") {
                    echo "<div class='alert alert-warning'>Anda harus login terlebih dahulu!</div>";
                }
            }
            ?>

            <form method="post" action="login.php">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="text-center">Silahkan Login Disini</h4>
                    </div>

                    <div class="panel-body">

                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="text" name="password" class="form-control" required>
                        </div>

                        <input type="submit" value="Log In" class="btn btn-primary btn-block">

                    </div>
                </div>
            </form>

        </div>
    </div>

</body>
</html>