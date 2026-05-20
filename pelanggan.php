<?php
include 'koneksi.php';
?>
<div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Pelanggan</h1>
                    <div class="row mb-3">
                        <a href="?page=tambah_pelanggan" class="btn btn-primary">Tambah pelanggan</a>
                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <!-- <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                        </div> -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama</th>
                                            <th>No.HP</th>
                                            <th>Alamat</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        $query = mysqli_query($koneksi, "SELECT * FROM pelanggan");
                                        while ($data = mysqli_fetch_array($query)) :
                                        ?>
                                        <tr>
                                            <td><?=$i++; ?></td>
                                            <td><?=$data['nama']; ?></td>
                                            <td><?=$data['no_handphone']; ?></td>
                                            <td><?=$data['alamat']; ?></td>
                                            <td>
                                                <a href="?page=ubah_pelanggan&&id=<?= $data['id_pelanggan']; ?>" 
                                                    class="btn btn-info">Ubah</a>

                                                <a href="?page=pelanggan_hapus&&id=<?= $data['id_pelanggan']; ?>" 
                                                    data-toggle="modal" data-target="#deleteModal" data-url="?page=hapus_pelanggan&&id=<?= $data['id_pelanggan']; ?>"
                                                    class="btn btn-danger">Hapus</a>

                                            </td>
                                        </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>