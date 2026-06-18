<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>

</head>

<body class="bg-light">

    <nav class="navbar navbar-dark bg-primary px-3 d-flex justify-content-between">
        <span class="navbar-brand mb-0"><span class="bi bi-linkedin bg-primary"> </span><b>LinkedPro</b></span>
        <div>
            <i class="bi bi-house text-light"></i><a href="index.php" class="text-white px-2">Home</a>
            <i class="bi bi-person text-light"></i> <a href="descriptions.php" class="text-white px-2">Profile</a>
            <i class="bi bi-box-arrow-right text-light"></i> <a href="register.php" class="text-white px-2">register</a>
        </div>
    </nav>

    <?php
    session_start();
    $email = "";
    $password = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $db = new PDO("mysql:host=localhost;dbname=mon-in", "root", "");

        $stmt = $db->prepare("SELECT id, email, password FROM users
    WHERE email = :email");
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user == null) {
            die("email of wachtwoord is onjuist");
        }
        if ($password == $user['password']) {
            $_SESSION['user_id'] = $user['id'];
            header("Location: home.php");
            exit;
        } else {
            die("email of wachtwoord is onjuist");
        }

    }
    ?>
    <div class="container d-flex flex-column align-items-center">
        <h2>Login</h2>

        <form method="post" class="w-50">
            <div class="mb-3">
                <label for="email">Email <span class="text-danger">*</span></label>
                <input class="form-control" type="email" name="email" required>
            </div>

            <div class="mb-3">
                <label for="password">Password <span class="text-danger">*</span></label>
                <input class="form-control" type="password" name="password" required>
            </div>

            <button class="btn btn-primary w-100">Login</button>
        </form>
    </div>


</body>

</html>