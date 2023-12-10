<?php
session_start();
require_once 'koneksi.php';

// Cek apakah pengguna sudah login, jika tidak, redirect ke halaman login
if (!isset($_SESSION['username'])) {
    header("Location: admin.php");
    exit();
}

$current_user = $_SESSION['username'];

if (isset($_GET['id'])) {
    $image_id = $_GET['id'];

    // Ambil informasi gambar dari database
    $query = "SELECT * FROM images WHERE id = '$image_id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $image_name = $row['image_name'];

        // Hapus gambar dari folder uploads
        unlink($image_name);

        // Hapus informasi gambar dari database
        $delete_sql = "DELETE FROM images WHERE id = '$image_id'";
        mysqli_query($conn, $delete_sql);
    }
}

header("Location: adminpage.php");
exit();
?>
