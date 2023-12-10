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
                        <a href="contact.php" class="nav-link active">Contact</a>
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

    <main>
      <section id="contact" class="pt-5">
        <div class="container pt-5">
          <div class="pt-5 pb-5">
            <div class="contact-con d-flex justify-content-between align-items-center">
              <div class="con-left">
                <div class="sec-title mb-4">
                  <h6 class="text-danger fw-medium"><span class="bg-danger"></span> Contact Us</h6>
                  <h1 class="text-white">You Need Help? Contact With us</h1>
                </div>
                <div class="contact-item row gap-3 mb-5 text-white text-opacity-75">
                  <div class="mb-1">
                    <i class='bx bx-phone-call'></i>
                    <p>Phone :</p>
                    <a class="text-decoration-none text-white text-opacity-75" href="tel:+6289635650954" target="_blank">+62-896-3565-0954</a>
                  </div>
                  <div class="mb-1">
                    <i class='bx bx-envelope'></i>
                    <p>Email : </p>
                    <a class="text-decoration-none text-white text-opacity-75" href="mailto:kevinragil768@gmail.com" target="_blank">kevinragil768@gmail.com</a>
                  </div>
                  <div class="mb-1">
                    <i class='bx bx-map'></i>
                    <p>Location :</p>
                    <a class="text-decoration-none text-white text-opacity-75" href="https://goo.gl/maps/CZiS4aq6mu22Ev6P9" target="_blank">7°34'39.1"S 111°52'15.5"E</a>
                  </div>
                </div>
              </div>
              <div class="contact-form bg-black d-flex justify-content-center">
                <form id="conform" action="" method="post" class="w-100">
                  <div class="mb-4 mt-4">
                    <input type="text" class="w-100 p-2" name="nama" id="" placeholder="Masukkan Nama">
                  </div>
                  <div class="mb-4">
                    <input type="text" class="w-100 p-2" name="email" id="emailform" placeholder="Email Address">
                  </div>
                  <div class="mb-4">
                    <input type="text" class="w-100 p-2" name="subject" id="" placeholder="Subject">
                  </div>
                  <div class="mb-4">
                    <input type="text" class="w-100 p-2" name="message" id="" placeholder="Message">
                  </div>
                  <div class="mb-4">
                    <input type="checkbox" name="terms" id="chcont">
                    <label for="terms" class="text-white text-opacity-75">I agree with services tarms and condition</label>
                  </div>
                  <div class="mt-5">
                    <button class="btn btn-danger" type="submit">Submit Now</button>
                  </div>
                </form>
              </div>
            </div>
            <div class="map mt-3 mb-5">
              <iframe src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d622.8700921840112!2d111.8713995711554!3d-7.57731540482084!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zN8KwMzQnMzkuMSJTIDExMcKwNTInMTUuNSJF!5e0!3m2!1sid!2sid!4v1688052496227!5m2!1sid!2sid" style="border:0;" allowfullscreen="" class="w-100 h-100" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
          </div>
        </div>
      </section>
    </main>

    <footer>
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
