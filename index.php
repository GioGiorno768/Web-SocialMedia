<?php
session_start();
require_once 'koneksi.php';



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-opacity-10 pt-3 pb-3 position-fixed w-100 text-light">
        <div class="container">
            <a href="index.php" class="navbar-brand">VINVEXEL</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item ">
                        <a href="index.php" class="nav-link active">Home</a>
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



    <main id="main" class="mb-5">
    <section id="hero" class="container-fluid">
        <div class="container h-100 d-flex justify-content-center text-light flex-column position-relative">
          <div class="hero-item w-50">
            <h4>Explore Your Idea and</h4>
            <h1>Find Amazing Images</h1>
            <p class="fw-lighter">Exploring works of art is like opening the door to an unlimited world of imagination, where colors, shapes, and ideas flow freely.</p>
            <a href="login.php" class="btn btn-success rounded-0 mt-3">Get Started</a>
          </div>
          <div class="hero-link position-absolute">
            <div class="d-flex flex-wrap justify-content-center foot-sosmed my-2">
              <a href="https://web.facebook.com/profile.php?id=100022025883694" class="link-secondary mx-3"><i class='bx bxl-facebook'></i></a>
              <a  href="www." class="link-secondary mx-3"><i class='bx bxl-twitter'></i></a>
              <a href="" class="link-secondary mx-3"><i class='bx bxl-instagram'></i></a>
              <a href="" class="link-secondary mx-3"><i class='bx bxl-pinterest-alt'></i></a>
              <a href="" class="link-secondary mx-3"><i class='bx bxl-figma'></i></a>
            </div>
          </div>
        </div>
      </section>

      <section id="category">
        <div class="category container-fluid bg-black d-flex w-100 text-light">
            <div class="category-item d-flex w-100">
              <div>
                <h4>Photography</h4>
                <p class="mb-5 fw-lighter text-secondary">Tangkap momen dalam cahaya dan bayangan, kreasikan keindahan dalam setiap bidikan.</p>
                <a class="text-decoration-none text-danger" href="">Discover More <i class='bx bx-right-arrow-alt'></i></a>
              </div>
              <span></span>
            </div>
            <div class="category-item d-flex w-100 active">
              <div>
                <h4>UI/UX</h4>
                <p class="mb-5 fw-lighter text-secondary">Berkreasilah dalam desain UI/UX, wujudkan pengalaman yang menakjubkan.</p>
                <a class="text-decoration-none text-danger" href="">Discover More <i class='bx bx-right-arrow-alt'></i></a>
              </div>
              <span></span>
            </div>
            <div class="category-item d-flex w-100">
              <div>
                <h4>Painting</h4>
                <p class="mb-5 fw-lighter text-secondary">Di atas kanvas kosong, imajinasiku terbang bebas, Bersama kuas dan cat, kreasikanlah lukisan ini menjadi nyata.</p>
                <a class="text-decoration-none text-danger" href="">Discover More <i class='bx bx-right-arrow-alt'></i></a>
              </div>
              <span></span>
            </div>
        </div>
      </section>

      <section id="gallery" class="gallery">
        <div class="container text-light py-5">
          <div class="row">
            <div class="sec-title py-3 col-md-6 col-sm-10">
              <h6 class="text-danger"><span class="bg-danger"></span> Gallery</h6>
              <h1>Jelajahi Gambar Dan Desain Menarik Dan Expresikan Karyamu</h1>
              <div class="pt-3">
                <p class="fw-lighter">Melalui gambar, ungkapkan keindahan yang tersembunyi,
                  sentuhlah hati orang dengan ekspresimu yang dalam.
                  Jelajahi dunia, temukan keajaiban,
                  dan biarkan gambarmu menceritakan cerita yang tak terucapkan.</p>
              </div>
            </div>
            <div class="gallery-content col-md-6 offcanvas-end py-3">
              <swiper-container class="mySwiper" effect="cards" grab-cursor="true">
                <swiper-slide style="background-image: url(uploads/front-close-view-young-attractive-female-colored-coat-listening-music-holding-skateboard-pink-wall-model-color-female-young_11zon\(1\)\(1\).jpg);"></swiper-slide>
                <swiper-slide style="background-image: url(uploads/front-view-young-attractive-female-white-t-shirt-colored-coat-holding-skateboard-with-slight-smile-pink-background_11zon.jpg);"></swiper-slide>
                <swiper-slide style="background-image: url(uploads/front-view-woman-with-floral-mask-posing-with-hat_11zon.jpg)"></swiper-slide>
                <swiper-slide style="background-image: url(uploads/0.pngA9B3D4C8-BA72-4134-90CC-29B4B628752EDefault.jpg)"></swiper-slide>
              </swiper-container>
            </div>
          </div>
        </div>
      </section>


      <section>
        <div class="container py-3 mt-5 text-light">
          <div class="sec-title py-3 col-6 text-xl-end text-sm-center w-100">
            <h6 class="text-danger"><span class="bg-danger"></span> Bagaimana Cara Kerjanya</h6>
            <h1>Proses Kerja Sederhana</h1>
          </div>
          <div class="row justify-content-xl-between justify-content-sm-center align-items-stretch gap-sm-4 mt-5">
            <div class="col-sm-4 col-xl-3 my-sm-2 my-xl-0 p-4 bg-dark">
              <img src="assetss/work-1.png" width="70" alt="">
              <h3 class="mt-4">Concept Creation</h3>
              <p class="text-white-50">Konsep penciptaan melibatkan eksplorasi ide, inovasi desain, dan prototipe visualisasi yang kreatif.</p>
            </div>
            <!-- <img src="assetss/shape-1.png" class="col-xl-1 d-sm-none"  width="5%" alt=""> -->
            <div class="col-sm-4 col-xl-3 p-4 my-sm-2 my-xl-0 bg-dark">
              <img src="assetss/work-2.png" width="70" alt="">
              <h3 class="mt-4">Sketch Drawing</h3>
              <p class="text-white-50">Menggunakan pensil dan kertas, ia dengan penuh semangat menggambar sketsa.</p>
            </div>
            <!-- <img src="assetss/shape-2.png" class="col-1 d-sm-none" width="5%" alt=""> -->
            <div class="col-sm-4 col-xl-3 p-4 my-sm-2 my-xl-0 bg-dark">
              <img src="assetss/work-3.png" width="70" alt="">
              <h3 class="mt-4">Final Design</h3>
              <p class="text-white-50">Final design: hasil akhir kreatifitas, perencanaan, penelitian, evaluasi, pengembangan, penyempurnaan.</p>
            </div>
          </div>
        </div>
      </section>

      <section>
        <div class="container text-light py-5">
          <div class="sec-title py-5 col-6 text-center w-100">
            <h6 class="text-danger">News & Blog</h6>
            <h1>News & Insights</h1>
          </div>
          <div class="d-flex gap-4">
            <div class="flex-grow-1">
              <img src="assetss/blog-1.jpg" width="100%" alt="">
              <div class="d-flex my-2 align-items-center">
                <i class='bx bx-calendar text-danger '></i>
                <p class="mx-3 p-0 mb-0">05, Juli 2003</p>
                <span>|</span>
                <i class='bx bx-chat mx-3 text-danger'></i>
                <p class="mx-1 p-0 mb-0">3 Comment</p>
              </div>
              <div class="my-3 text-light">
                <h1><a href="" class="text-light text-decoration-none">Lu Punya Duit Lu Punya Kuasa</a></h1>
              </div>
              <a href="" class="text-white text-decoration-none">Read More</a>
            </div>
            <div class="flex-grow-1">
              <img src="assetss/blog-2.jpg" width="100%" alt="">
              <div class="d-flex my-2 align-items-center">
                <i class='bx bx-calendar text-danger '></i>
                <p class="mx-3 p-0 mb-0">05, Juli 2003</p>
                <span>|</span>
                <i class='bx bx-chat mx-3 text-danger'></i>
                <p class="mx-1 p-0 mb-0">3 Comment</p>
              </div>
              <div class="my-3 text-light">
                <h1><a href="" class="text-light text-decoration-none">Lu Punya Duit Lu Punya Kuasa</a></h1>
              </div>
              <a href="" class="text-white text-decoration-none">Read More</a>
            </div>
            <div class="flex-grow-1">
              <img src="assetss/blog-3.jpg" width="100%" alt="">
              <div class="d-flex my-2 align-items-center">
                <i class='bx bx-calendar text-danger '></i>
                <p class="mx-3 p-0 mb-0">05, Juli 2003</p>
                <span>|</span>
                <i class='bx bx-chat mx-3 text-danger'></i>
                <p class="mx-1 p-0 mb-0">3 Comment</p>
              </div>
              <div class="my-3 text-light">
                <h1><a href="" class="text-light text-decoration-none">Lu Punya Duit Lu Punya Kuasa</a></h1>
              </div>
              <a href="" class="text-white text-decoration-none">Read More</a>
            </div>
          </div>
        </div>
      </section>
    </main>

    <footer id="footer" class="pt-5">
      <div class="container-fluid bg-black text-light">
        <div class="container">
          <div class="foot-cont w-100 align-items-center d-flex flex-column justify-content-center py-5 border-bottom border-1 border-secondary gap-4">
            <div class="d-flex flex-wrap justify-content-center foot-sosmed my-2">
              <a href="" class="link-secondary mx-3"><i class='bx bxl-facebook'></i></a>
              <a href="" class="link-secondary mx-3"><i class='bx bxl-twitter'></i></a>
              <a href="" class="link-secondary mx-3"><i class='bx bxl-instagram'></i></a>
              <a href="" class="link-secondary mx-3"><i class='bx bxl-pinterest-alt'></i></a>
              <a href="" class="link-secondary mx-3"><i class='bx bxl-figma'></i></a>
            </div>
            <ul class="list-unstyled gap-5 d-flex flex-wrap justify-content-center">
              <li class=""><a class="text-decoration-none link-secondary" href="index.php">Home</a></li>
              <li class="text-secondary"><a class="text-decoration-none link-secondary" href="index.php">Gallery</a></li>
              <li class="text-secondary"><a class="text-decoration-none link-secondary" href="index.php">Profil</a></li>
              <li class="text-secondary"><a class="text-decoration-none link-secondary" href="index.php">Contact</a></li>
              <li class="text-secondary"><a class="text-decoration-none link-secondary" href="index.php">Blog</a></li>
            </ul>
          </div>
          <div class="py-5 d-flex justify-content-center align-items-center copyright">
            <p class="fw-lighter text-white text-opacity-75 m-0">Copyright © 2022 Website by VINVEXEL </p>
          </div>
        </div>
      </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-element-bundle.min.js"></script>
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mixitup/3.3.1/mixitup.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
</body>
</html>
