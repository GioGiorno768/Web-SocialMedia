<?php 

session_start();
require_once 'koneksi.php';

    if (!isset($_SESSION['username'])) {
        header("Location: admin.php");
        exit();
    }

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

    if (!empty($_SESSION['username'])) {
    // Retrieve all images uploaded by other users
    $sql = "SELECT * FROM images WHERE username";
    $result = mysqli_query($conn, $sql);
    $other_images = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

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
        <div class="container pt-5">
            <div class="d-flex justify-content-between align-items-center py-5 flex-sm-column flex-lg-row">
                <h2>Image From User</h2>
                
                <form class="d-flex me-5" role="search" action="gallery.php" method="GET">
                    <input class="form-control me-2" type="search" name="search" placeholder="Search by image name" aria-label="Search">
                    <button class="btn btn-dark" type="submit">Search</button>
                </form>
            </div>

            <div class="image-container flex-wrap">
                <?php if (!empty($other_images)): ?>
                    <?php foreach ($other_images as $image): ?>
                        <div class="image">
                            <img src="<?php echo $image['image_name']; ?>" alt="Image from Other Users">
                            <a class="btn btn-dark mt-2" href="admin_delete.php?id=<?php echo $image['id']; ?>">Delete</a>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No images found.</p>
                <?php endif; ?>
            </div>
        </section>


    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-element-bundle.min.js"></script>
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mixitup/3.3.1/mixitup.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    </body>
</html>