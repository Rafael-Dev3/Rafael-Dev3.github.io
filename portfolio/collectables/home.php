<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Homepage</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">
</head>

<body class="bg-secondary-subtle">
  <nav class="navbar navbar-expand-lg bg-dark p-2 shadow">
    <div class="container-fluid">
      <a class="navbar-brand text-white" href="#">
        <i class="bi bi-briefcase-fill"></i>
        Collectables
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link active text-secondary" href="home.php">Home</a></li>
          <li class="nav-item"><a class="nav-link text-secondary" href="login.php">inloggen</a></li>
          <li class="nav-item"><a class="nav-link text-secondary" href="register.php">registreren</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container py-5 text-center">
    <h1 class="fw-bold display-5 text-dark">All my collectables</h1>
    <p class="text-secondary fs-5 mt-3">Here are some Collectables that we have</p>
  </div>

  <div class="bg-dark-subtle w-100 mb-5">
    <img src="assets/logo.webp" alt="" class="d-block mx-auto">
  </div>

  <!-- cards -->

  <?php
  require_once 'includes/db.php';
  $stmt = $pdo->query("SELECT * FROM collections ORDER BY updated_at DESC");
  $collections = $stmt->fetchAll();
  ?>

  <div class="container pb-5">
    <div class="row g-4 justify-content-center">

      <!-- cards -->
      <?php foreach ($collections as $collection): ?>

        <div class="col-md-6 col-lg-4">

          <div class="card border-0 shadow-sm rounded-4 h-100">

            <div class="card-body text-center">

              <h5 class="fw-semibold mb-3">
                <?= htmlspecialchars($collection['name']) ?>
              </h5>

              <p class="text-secondary">
                <?= htmlspecialchars($collection['description']) ?>
              </p>

              <p class="small text-muted">
                Last Updated:
                <?= $collection['updated_at'] ?>
              </p>

              <a href="collection.php?id=<?= $collection['id'] ?>" class="text-decoration-none">
                <i class="bi bi-box-arrow-up-right"></i>
                Visit page
              </a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>


  <!-- top 3 -->

  <div class="container-md-2 pt-4 pb-4 d-flex justify-content-center mx-4">
    <div class="card-group">

      <div class="card m-3">
        <img src="assets/pokemon.png" class="card-img-top h-100 object-fit-cover" alt="Manga">
        <div class="card-body">
          <h5 class="card-title">Top 1</h5>
          <p class="card-text">
            pokemon cards There is a LOT of them, theres also alot of different types From what we have seen it is most of You're Favorites!
          </p>
        </div>
      </div>

      <div class="card m-3">
        <img src="assets/image.png" class="card-img-top h-100 object-fit-cover" alt="Currency">
        <div class="card-body">
          <h5 class="card-title">Top 2</h5>
          <p class="card-text">
            Special currencys!, theres alot of special bills, but also coins around the world, this catagory shows alot
            of these, and is also very popular on our website!
          </p>
        </div>
      </div>

      <div class="card m-3">
        <img src="assets/games.png" class="card-img-top h-100 object-fit-cover" alt="Games">
        <div class="card-body">
          <h5 class="card-title">Top 3</h5>
          <p class="card-text">
            Games, it is unsurprising that many people have chosen for this one! Games are very popularized under the
            young, but lets be real who DOESNT like to game!
          </p>
        </div>
      </div>

    </div>
  </div>


<div class="container-fluid bg-dark text-light py-5">
    <div class="container">

        <div class="row">

            <!-- About -->
            <div class="col-md-3 mb-4">
                <h5>Final Gambit</h5>
                <p>
                    Your destination for collectible Pokémon cards, Funko Pops,
                    manga, games, merchandise, and rare collectibles.
                </p>
            </div>

            <!-- Categories -->
            <div class="col-md-3 mb-4">
                <h5>Categories</h5>
                <ul class="list-unstyled">
                    <li><a href="collection.php" class="text-light text-decoration-none">Pokémon Cards</a></li>
                    <li><a href="collection.php" class="text-light text-decoration-none">Manga</a></li>
                    <li><a href="collection.php" class="text-light text-decoration-none">Funko Pops</a></li>
                    <li><a href="collection.php" class="text-light text-decoration-none">Games</a></li>
                </ul>
            </div>

            <!-- Customer Service -->
            <div class="col-md-3 mb-4">
                <h5>Customer Service</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-light text-decoration-none">Contact Us</a></li>
                    <li><a href="#" class="text-light text-decoration-none">Shipping</a></li>
                    <li><a href="#" class="text-light text-decoration-none">Returns</a></li>
                    <li><a href="#" class="text-light text-decoration-none">FAQ</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div class="col-md-3 mb-4">
                <h5>Contact</h5>
                <p>Email: info@finalgambit.nl</p>
                <p>Phone: +31 6 1234 5678</p>

                <div class="fs-4">
                    <a href="#" class="text-light me-3"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-light me-3"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="text-light"><i class="bi bi-twitter-x"></i></a>
                </div>
            </div>

        </div>

    </div>
</div>

<div class="container-fluid bg-black text-center py-3">
    <small class="text-light">
        © 2026 Final Gambit. All Rights Reserved.
    </small>
</div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>