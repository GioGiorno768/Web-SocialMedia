<?php
$host = "localhost"; // Host database
$user = "root"; // Username database
$password = ""; // Password database
$database = "loginregis"; // Nama database

// Membuat koneksi ke database
$conn = mysqli_connect($host, $user, $password, $database);

// Memeriksa koneksi
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>
