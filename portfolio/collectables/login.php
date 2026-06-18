<?php
session_start();

$email = "";
$password = "";

$db = new PDO("mysql:host=localhost;dbname=collectables", "root", "");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $db->prepare("SELECT id, email, password FROM users WHERE email = :email");
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && $password === $user['password']) {

        $_SESSION['user_id'] = $user['id'];

        header("Location: home.php");
        exit;

    } else {

        exit;

    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="bg-light">

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

<div class="container d-flex flex-column align-items-center mt-5">

  <h2>Login</h2>

  <form method="post" class="w-50">

    <div class="mb-3">
      <label>Email</label>
      <input class="form-control" type="email" name="email" required>
    </div>

    <div class="mb-3">
      <label>Password</label>
      <input class="form-control" type="password" name="password" required>
    </div>

    <button class="btn btn-dark w-100">Login</button>

  </form>

</div>

</body>
</html>xx