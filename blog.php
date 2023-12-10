<?php
session_start();
require_once 'koneksi.php';



?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Filterable Gallery</title>
    <link rel="stylesheet" href="style.css" />
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
                          <a href="profile.php" class="nav-link">Profile</a>
                      </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a href="contact.php" class="nav-link">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a href="blog.php" class="nav-link active">Blog</a>
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

    <main>

      <section id="blog" class="pt-5">
        <div class="container pt-5 text-light">
          <div class="d-flex gap-5">
            <article class="w-75">
              <div class="w-100">
                <img src="assetss/blog-7.jpg" width="100%" alt="">
                <div class="d-flex my-2 align-items-center py-4 border-1 border-bottom border-white border-opacity-50">
                  <i class='bx bx-user text-danger '></i>
                  <p class="mx-3 p-0 mb-0">By Admin</p>
                  <span>|</span>
                  <!-- <i class='bx bx-calendar ms-3 text-danger'></i>
                  <p class="mx-3 p-0 mb-0">05, Juli 2003</p>
                  <span>|</span> -->
                  <i class='bx bx-chat mx-3 text-danger'></i>
                  <p class="mx-1 p-0 mb-0">3 Comment</p>
                </div>
                <h1 class="py-4">Lu Punya Duit Lu Punya Kuasa</h1>
                <p class="text-white-50">Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure assumenda officia aut consequatur sequi sint libero ea explicabo quos, laborum ipsa numquam cumque quis. Molestias debitis eius eligendi asperiores sed.</p>
              </div>
              <a href="" class="my-4 text-white text-decoration-none"><h5>Read More</h5></a>
            </article>
            <aside class="w-25">
              <div class="top-category w-100 p-4 bg-black bg-opacity-50">
                <h1 class="border-bottom border-1 py-4">Top Category</h1>
                <div class="top-category">
                  <a href="" class="text-white-50 text-decoration-none d-block"><i class='bx bx-label'></i> Photograpy</a>
                  <a href="" class="text-white-50 text-decoration-none d-block"><i class='bx bx-label'></i> Photograpy</a>
                  <a href="" class="text-white-50 text-decoration-none d-block"><i class='bx bx-label'></i> Photograpy</a>
                  <a href="" class="text-white-50 text-decoration-none d-block"><i class='bx bx-label'></i> Photograpy</a>
                  <a href="" class="text-white-50 text-decoration-none d-block"><i class='bx bx-label'></i> Photograpy</a>
                </div>
              </div>
              <div class="recent-post w-100 mt-5 p-4 bg-black bg-opacity-50">
                <h1 class="border-bottom border-1 py-4">Recent Post</h1>
                <div class="post-selected">
                  <div class="my-post">
                    <img src="assetss/blog-3.jpg" width="100%" class="flex-grow-1" alt="">
                    <div class="flex-grow-1">
                      <i class='bx bx-calendar ms-3 text-danger'>05, Juli 2003</i>
                      <h2 class="mx-2 p-0 mb-0">Lorem ipsum dolor sit amet.</h2>
                    </div>
                  </div>
                </div>
              </div>
            </aside>
          </div>
        </div>
      </section>

      
    </main>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-element-bundle.min.js"></script>
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mixitup/3.3.1/mixitup.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

    <script>
      $(document).ready(function () {
        var mixer = mixitup(".box-list");
      });
    </script>
  </body>
</html>
