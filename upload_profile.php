<?php
session_start();
require_once 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_SESSION['username'])) {
        $current_user = $_SESSION['username'];

        $query = "SELECT * FROM user WHERE username = '$current_user'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) != 1) {
            header("Location: index.php");
            exit();
        }

        // Ambil data pengguna dari database
        $user = mysqli_fetch_assoc($result);

        // Mengambil nilai dari inputan pengguna
        $new_username = $_POST['username'];
        $new_name = $_POST['name'];
        $new_description = $_POST['description'];

        // Mengubah foto profil
        if (!empty($_FILES['profile-image']['name'])) {
            $target_dir = "profile/";
            $profile_image = $_FILES['profile-image'];
            $profile_image_name = basename($profile_image['name']);
            $target_file = $target_dir . $profile_image_name;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Menghapus foto profil lama jika ada
            if (!empty($user['profile_picture'])) {
                $old_profile_image = $target_dir . $user['profile_picture'];
                if (file_exists($old_profile_image)) {
                    unlink($old_profile_image);
                }
            }

            // Memindahkan foto profil baru ke direktori uploads
            if (move_uploaded_file($profile_image['tmp_name'], $target_file)) {
                // Menyimpan nama file foto profil baru ke dalam database
                $query = "UPDATE user SET profile_image = '$target_file' WHERE username = '$current_user'";
                mysqli_query($conn, $query);
            }
        }

        // Mengubah foto latar belakang
        if (!empty($_FILES['background-picture']['name'])) {
            $target_dir = "profile/";
            $background_image = $_FILES['background-picture'];
            $background_image_name = basename($background_image['name']);
            $target_file = $target_dir . $background_image_name;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Menghapus foto latar belakang lama jika ada
            if (!empty($user['background_picture'])) {
                $old_background_image = $target_dir . $user['background_picture'];
                if (file_exists($old_background_image)) {
                    unlink($old_background_image);
                }
            }

            // Memindahkan foto latar belakang baru ke direktori uploads
            if (move_uploaded_file($background_image['tmp_name'], $target_file)) {
                // Menyimpan nama file foto latar belakang baru ke dalam database
                $query = "UPDATE user SET profile_background = '$target_file' WHERE username = '$current_user'";
                mysqli_query($conn, $query);
            }
        }

        // Mengubah username
        if (!empty($new_username)) {
            // Memeriksa apakah username baru sudah digunakan oleh pengguna lain
            $query = "SELECT * FROM user WHERE username = '$new_username' AND username != '$current_user'";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) == 0) {
                // Mengupdate username pengguna
                $query = "UPDATE user SET username = '$new_username' WHERE username = '$current_user'";
                mysqli_query($conn, $query);
                $_SESSION['username'] = $new_username;
                $current_user = $new_username;
            } else {
                echo "Username sudah digunakan!";
            }
        }

        // Mengubah nama
        if (!empty($new_name)) {
            $query = "UPDATE user SET name = '$new_name' WHERE username = '$current_user'";
            mysqli_query($conn, $query);
        }

        // Mengubah deskripsi
        if (!empty($new_description)) {
            $query = "UPDATE user SET description = '$new_description' WHERE username = '$current_user'";
            mysqli_query($conn, $query);
        }

        header("Location: profile.php");
        exit();
    } else {
        header("Location: index.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<body style="background-color: #121717;">
    <section>
        <div class="container text-light">
            <h1>Upload Profile</h1>
            <form action="" method="POST" enctype="multipart/form-data">
                <label for="profile-image" class="btn btn-dark">Profile Picture:</label>
                <input type="file" name="profile-image" id="profile-image" class="d-none">
        
                <label for="background-picture" class="btn btn-dark">Background Picture:</label>
                <input type="file" name="background-picture" id="background-picture" class="d-none"><br>
                
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" class="form-control"><br>
        
                <label for="description">Description:</label><br>
                <textarea name="description" id="description" rows="4" cols="50" class="form-text"></textarea><br>
        
                <input type="submit" class="btn btn-dark" value="Save">
            </form>
        </div>
    </section>
</body>
</html>
