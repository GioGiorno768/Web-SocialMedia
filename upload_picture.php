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

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark pt-3 pb-3 text-light position-fixed w-100">
        <div class="container">
            <a href="index.php" class="navbar-brand">VINVEXEL</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="gallery.php" class="nav-link">Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a href="profile.php" class="nav-link active">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a href="contact.php" class="nav-link">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a href="blog.php" class="nav-link">Blog</a>
                    </li>
                </ul>
            </div>
            <ul class="navbar-nav d-sm-none d-md-none d-lg-block ml-auto">
                <?php if(empty($_SESSION['username'])): ?>
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
    </nav>

    <main>
        <section>
            <div class="pt-5 text-light">
                <div class="container pt-5">
                    <h2>Unggah Gambar</h2>
                    <form action="upload_image.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="image" class="form-label">Choose Image</label>
                            <input type="file" name="image" id="image" required class="form-control-file"/>
                        </div>
                        <div class="mb-3">
                            <label for="caption" class="form-label">Caption</label>
                            <input type="text" name="caption" id="caption" required class="form-control" />
                        </div>
                        <div class="mb-3">
                            <label for="image_name" class="form-label">Image Name</label>
                            <input type="text" name="name_img" id="image_name" required class="form-control" />
                        </div>
                        <div class="mb-3">
                            <label for="category" class="form-label">category</label>
                            <select name="category" id="category" class="form-select" required aria-label="Default select example">
                                <option value="all">All</option>
                                <option value="photography">photography</option>
                                <option value="ui">ui</option>
                                <option value="painting">painting</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" required class="form-control"></textarea>
                        </div>
                        <input type="submit" value="Upload Image" class="btn btn-dark rounded-0" />
                        <a href="profile.php" class="btn btn-danger rounded-0">Kembali ke profile</a>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-element-bundle.min.js"></script>
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mixitup/3.3.1/mixitup.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    </body>
</html>