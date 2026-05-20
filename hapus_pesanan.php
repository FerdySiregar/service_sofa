<?php
include 'koneksi.php';

// Cek apakah id_obat dikirim via GET
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_pesanan = $_GET['id'];

    // Query untuk menghapus obat berdasarkan id_obat
    $query = mysqli_query($koneksi, "DELETE FROM pesanan WHERE id_pesanan = '$id_pesanan'");

    if ($query) {
        // Jika berhasil, redirect dengan pesan sukses
        echo "<script>alert('Hapus data berhasil'); window.location.href='?page=pesanan';</script>";
    } else {
        // Jika gagal, redirect dengan pesan gagal
        echo "<script>alert('Hapus data gagal'); window.location.href='?page=pesanan';</script>";
    }
} else {
    // Jika id tidak ada, redirect kembali
    echo "<script>alert('ID obat tidak ditemukan'); window.location.href='?page=pesanan';</script>";
}
?>