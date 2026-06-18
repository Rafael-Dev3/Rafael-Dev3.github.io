<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Collectie details</title>

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
          <li class="nav-item"><a class="nav-link text-secondary" href="home.php">Home</a></li>
          <li class="nav-item"><a class="nav-link text-secondary" href="login.php">inloggen</a></li>
          <li class="nav-item"><a class="nav-link text-secondary" href="register.php">registreren</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container py-5 text-center">
    <h1 class="fw-bold display-5 text-dark">Collection Details</h1>
    <p class="text-secondary fs-5 mt-3">View this collection and its items</p>
  </div>

  <div class="bg-dark-subtle w-100 mb-5">
    <img src="assets/logo.webp" alt="" class="d-block mx-auto">
  </div>

<?php
require_once 'includes/db.php';

$collectionId = $_GET['id'] ?? null;

if (!is_numeric($collectionId)) {
  header('Location: home.php');
  exit;
}

$stmt = $pdo->prepare("
  SELECT collections.*, users.name, users.id
  FROM collections
  JOIN users ON users.id = collections.user_id
  WHERE collections.id = ?
");

$stmt->execute([$collectionId]);
$collection = $stmt->fetch();

if ($collection) {
  $itemStmt = $pdo->prepare("
    SELECT * FROM items
    WHERE collection_id = ?
    ORDER BY created_at DESC
  ");

  $itemStmt->execute([$collectionId]);
  $items = $itemStmt->fetchAll();

} else {
  http_response_code(404);
  $items = [];
}
?>

<div class="container pb-4">

<?php if (!$collection): ?>

  <div class="alert alert-danger">
    This collection does not exist.
    <a href="home.php">Back</a>
  </div>

<?php else: ?>

  <div class="card shadow-sm mb-4">
    <div class="card-body text-center">

      <h3 class="mb-2"><?= htmlspecialchars($collection['name']) ?></h3>

      <p class="text-secondary">
        <?= nl2br(htmlspecialchars($collection['description'] ?? 'No description')) ?>
      </p>

      <p class="small text-muted">
        By
        <a href="profiel.php?id=<?= $collection['user_id'] ?>">
          <?= htmlspecialchars($collection['name']) ?>
        </a>
      </p>

      <p class="small text-muted">
        Items: <?= count($items) ?>
      </p>

    </div>
  </div>

  <!-- items -->

  <div class="row g-4">

    <?php foreach ($items as $item): ?>

      <div class="col-md-6 col-lg-4">

        <div class="card border-0 shadow-sm rounded-4 h-100">

          <div class="card-body text-center">

            <h5 class="fw-semibold mb-2">
              <?= htmlspecialchars($item['name']) ?>
            </h5>

            <p class="text-secondary">
              <?= nl2br(htmlspecialchars($item['description'] ?? 'No description')) ?>
            </p>

            <?php if (!empty($item['category'])): ?>
              <span class="badge bg-secondary mb-2">
                <?= htmlspecialchars($item['category']) ?>
              </span>
            <?php endif; ?>

            <p class="small text-muted">
              <?= $item['created_at'] ?>
            </p>

          </div>
        </div>

      </div>

    <?php endforeach; ?>

  </div>

<?php endif; ?>

</div>

<div class="container-md-4 bg-dark d-flex justify-content-center mt-5">
  <h3 class="text-light">Copyright 2026 &copy;Final Gambit</h3>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>