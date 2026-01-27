<?php
    include 'header.php';
    include '../koneksi.php';

    if (isset($_POST['simpan'])) {
        $username   = $_POST['username'];
        $nama       = $_POST['user_nama'];
        $password   = md5($_POST['password']);
        $level      = $_POST['user_status'];

        mysqli_query($koneksi,"
            INSERT INTO user 
            (username, password, user_nama, user_status)
            VALUES
            ('$username','$password','$nama','$level')
        ");

        header("location:user.php");
    }
?>

<div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4>Tambah Data User</h4>
        </div>
        <div class="panel-body">
            <form method="post">
                <div class="form-group">
                    <label>Nama User</label>
                    <input type="text" name="user_nama" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Level User</label>
                    <select name="user_status" class="form-control" required>
                        <option value="">-- Pilih Level --</option>
                        <option value="1">Admin</option>
                        <option value="2">Kasir</option>
                    </select>
                </div>

                <button name="simpan" class="btn btn-primary">
                    <i class="glyphicon glyphicon-save"></i> Simpan
                </button>
            </form>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Data User</h4>
        </div>
        <div class="panel-body">

            <table class="table table-bordered table-striped">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Level</th>
                    <th>Aksi</th>
                </tr>

                <?php
                    $no = 1;
                    $data = mysqli_query($koneksi,"SELECT * FROM user");

                    while ($d = mysqli_fetch_assoc($data)) {
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $d['user_nama']; ?></td>
                        <td><?= $d['username']; ?></td>
                        <td>
                            <?= $d['user_status']==1 ? 'Admin' : 'Kasir'; ?>
                        </td>
                        <td>
                            <?php if ($d['user_status'] != 1) { ?>
                            <a href="user_hapus.php?id=<?= $d['user_id']; ?>"
                            class="btn btn-danger btn-xs"
                            onclick="return confirm('Hapus user ini?')">
                            Hapus
                            </a>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</div>
