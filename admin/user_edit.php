<?php
    include 'header.php';
?>
    <div class="container">
        <br><br><br>
        <div class="col-md-5 col-md-offset-3">
            <div class="panel">
                <div class="panel-heading">
                    <h4>Edit User</h4>
                </div>
                <div class="panel-body">
                    <?php
                    include '../koneksi.php';
                    $id = $_GET['id'];
                    $data = mysqli_query($koneksi, "select * from user where user_id='$id'");
                    while($d=mysqli_fetch_array($data)){
                        ?>

                        <form method="post" action="user_update.php">
                            <div class="form-group">
                                <input type="hidden" name="id" value="<?php echo $d['user_id'];?>">
                                
                                <lanel>Username</label>
                                <input type="text" class="form-control" name="username" placeholder="Masukkan username .." value="<?php echo $d['username']; ?>">
                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <input type="number" class="form-control" name="password" placeholder="Masukkan password .." value="<?php echo $d['password']; ?>">
                            </div>

                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" class="form-control" name="nama" placeholder="Masukkan nama .." value="<?php echo $d['user_nama']; ?>">
                            </div>
                        
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control" required>
                                    <option value="1" <?=  ($d['user_status']==1)?'selected':''; ?>>Admin</option>
                                    <option value="2" <?=  ($d['user_status']==2)?'selected':''; ?>>Kasir</option>
                                </select>
                            </div>
                            <input type="submit" class="btn btn-primary" value="Simpan">
                            <a href="user.php" class="btn btn-default">Kembali</a>
                        </form>
                        <?php
                            }
                        ?>
                </div>
            </div>
        </div>
    </div>