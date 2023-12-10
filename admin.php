<?php 
session_start();
require_once 'koneksi.php';
$error="";
$validate="";

if( isset($_POST['submit']) ){
    $username = stripslashes($_POST["username"]);
    $username = mysqli_real_escape_string($conn, $username);
    $password = stripslashes($_POST["password"]);
    $password = mysqli_real_escape_string($conn, $password);


    if(!empty(trim($username)) && !empty(trim($password)) ) {

        $query = "SELECT * FROM admin WHERE username = '$username' ";
        $result = mysqli_query($conn, $query);
        $rows = mysqli_num_rows($result);
        if ($rows != 0){
            $hash = mysqli_fetch_array($result)["password"];
            // var_dump($hash);
            // die;
            
            if($password == $hash){
                $_SESSION['username'] = $username;
                header('Location: adminpage.php');
            } else {
                $error = "Password Anda Salah";
            }
        // jika gagal maka akna menampilkan pesan error
        } else {
            $error = "Username Anda Salah";
        }
    } else {
        $error = "Data Tidak boleh Kosong";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">

    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Belanosima:wght@400;600;700&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 
    </head>
    <body style="background-color: #121717;">
        <section class="container mt-4 text-light">
            <section class="row justify-content-center">
                <section class="col-12 col-sm-6 col-md-4">
                    <form class="form-container" action="admin.php" method="POST">
                        <h2 class="text-center">Login Admin</h2>
                        <?php if($error != '') : ?>
                            <div class="alert alert-danger" role="alert"><?= $error; ?></div>
                        <?php endif; ?>

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan Username">
                        </div>
                        <div class="form-group">
                            <label for="inputPassword">Password</label>
                            <input type="password" class="form-control" id="InputPassword" name="password" placeholder="Password">
                            <?php if ($validate != '') {?>
                                <p class="text-danger"><?= $validate; ?></p>
                            <?php }?>
                        </div>
                        <br>
                        <button type="submit" name="submit" class="btn btn-primary btn-block">Sign In</button>
                        <div class="form-footer mt-2">
                            <p>Belum punya account <a href="register.php">Register</a></p>
                        </div>
                    </form>
                </section>
            </section>
        </section>


    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-element-bundle.min.js"></script>
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mixitup/3.3.1/mixitup.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    </body>
</html>