<?php
// Konfigurasi koneksi ke database
$host = "localhost"; 
$username = "root";
$password = ""; 
$database = "mahasiswa_baru";

// Buat koneksi ke database
$koneksi = mysqli_connect($host, $username, $password, $database);

// Periksa koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
