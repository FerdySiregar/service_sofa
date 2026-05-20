<?php
include 'koneksi.php';
?>
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Buat pesanan</h1>
    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="POST">
                <?php
                if(isset($_POST["submit"])) {
                    $id_pelanggan = $_POST["id_pelanggan"];
                    $jenis_sofa = $_POST["jenis_sofa"];
                    $jenis_service = $_POST["jenis_service"];
                    $warna = $_POST["warna"];
                    $harga = $_POST["harga"];
                    $dp = $_POST["dp"];
                    $sisa = $harga - $dp;
                    $tanggal = $_POST["tanggal"];
                    $status = $_POST["status"];

                    // Validasi input
                    if(empty($id_pelanggan) || empty($jenis_service) || empty($harga) || empty($tanggal)) { // Cek field yang wajib diisi
                        echo "<div class='alert alert-warning'>Mohon isi semua field yang wajib diisi</div>";
                    } else {
                        $query = mysqli_query($koneksi, "INSERT INTO pesanan(id_pelanggan, jenis_sofa, jenis_service, warna, harga, dp, sisa, tanggal, status) VALUES('$id_pelanggan', '$jenis_sofa', '$jenis_service', '$warna', '$harga', '$dp', '$sisa', '$tanggal', '$status')");
                        if($query) {
                            echo "<script>alert('Pesanan berhasil dibuat');window.location.href='?page=pesanan';</script>";
                        } else {
                            echo "<script>alert('Pesanan gagal dibuat');</script>";
                        }
                    }
                }
                ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Pelanggan <span class="text-danger">*</span></label>
                            <select name="id_pelanggan" class="form-control" required>
                                <option value="">-- Pilih Pelanggan --</option>
                                <?php
                                $query_pelanggan = mysqli_query($koneksi, "SELECT id_pelanggan, nama FROM pelanggan ORDER BY nama ASC");
                                while($data_pelanggan = mysqli_fetch_array($query_pelanggan)) {
                                    echo "<option value='".$data_pelanggan['id_pelanggan']."'>".$data_pelanggan['nama']."</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Jenis Sofa <span class="text-danger">*</span></label>
                            <input type="text" name="jenis_sofa" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Jenis Service <span class="text-danger">*</span></label>
                            <input type="text" name="jenis_service" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Warna</label>
                            <input type="text" name="warna" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Harga <span class="text-danger">*</span></label>
                            <input type="number" name="harga" class="form-control" placeholder="0" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>DP (Down Payment)</label>
                            <input type="number" name="dp" class="form-control" placeholder="0" value="0">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tanggal <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="Menunggu">Menunggu</option>
                                <option value="Proses">Proses</option>
                                <option value="Selesai">Selesai</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- tombol submit, reset, kembali -->
                <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary" name="submit" value="submit">Simpan</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                        <a href="?page=pesanan" class="btn btn-danger">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
