<?php
include 'koneksi.php';

$id = isset($_GET['id']) ? $_GET['id'] : null;
if (!$id) {
    echo "<div class='alert alert-danger'>ID pesanan tidak valid.</div>";
    return;
}

if (isset($_POST['submit'])) {
    $id_pelanggan = mysqli_real_escape_string($koneksi, trim($_POST['id_pelanggan']));
    $jenis_sofa = mysqli_real_escape_string($koneksi, trim($_POST['jenis_sofa']));
    $jenis_service = mysqli_real_escape_string($koneksi, trim($_POST['jenis_service']));
    $warna = mysqli_real_escape_string($koneksi, trim($_POST['warna']));
    $harga = (int) $_POST['harga'];
    $dp = (int) $_POST['dp'];
    $sisa = $harga - $dp;
    $tanggal = mysqli_real_escape_string($koneksi, trim($_POST['tanggal']));
    $status = mysqli_real_escape_string($koneksi, trim($_POST['status']));

    if ($id_pelanggan === '' || $jenis_sofa === '' || $jenis_service === '' || $harga <= 0 || $tanggal === '') {
        echo "<div class='alert alert-warning'>Mohon isi semua field wajib dengan benar.</div>";
    } else {
        $query = mysqli_query($koneksi, "UPDATE pesanan SET id_pelanggan='$id_pelanggan', jenis_sofa='$jenis_sofa', jenis_service='$jenis_service', warna='$warna', harga='$harga', dp='$dp', sisa='$sisa', tanggal='$tanggal', status='$status' WHERE id_pesanan='$id'");
        if ($query) {
            echo "<script>alert('Pesanan berhasil diubah');window.location.href='?page=pesanan';</script>";
            exit;
        } else {
            echo "<div class='alert alert-danger'>Ubah pesanan gagal: " . mysqli_error($koneksi) . "</div>";
        }
    }
}

$query = mysqli_query($koneksi, "SELECT pesanan.*, pelanggan.nama FROM pesanan JOIN pelanggan ON pesanan.id_pelanggan = pelanggan.id_pelanggan WHERE pesanan.id_pesanan='$id'");
$data = mysqli_fetch_array($query);
if (!$data) {
    echo "<div class='alert alert-danger'>Data pesanan tidak ditemukan.</div>";
    return;
}
?>
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Ubah Pesanan</h1>
    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="POST">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Pelanggan <span class="text-danger">*</span></label>
                            <select name="id_pelanggan" class="form-control" required>
                                <option value="">-- Pilih Pelanggan --</option>
                                <?php
                                $query_pelanggan = mysqli_query($koneksi, "SELECT id_pelanggan, nama FROM pelanggan ORDER BY nama ASC");
                                while ($pelanggan = mysqli_fetch_array($query_pelanggan)) {
                                    $selected = ($pelanggan['id_pelanggan'] == $data['id_pelanggan']) ? 'selected' : '';
                                    echo "<option value='" . $pelanggan['id_pelanggan'] . "' $selected>" . htmlspecialchars($pelanggan['nama']) . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Jenis Sofa <span class="text-danger">*</span></label>
                            <input type="text" name="jenis_sofa" class="form-control" value="<?= htmlspecialchars($data['jenis_sofa']); ?>" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Jenis Service <span class="text-danger">*</span></label>
                            <input type="text" name="jenis_service" class="form-control" value="<?= htmlspecialchars($data['jenis_service']); ?>" required>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Warna</label>
                            <input type="text" name="warna" class="form-control" value="<?= htmlspecialchars($data['warna']); ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Harga <span class="text-danger">*</span></label>
                            <input type="number" name="harga" class="form-control" value="<?= htmlspecialchars($data['harga']); ?>" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>DP (Down Payment)</label>
                            <input type="number" name="dp" class="form-control" value="<?= htmlspecialchars($data['dp']); ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tanggal <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal" class="form-control" value="<?= htmlspecialchars($data['tanggal']); ?>" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="Menunggu" <?= $data['status'] == 'Menunggu' ? 'selected' : ''; ?>>Menunggu</option>
                                <option value="Proses" <?= $data['status'] == 'Proses' ? 'selected' : ''; ?>>Proses</option>
                                <option value="Selesai" <?= $data['status'] == 'Selesai' ? 'selected' : ''; ?>>Selesai</option>
                            </select>
                        </div>
                    </div>
                </div>
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