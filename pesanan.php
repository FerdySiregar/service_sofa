<?php
include 'koneksi.php';
?>
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Pesanan</h1>
    <div class="mb-3">
        <a href="?page=buat_pesanan" class="btn btn-primary">Buat Pesanan</a>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama pelanggan</th>
                            <th>No.HP</th>
                            <th>Alamat</th>
                            <th>Jenis Sofa</th>
                            <th>Jenis Service</th>
                            <th>Warna</th>
                            <th>Harga</th>
                            <th>DP</th>
                            <th>Sisa</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $query = mysqli_query($koneksi, "SELECT pesanan.*, pelanggan.nama, pelanggan.no_handphone, pelanggan.alamat FROM pesanan JOIN pelanggan ON pesanan.id_pelanggan = pelanggan.id_pelanggan");
                        while ($data = mysqli_fetch_array($query)) :
                        ?>
                        <tr>
                            <td><?=$i++; ?></td>
                            <td><?=$data['nama']; ?></td>
                            <td><?=$data['no_handphone']; ?></td>
                            <td><?=$data['alamat']; ?></td>
                            <td><?=$data['jenis_sofa']; ?></td>
                            <td><?=$data['jenis_service']; ?></td>
                            <td><?=$data['warna']; ?></td>
                            <td>Rp <?=number_format($data['harga'], 0, ',', '.'); ?></td>
                            <td>Rp <?=number_format($data['dp'], 0, ',', '.'); ?></td>
                            <td>Rp <?=number_format($data['sisa'], 0, ',', '.'); ?></td>
                            <td><?=$data['tanggal']; ?></td>
                            <td><?=$data['status']; ?></td>

                            <td>
                                <!-- <a href="cetak_pdf.php?id=<?= $data['id_pesanan']; ?>" target="_blank" class="btn btn-sm btn-success">Cetak</a> -->

                                <a href="?page=ubah_pesanan&id=<?= $data['id_pesanan']; ?>" 
                                    class="btn btn-sm btn-info">Ubah</a>

                                <a href="?page=hapus_pesanan&id=<?= $data['id_pesanan']; ?>" 
                                    data-toggle="modal" data-target="#deleteModal" data-url="?page=hapus_pesanan&id=<?= $data['id_pesanan']; ?>"
                                    class="btn btn-sm btn-danger">Hapus</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>