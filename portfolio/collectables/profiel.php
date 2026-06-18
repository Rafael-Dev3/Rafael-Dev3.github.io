<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profiel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>

<body class="bg-secondary-subtle">

<?php
$id = $_GET['id'];

$db = new PDO("mysql:host=localhost;dbname=collectables", "root", "");


$query = $db->prepare("SELECT * FROM users WHERE id = ?");
$query->execute([$id]);

$user = $query->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die("Gebruiker niet gevonden");
}


$query = $db->prepare("SELECT * FROM collections WHERE user_id = ?");
$query->execute([$id]);

$collections = $query->fetchAll(PDO::FETCH_ASSOC);
?>


<nav class="navbar navbar-expand-lg bg-dark p-2 shadow">
    <div class="container-fluid">
        <a class="navbar-brand text-white" href="home.php">
            <i class="bi bi-briefcase-fill"></i>
            Collectables
        </a>

        <div>
            <a href="home.php" class="text-secondary text-decoration-none px-2">Home</a>
            <a href="login.php" class="text-secondary text-decoration-none px-2">Login</a>
            <a href="register.php" class="text-secondary text-decoration-none px-2">Register</a>
        </div>
    </div>
</nav>


<div class="container-fluid pt-4" style="width:55%;">
    <div class="card p-4 shadow-sm">

        <h2><?= $user['name'] ?></h2>

        <p class="text-muted">
            <?= $user['email'] ?>
        </p>

        <hr>

        <h5>Bio</h5>

        <p>
            <?= $user['bio'] ?>
        </p>

    </div>
</div>


<div class="container-fluid pt-4" style="width:55%;">
    <div class="card p-4 shadow-sm">

        <h4>
            <i class="bi bi-collection"></i>
            Verzamelingen
        </h4>

        <?php foreach ($collections as $collection): ?>

            <div class="border-top pt-3 mt-3">

                <h5><?= $collection['name'] ?></h5>

                <p><?= $collection['description'] ?></p>

                <small class="text-muted">
                    Laatst bijgewerkt: <?= $collection['updated_at'] ?>
                </small>

            </div>

        <?php endforeach; ?>

    </div>
</div>

</body>
</html>