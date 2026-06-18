<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>

<body>
    <nav class="navbar navbar-dark bg-primary px-3 d-flex justify-content-between">
        <span class="navbar-brand mb-0"><span class=" bg-primary"> <i class="bi bi-linkedin"></i> </span>Mon-in</span>
        <div>
            <i class="bi bi-house text-light"></i><a href="index.php" class="text-white px-2">Home</a>
            <i class="bi bi-person text-light"></i> <a href="descriptions.php" class="text-white px-2">Profile</a>
            <i class="bi bi-box-arrow-right text-light"></i> <a href="register.php" class="text-white px-2">register</a>
        </div>
    </nav>
    <div class="container-fluid mx-auto text-center pt-4 bg-white" style="width: 40%;">
        <div class="card">
            <b class="h1">Join monIn</b>
            <p>Create your profesional profile</p>
            <?php
            $db = new PDO("mysql:host=localhost;dbname=mon-in", "root", "");
            $fullname = "";
            $email = "";
            $password = "";
            $confirm_password = "";

            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                $fullname = $_POST['fullname'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $confirm_password = $_POST['confirm_password'];
                if ($password !== $confirm_password) {
                    echo "Password Do Not match ";
                    die();

                }
                if (strlen($password) < 5){
                echo "Password must contain atleast 5 characters";
                die();
                }

                
                $sql = "INSERT INTO users (name, email, password)
                VALUES (:name, :email, :password)";

                $stmt = $db->prepare($sql);
                $stmt->bindParam(':name', $fullname);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':password', $password);
                $stmt->execute();

                header("location: index.php");

            }

            ?>

            <form class="w-50 mx-auto" method="POST">

                <div class="mb-3">
                    <label for="name">Full Name <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" name="fullname"
                        value="<?php echo htmlspecialchars($fullname); ?>">
                </div>

                <div class="mb-3">
                    <label for="email">Email <span class="text-danger">*</span></label>
                    <input class="form-control" type="email" name="email" required
                        value="<?php echo htmlspecialchars($email); ?>">
                </div>

                <div class="mb-3">
                    <label for="password">Password <span class="text-danger">*</span></label>
                    <input class="form-control" type="password" name="password" required
                        value="<?php echo htmlspecialchars($password); ?>">
                </div>

                <div class="mb-3">
                    <label for="confirm">Confirm Password <span class="text-danger">*</span></label>
                    <input class="form-control" type="password" name="confirm_password" required
                        value="<?php echo htmlspecialchars($confirm_password); ?>">
                </div>
                <div class="mb-3">
                    <input class="btn btn-primary form-control" type="submit" name="submit" value="Create Account">
                </div>
                <p> Already have an account? <a href="login.php">Login</a></p>

            </form>
        </div>
    </div>

</body>

</html>