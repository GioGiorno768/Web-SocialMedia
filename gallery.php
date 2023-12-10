<?php 
  session_start();
  require_once 'koneksi.php';
  
  // Function to perform Boyer-Moore search algorithm
function boyerMoore($text, $pattern) {
  $n = strlen($text);
  $m = strlen($pattern);
  $skip = [];

  for ($i = 0; $i < 256; $i++) {
      $skip[$i] = $m;
  }

  for ($i = 0; $i < $m - 1; $i++) {
      $skip[ord($pattern[$i])] = $m - $i - 1;
  }

  $i = $m - 1;

  while ($i < $n) {
      $j = $m - 1;
      $k = $i;

      while ($j >= 0 && $text[$k] == $pattern[$j]) {
          $j--;
          $k--;
      }

      if ($j === -1) {
          return $k + 1;
      }

      $i += $skip[ord($text[$i])];
  }

  return -1;
}

if (empty($_SESSION['username'])) {
  // Retrieve all images uploaded by other users
  $sql = "SELECT * FROM images WHERE username";
  $result = mysqli_query($conn, $sql);
  $other_images = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
  $current_user = $_SESSION['username'];

  if ($_SESSION['username'] == 'admin768' && $_SESSION['password'] == 'admin768') {
    
  }

  // Retrieve images uploaded by other users
  $sql = "SELECT * FROM images WHERE username != '$current_user'";
  $result = mysqli_query($conn, $sql);
  $other_images = mysqli_fetch_all($result, MYSQLI_ASSOC);

  // Retrieve images uploaded by the current user
  $sql = "SELECT * FROM images WHERE username = '$current_user'";
  $result = mysqli_query($conn, $sql);
  $user_images = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

// Check if the search query is provided
if (isset($_GET['search'])) {
  $search = $_GET['search'];

  // Filter images from other users based on search query
  if (!empty($_SESSION['username'])) {
    $filteredOtherImages = array_filter($other_images, function ($image) use ($search) {
        return boyerMoore($image['name_img'], $search) !== -1;
    });
    $filteredUserImages = array_filter($user_images, function ($image) use ($search) {
        return boyerMoore($image['name_img'], $search) !== -1;
    });

    $other_images = $filteredOtherImages;
    $user_images = $filteredUserImages;
  } else {
    $filteredOtherImages = array_filter($other_images, function ($image) use ($search) {
        return boyerMoore($image['name_img'], $search) !== -1;
    });

    $other_images = $filteredOtherImages;
  }
}
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
                        <a href="gallery.php" class="nav-link active">Gallery</a>
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

    <main class="text-light">
      
      <section>
        <div class="container pt-5">
            <div class="d-flex justify-content-between align-items-center py-5 flex-sm-column flex-lg-row">
                <h2>Explore</h2>
                
                <form class="d-flex me-5" role="search" action="gallery.php" method="GET">
                    <input class="form-control me-2" type="search" name="search" placeholder="Search by image name" aria-label="Search">
                    <button class="btn btn-dark" type="submit">Search</button>
                </form>
            </div>

            <div class="image-container flex-wrap">
                <?php if (!empty($other_images)): ?>
                    <?php foreach ($other_images as $image): ?>
                        <div class="image position-relative">
                            
                            <img src="<?php echo $image['image_name']; ?>" alt="Image from Other Users">
                            <a href="<?php echo $image['image_name'] ?>" download class="btn-download position-absolute m-2 end-0 text-decoration-none btn btn-dark rounded-0"><i class='bx bx-sm bx-download'></i></a>
                            <figcaption class="position-absolute bottom-0 text-start w-75 p-2 bg-black bg-opacity-75 m-2">
                                <h3 class="text-truncate"><a href="detail.php" class="text-decoration-none"><?php echo $image['caption'] ?></a></h3>
                                <p class="text-truncate"><?php echo $image['name_img'] ?></p>
                            </figcaption>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No images found.</p>
                <?php endif; ?>
                <?php if (!empty($user_images)): ?>
                    <?php foreach ($user_images as $image): ?>
                        <div class="image position-relative">
                            <img src="<?php echo $image['image_name']; ?>" alt="Your Image">
                            <a href="<?php echo $image['image_name'] ?>" download class="btn-download position-absolute m-2 end-0 text-decoration-none btn btn-dark rounded-0"><i class='bx bx-sm bx-download'></i></a>
                            <figcaption class="position-absolute bottom-0 text-start w-75 p-2 bg-black bg-opacity-75 m-2">
                                <h3 class="text-truncate"><a href="detail.php" class="text-decoration-none"><?php echo $image['caption'] ?></a></h3>
                                <p class="text-truncate"><?php echo $image['name_img'] ?></p>
                            </figcaption>
                        </div>
                    <?php endforeach; ?>
                <?php elseif (!empty($_SESSION['username'])): ?>
                    <p>No images uploaded by you.</p>
                <?php endif; ?>
            </div>
        </div>
      </section>
    </main>


    <script src="script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mixitup/3.3.1/mixitup.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" ></script>

    <script>
      $(document).ready(function(){
        var mixer = mixitup('.box-list');
      })
    </script>
  </body>
</html>
