<?php
session_start();
require_once 'koneksi.php';

// Cek apakah pengguna sudah login, jika tidak, redirect ke halaman login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$current_user = $_SESSION['username'];

// Periksa apakah pengguna memiliki izin untuk menghapus gambar ini
$image_id = $_GET['id'];
$sql = "SELECT * FROM images WHERE id = '$image_id' AND username = '$current_user'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) != 1) {
    // Jika pengguna tidak memiliki izin, redirect ke halaman utama
    header("Location: index.php");
    exit();
}

// Hapus gambar dari folder uploads
$row = mysqli_fetch_assoc($result);
$image_name = $row['image_name'];
unlink($image_name);

// Hapus informasi gambar dari database
$delete_sql = "DELETE FROM images WHERE id = '$image_id'";
mysqli_query($conn, $delete_sql);

header("Location: gallery.php");
exit();
?>
