<?php

require('koneksi.php');
session_start();
$error = '';
$validate = '';

// Fungsi untuk membuat CAPTCHA dengan gambar teks acak
function generateCaptcha() {
    $imageWidth = 120;
    $imageHeight = 40;

    // Buat gambar
    $image = imagecreate($imageWidth, $imageHeight);

    // Warna latar belakang
    $bgColor = imagecolorallocate($image, 255, 255, 255);

    // Warna teks
    $textColor = imagecolorallocate($image, 1, 1, 1);

    // Tambahkan teks acak ke gambar
    $text = generateRandomString(6); // fungsi generateRandomString dijelaskan di bawah

    // Simpan teks ke sesi
    $_SESSION['captcha_text'] = $text;

    // Letakkan teks di tengah gambar
    $textX = ($imageWidth - imagefontwidth(5) * strlen($text)) / 2;
    $textY = ($imageHeight - imagefontheight(5)) / 2;

    imagestring($image, 5, $textX, $textY, $text, $textColor);

    // Tampilkan gambar
    header("Content-type: image/png");
    imagepng($image);
    imagedestroy($image);
}

// Fungsi untuk menghasilkan string acak
function generateRandomString($length = 6) {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

// Periksa apakah permintaan CAPTCHA
if(isset($_GET['captcha'])) {
    generateCaptcha();
    exit;
}

if (isset($_POST['submit'])) {
    // Cek apakah jawaban CAPTCHA benar
    if (isset($_POST['captcha_answer'])) {
        $userAnswer = $_POST['captcha_answer'];

        // Cek apakah sesi captcha_text sudah di-set sebelumnya
        if (isset($_SESSION['captcha_text']) && strtolower($userAnswer) === strtolower($_SESSION['captcha_text'])) {
            // Jawaban benar, lanjutkan dengan proses pendaftaran atau tindakan lainnya

            $username = stripcslashes($_POST["username"]);
            $username = mysqli_real_escape_string($conn, $username);
            $name = stripcslashes($_POST["name"]);
            $name = mysqli_real_escape_string($conn, $name);
            $email = stripcslashes($_POST["email"]);
            $email = mysqli_real_escape_string($conn, $email);
            $password = stripcslashes($_POST["password"]);
            $password = mysqli_real_escape_string($conn, $password);
            $repass = stripcslashes($_POST['repassword']);
            $repass = mysqli_real_escape_string($conn, $repass);

            if (!empty(trim($name)) && !empty(trim($username))  && !empty(trim($email)) && !empty(trim($password))  && !empty(trim($repass))) {
                if ($password == $repass) {
                    if (cek_nama($name, $conn) == 0) {
                        $pass = password_hash($password, PASSWORD_DEFAULT);
                        $query = "INSERT INTO user( username, name, email, password) VALUES ('$username','$name','$email','$password')";
                        $result = mysqli_query($conn, $query);

                        if ($result) {
                            $_SESSION['username'] = $username;

                            header('Location: index.php');
                        } else {
                            $error = "Register User Gagal !!";
                        }
                    } else {
                        $error = "Username sudah ada !!";
                    }
                } else {
                    $validate = "Password Tidak Sama !!";
                }
            } else {
                $error = "Data tidak boleh kosong !!";
            }
        } else {
            // Jawaban salah
            $error = "Jawaban CAPTCHA salah. Coba lagi.";
        }
    } else {
        // Jawaban tidak valid
        $error = "Jawaban CAPTCHA tidak valid. Coba lagi.";
    }
}

function cek_nama($username, $con)
{
    $nama = mysqli_real_escape_string($con, $username);
    $query = "SELECT * FROM user WHERE username = '$nama' ";
    if ($result = mysqli_query($con, $query)) return mysqli_num_rows($result);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <title>Registration Form with Image CAPTCHA</title>
</head>

<body style="background-color: #121717;">
    <section class="container mb-4 text-light">
        <section class="row justify-content-center">
            <section class="col-12 col-sm-6 col-md-4">
                <form class="form-container" action="register.php" method="POST">
                    <h4 class="text-center fw">Sign In</h4>

                    <?php if ($error != '') : ?>
                        <div class="alert alert-danger" role="alert"><?= $error; ?></div>
                    <?php endif ?>

                    
                    <!-- Sisanya dari formulir -->
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Masukkan Nama">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" name="email" id="email" placeholder="Masukkan email">
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" id="username" placeholder="Masukkan Username">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                        <?php if ($validate != '') { ?>
                            <p class="text-danger"><?php echo $validate; ?></p>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label for="repassword">Re-Password</label>
                        <input type="password" class="form-control" name="repassword" id="repassword" placeholder="Re-Password">
                        <?php if ($validate != '') { ?>
                            <p class="text-danger"><?php echo $validate; ?></p>
                        <?php } ?>
                    </div>
                    <!-- Bagian CAPTCHA -->
                    <div class="form-group">
                        <img src="captcha.php" alt="CAPTCHA Image">
                        <br>
                        <label for="captcha_answer">Ketikkan teks di atas:</label>
                        <input type="text" class="form-control" name="captcha_answer" required>
                        <?php if ($validate != '') { ?>
                            <p class="text-danger"><?php echo $validate; ?></p>
                        <?php } ?>
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary btn-block">Register</button>
                    <div class="form-footer mt-2">
                        <p> Sudah Punya Account <a href="login.php">Login</a></p>
                    </div>
                </form>
            </section>
        </section>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>
