<?php
session_start();
require_once 'koneksi.php';

// Cek apakah pengguna sudah login, jika tidak, redirect ke halaman login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$current_user = $_SESSION['username'];

// Periksa apakah pengguna memiliki izin untuk mengedit gambar ini
$image_id = $_GET['id'];
$sql = "SELECT * FROM images WHERE id = '$image_id' AND username = '$current_user'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) != 1) {
    // Jika pengguna tidak memiliki izin, redirect ke halaman utama
    header("Location: index.php");
    exit();
}

// Memperbarui data gambar
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_image_name = $_POST['name_img'];
    $new_caption = $_POST['caption'];
    $new_description = $_POST['description'];
    $new_category = $_POST['category'];

    // Update data gambar
    $update_sql = "UPDATE images SET name_img = '$new_image_name', caption = '$new_caption', description = '$new_description', category = '$new_category' WHERE id = '$image_id' AND username = '$current_user'";
    if (mysqli_query($conn, $update_sql)) {
        // Redirect ke halaman utama setelah berhasil memperbarui gambar
        header("Location: index.php");
        exit();
    } else {
        echo "Terjadi kesalahan saat memperbarui data gambar. Silakan coba lagi.";
    }
}

// Mendapatkan data gambar yang akan diedit
$image_data = mysqli_fetch_assoc($result);
$picture = $image_data['image_name'];
$name_img = $image_data['name_img'];
$caption = $image_data['caption'];
$description = $image_data['description'];
$category = $image_data['category'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Social Media - Edit Gambar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #121717;">
    
    <!-- Form pengeditan gambar -->
    <section>
        <div class="container">
            <h1>Edit Image</h1>
            <div class="row">
                <div class="col-6">
                    <img src="<?php echo $picture; ?>" width="100%" height="500" alt="" style="object-fit: cover;">
                </div>
                <div class="col-6">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label">Nama Gambar</label>
                            <input type="text" class="form-control" name="name_img" value="<?php echo $name_img; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Caption</label>
                            <input class="form-control" type="text" name="caption" value="<?php echo $caption; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Category</label>
                            <select name="category" id="category" class="form-select" required aria-label="Default select example">
                                <option value="all">All</option>
                                <option value="photography">photography</option>
                                <option value="ui">ui</option>
                                <option value="painting">painting</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="description" required><?php echo $description; ?></textarea>
                        </div>
            
                        <div class="d-flex gap-3 align-items-center">
                            <button class="btn btn-dark" type="submit">Simpan Perubahan</button>
                            <a class="btn btn-danger rounded-0" href="index.php">Kembali ke Halaman Utama</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" ></script>
</body>
</html>
