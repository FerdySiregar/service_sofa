<?php
include 'koneksi.php';
?>
<div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Tambah pelanggan</h1>
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <form method="POST">
                                <?php
                                if(isset($_POST["submit"])) {
                                    $nama=strtolower($_POST["pelanggan"]);
                                    $no_handphone = strtolower($_POST["no_handphone"]);
                                    $alamat = strtolower($_POST["alamat"]);

                                    $cek = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE LOWER(nama)='$nama'");
                                    $check = mysqli_num_rows($cek);

                                    if($check > 0 ) {
                                        echo "<div class='alert alert-warning'>
                                        Data yang Dimasukkan Sudah Ada, Masukan Data Yang Baru
                                        </div>";

                                    } else {
                                        $query=mysqli_query($koneksi, "INSERT INTO pelanggan(nama, no_handphone, alamat)
                                         VALUES('$nama', '$no_handphone', '$alamat')");

                                        if($query) {
                                            echo "<script>alert('tambah data berhasil');
                                            window.location.href='?page=pelanggan';
                                            </script>";
                                        } else {
                                            echo "<script>
                                            alert('Tambah data gagal');
                                            </script>";
                                        }
                                    }
                                }
                                ?>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="col-md-4">Nama</div>
                                        <div class="col-md-8"><input type="text" name="pelanggan" class="form-control"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="col-md-4">No.HP</div>
                                        <div class="col-md-8"><input type="text" name="no_handphone" class="form-control"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="col-md-4">Alamat</div>
                                        <div class="col-md-8"><input type="text" name="alamat" class="form-control"></div>
                                    </div>
                                </div>
                                <!-- tomcol submi,reset,kembali -->
                                 <div class="d-flex align-item-center justifiy-content-between mt-4 mb-0">
                                    <div class="col-md-4">
                                        <div class="col-md-8">
                                            <button type="submit" class="btn btn-primary" name="submit" value="submit">Simpan</button>
                                            <button type="reset" class="btn btn-secondary">reset</button>
                                            <a href="?page=pelanggan" class="btn btn-danger">Kembali</a>
                                        </div>
                                    </div>
                                 </div>
                            </form>
                        </div>
                    </div>