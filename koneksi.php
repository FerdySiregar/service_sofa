<?php
if (session_status() == PHP_SESSION_NONE) { 
    session_start();
}

$host = "localhost";
$user = "root";
$pass = "";
$db   = "service_sofa";

// Membuat koneksi
$koneksi = mysqli_connect($host, $user, $pass, $db);

// Cek koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
echo "Login";
?>