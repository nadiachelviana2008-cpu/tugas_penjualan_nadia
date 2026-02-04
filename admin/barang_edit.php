<?php
    include 'header.php';
?>
    <div class="container">
        <br><br><br>
        <div class="col-md-5 col-md-offset-3">
            <div class="panel">
                <div class="panel-heading">
                    <h4>Edit Barang</h4>
                </div>
                <div class="panel-body">
                    <?php
                    include '../koneksi.php';
                    $id = $_GET['id'];
                    $data = mysqli_query($koneksi, "select * from barang where id_barang='$id'");
                    while($d=mysqli_fetch_array($data)){
                        ?>

                        <form method="post" action="barang_update.php">
                            <div class="form-group">
                                <input type="hidden" name="id" value="<?php echo $d['id_barang'];?>">
                                
                                <lanel>Nama Barang</label>
                                <input type="text" class="form-control" name="nama_barang" placeholder="Masukkan nama barang .." value="<?php echo $d['nama_barang']; ?>">
                            </div>

                            <div class="form-group">
                                <label>Harga Beli</label>
                                <input type="number" class="form-control" name="harga_beli" placeholder="Masukkan harga beli .." value="<?php echo $d['harga_beli']; ?>">
                            </div>

                            <div class="form-group">
                                <label>Harga Jual</label>
                                <input type="number" class="form-control" name="harga_jual" placeholder="Masukkan harga jual .." value="<?php echo $d['harga_jual']; ?>">
                            </div>
                        
                            <div class="form-group">
                                <label>Stok</label>
                                <input type="text" class="form-control" name="stok" placeholder="Masukkan stok .." value="<?php echo $d['stok']; ?>">
                            </div>
                            <input type="submit" class="btn btn-primary" value="Simpan">
                            <a href="barang.php" class="btn btn-default">Kembali</a>
                        </form>
                        <?php
                            }
                        ?>
                </div>
            </div>
        </div>
    </div>