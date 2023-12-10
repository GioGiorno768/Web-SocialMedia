<?php
require ('koneksi.php');
session_start();
$error="";
$validate="";


// if( isset($_SESSION['username']) ) header('Location: index.php');
function generateRandomString($length = 6) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = substr(str_shuffle($characters),0,$length);
    $_SESSION['captcha_id'] = $randomString;

    echo "$randomString";
}

// $_SESSION['captcha_id'] = generateRandomString();



if( isset($_POST['submit']) ){
    $username = stripslashes($_POST["username"]);
    $username = mysqli_real_escape_string($conn, $username);
    $password = stripslashes($_POST["password"]);
    $password = mysqli_real_escape_string($conn, $password);
    
    if (isset($_POST['captcha'])) {
        $userAnswer = $_POST['captcha'];
        if (isset($_SESSION['captcha_id']) && strtolower($userAnswer) === strtolower($_SESSION['captcha_id'])) {
            if(!empty(trim($username)) && !empty(trim($password)) ) {
        
                $query = "SELECT * FROM user WHERE username = '$username' ";
                $result = mysqli_query($conn, $query);
                $rows = mysqli_num_rows($result);
                if ($rows != 0){
                    $hash = mysqli_fetch_array($result)["password"];
                    // var_dump($hash);
                    // die;
                    
                    if($password == $hash){
                        $_SESSION['username'] = $username;
                        header('Location: index.php');
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
        } else {
            $error = "Captcha Salah";
        }
    } else {
        $error = "Captcha Tidak Valid";
    }
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        section h4 {
            margin-top: 50%;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">


</head>
<body style="background-color: #121717;">
    <section class="container mt-4 text-light sectlog">
        <section class="row justify-content-center">
            <section class="col-12 col-sm-6 col-md-4">
                <form class="form-container" action="login.php" method="POST">
                    <h4 class="text-center fw-bold">Sign-In</h4>
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
                        <div class="form-group">
                            <h3><?= generateRandomString() ?></h3>
                            <label for="captcha">captcha</label>
                            <input type="text" class="form-control" id="captcha" name="captcha" placeholder="Masukkan captcha" required>
                        </div>
                        <br>
                        <button type="submit" name="submit" class="btn btn-dark mx-auto w-100">Sign In</button>
                        <div class="form-footer mt-2">
                            <p>Belum punya account <a href="register.php">Register</a></p>
                        </div>
                    </form>
            </section>
        </section>
    </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</body>
</html>