<?php
include 'koneksi.php';

$id = isset($_GET['id']) ? $_GET['id'] : null;
if (!$id) {
    echo "<div class='alert alert-danger'>ID pelanggan tidak valid.</div>";
    return;
}

if (isset($_POST['submit'])) {
    $nama = mysqli_real_escape_string($koneksi, trim($_POST['nama']));
    $no_handphone = mysqli_real_escape_string($koneksi, trim($_POST['no_handphone']));
    $alamat = mysqli_real_escape_string($koneksi, trim($_POST['alamat']));

    if ($nama === '' || $no_handphone === '' || $alamat === '') {
        echo "<div class='alert alert-warning'>Mohon isi semua field.</div>";
    } else {
        $query = mysqli_query($koneksi, "UPDATE pelanggan SET nama='$nama', no_handphone='$no_handphone', alamat='$alamat' WHERE id_pelanggan='$id'");
        if ($query) {
            echo "<script>alert('Ubah data berhasil');window.location.href='?page=pelanggan';</script>";
            exit;
        } else {
            echo "<div class='alert alert-danger'>Ubah data gagal: " . mysqli_error($koneksi) . "</div>";
        }
    }
}

$query = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE id_pelanggan='$id'");
$data = mysqli_fetch_array($query);
if (!$data) {
    echo "<div class='alert alert-danger'>Pelanggan tidak ditemukan.</div>";
    return;
}
?>
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Ubah Pelanggan</h1>
    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="POST">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Pelanggan</label>
                            <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($data['nama']); ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>No. HP</label>
                            <input type="text" name="no_handphone" class="form-control" value="<?= htmlspecialchars($data['no_handphone']); ?>" required>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" name="alamat" class="form-control" value="<?= htmlspecialchars($data['alamat']); ?>" required>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                    <div>
                        <button type="submit" class="btn btn-primary" name="submit" value="submit">Simpan</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                        <a href="?page=pelanggan" class="btn btn-danger">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>