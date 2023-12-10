<?php
session_start();
require_once 'koneksi.php';

// Cek apakah pengguna sudah login, jika tidak, redirect ke halaman login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$current_user = $_SESSION['username'];

// Periksa apakah pengguna telah mengunggah gambar
if (isset($_FILES['image'])) {
    $image = $_FILES['image'];
    $caption = $_POST['caption'];
    // $image_name = $_POST['image_name'];
    $description = $_POST['description'];
    $name_img = $_POST['name_img'];
    $category = $_POST['category'];

    // Proses unggah gambar
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($image['name']);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Periksa apakah file gambar valid
    $check = getimagesize($image['tmp_name']);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File yang diunggah bukan gambar.";
        $uploadOk = 0;
    }

    // Periksa apakah file gambar sudah ada
    // if (file_exists($target_file)) {
    //     echo "Maaf, file gambar sudah ada.";
    //     $uploadOk = 0;
    // }

    // Batasi jenis file gambar yang diizinkan
    $allowedTypes = array('jpg', 'jpeg', 'png');
    if (!in_array($imageFileType, $allowedTypes)) {
        echo "Maaf, hanya file JPG, JPEG, dan PNG yang diizinkan.";
        $uploadOk = 0;
    }

    // Batasi ukuran file gambar
    $maxFileSize = 2000000; // 500KB
    if ($image['size'] > $maxFileSize) {
        echo "Maaf, ukuran file gambar terlalu besar. Maksimum 2mb.";
        $uploadOk = 0;
    }

    // Jika semua validasi berhasil, unggah gambar dan simpan data ke database
    if ($uploadOk == 1) {
        if (move_uploaded_file($image['tmp_name'], $target_file)) {
            // Simpan data gambar ke database
            $sql = "INSERT INTO images (username, image_name, caption, description, name_img, category) VALUES ('$current_user', '$target_file', '$caption', '$description', '$name_img', '$category')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                header("Location: gallery.php");
                exit();
            } else {
                echo "Terjadi kesalahan saat mengunggah gambar.";
            }
        } else {
            echo "Terjadi kesalahan saat mengunggah gambar.";
        }
    }
}
?>
