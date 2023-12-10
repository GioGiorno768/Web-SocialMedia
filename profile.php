<?php 
session_start();
require_once 'koneksi.php';



if (!empty($_SESSION['username'])) {
    $current_user = $_SESSION['username'];
    
    $query = "SELECT * FROM user where username = '$current_user'";
    $sql = mysqli_query($conn, $query);
    $images = mysqli_fetch_assoc($sql);

    // Retrieve images uploaded by the current user
    $sql = "SELECT * FROM images WHERE username = '$current_user'";
    $result = mysqli_query($conn, $sql);
    $user_images = mysqli_fetch_all($result, MYSQLI_ASSOC);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <!-- Swipper CSS -->
    <link rel="stylesheet" href="assets/swipper/swiper-bundle.min.css" />

    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Belanosima:wght@400;600;700&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 
</head>
<body style="background-color: #121717;">
    <nav class="navbar navbar-expand-lg navbar-dark bg-opacity-10 pt-3 pb-3 position-fixed w-100 text-light">
        <div class="container">
            <a href="index.php" class="navbar-brand">VINVEXEL</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item ">
                        <a href="index.php" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="gallery.php" class="nav-link">Gallery</a>
                    </li>
                    <?php if(!empty($_SESSION['username'])): ?>
                      <li class="nav-item">
                          <a href="profile.php" class="nav-link active">Profile</a>
                      </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a href="contact.php" class="nav-link">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a href="blog.php" class="nav-link">Blog</a>
                    </li>
                </ul>
                <ul class="navbar-nav d-sm-none d-md-none d-lg-block gap-4">
                    <li class="nav-item">
                    </li>
                    <?php if (empty($_SESSION['username'])): ?>
                        <li class="nav-item">
                            <a href="login.php" class="nav-link">Log in</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a href="logout.php" class="nav-link">Log Out</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <main class="pt-5">
        <section id="info-gallery">
            <div class="container text-light py-5">
            <div class="sec-title py-5 w-100 d-flex justify-content-between">
                <div class="left">
                <h6 class="text-danger"><span class="bg-danger"></span> <?php echo $images['username'] ?></h6>
                <h1><?php echo $images['name'] ?></h1>
                </div>
                <?php if (!empty($_SESSION['username'])): ?>
                    <?php if(empty($images['profile_image'])): ?>
                        <img src="profile/user.png" alt="Profile Picture" class="rounded-circle position-relative"  width="300" height="300">
                    <?php else: ?>
                        <img src="<?php echo $images['profile_image']; ?>" alt="Profile Picture"  width="300" height="300" class="rounded-circle position-relative">
                    <?php endif; ?>
                <?php else: ?>
                    <img src="profile/user.png" alt="Default Profile Picture" width="300" height="300" class="rounded-circle position-relative">
                <?php endif; ?>
            </div>
            <div class="image-background border-1 border-white border-opacity-50 border-bottom">
                <?php if (!empty($_SESSION['username'])): ?>
                    <?php if(empty($images['profile_background'])): ?>
                        <img src="profile/user.png" alt="Profile Picture" width="100%" height="450">
                    <?php else: ?>
                        <img src="<?php echo $images['profile_background']; ?>" alt="Profile Picture" width="100%" height="450">
                    <?php endif; ?>
                <?php else: ?>
                    <img src="profile/user.png" alt="Default Profile Picture" width="100%" height="450">
                <?php endif; ?>
                <p class="text-white-50 w-50 m-auto mt-5 mb-2"><?php echo $images['description'] ?></p>
                <div class="w-100 d-flex justify-content-center">
                    <a href="upload_profile.php" class="btn btn-dark rounded-0 my-5 w-50">Edit Profile</a>
                </div>
            </div>
            <div class="pt-5">
                <div class="container text-light">
                    <section class="work-box">
                    <div class="container">
                        <div class="row">
                        <div class="col-lg-12">
                            <h1 class="text-center pt-5 ">Our Images</h1>
                            <div class="box-menu">
                            <ul>
                                <li data-filter="*" class="mixitup-control-active">All</li>
                                <li data-filter=".photo">Photography</li>
                                <li data-filter=".ui">ui/ux</li>
                                <li data-filter=".paint">painting</li>
                            </ul>
                            </div>
                        </div>
                        </div>
                        <div class="row box-list">
                        <?php if(!empty($current_user)): ?>
                            <?php foreach ($user_images as $image): ?>
                            <div class="col-lg-4 mix box-item <?php echo $image['category']; ?>">
                                <img src="<?php echo $image['image_name']; ?>" alt="">
                            </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="col-lg-4 mix box-item ui">
                            <a href=""><img src="uploads/cover3.jpg" alt=""></a>
                            </div>
                        <?php endif; ?>
                        <!-- <div class="col-lg-4 mix box-item ui">
                            <img src="uploads/cover3.jpg" alt="">
                        </div>
                        <div class="col-lg-4 mix box-item ui">
                            <img src="uploads/cover3.jpg" alt="">
                        </div>
                        <div class="col-lg-4 mix box-item paint">
                            <img src="uploads/cover3.jpg" alt="">
                        </div>
                        <div class="col-lg-4 mix box-item paint ui">
                            <img src="uploads/cover3.jpg" alt="">
                        </div>
                        </div> -->
                    </div>
                    </section>
                </div>
            </div>
            <div class="container py-3 text-light">
                <div class="row justify-content-between w-100">
                    <div class="col-3">
                        <h1>Your Images</h1>
                    </div>
                    <div class="col-2">
                        <a href="upload_picture.php" class="btn btn-dark rounded-0">Upload Image</a>
                    </div>
                </div>

                <div class="image-container flex-wrap">
                    <?php if (!empty($user_images)): ?>
                        <?php foreach ($user_images as $image): ?>
                            <div class="image">
                                <img src="<?php echo $image['image_name']; ?>" alt="Your Image">
                                <!-- <p>Caption: <?php echo $image['caption']; ?></p>
                                <p>Name: <?php echo $image['name_img']; ?></p>
                                <p>Description: <?php echo $image['description']; ?></p>
                                <p>Category: <?php echo $image['category']; ?></p> -->
                                <a class="btn btn-dark mt-2" href="edit_image.php?id=<?php echo $image['id']; ?>">Edit</a>
                                <a class="btn btn-dark mt-2" href="<?php echo $image['image_name']; ?>" download>Download</a>
                                <a class="btn btn-dark mt-2" href="delete_image.php?id=<?php echo $image['id']; ?>">Delete</a>
                            </div>
                        <?php endforeach; ?>
                    <?php elseif (!empty($_SESSION['username'])): ?>
                        <p>No images uploaded by you.</p>
                    <?php endif; ?>
                </div>
            </div>
            </div>
        </section>
    </main>

    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mixitup/3.3.1/mixitup.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script>
      $(document).ready(function(){
        var mixer = mixitup('.box-list');
      })
    </script>
</body>
</html>
