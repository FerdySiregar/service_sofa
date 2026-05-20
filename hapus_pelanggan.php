<?php
include 'koneksi.php';
?>
<?php
// Ambil ID dari URL menggunakan $_GET
$id = $_GET["id"];
// Hapus data dari database berdasarkan ID
$query = mysqli_query($koneksi, "DELETE FROM pelanggan WHERE id_pelanggan='$id'");
if($query) {
    echo "<script>alert('Hapus data berhasil');</script>";
} else {
    echo "<script>alert('Hapus data gagal');</script>";
}
// Redirect kembali ke halaman kategori setelah penghapusan
echo "<script>window.location.href='?page=pelanggan';</script>"; 