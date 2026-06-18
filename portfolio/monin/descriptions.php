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

<body class="bg-light">

    <nav class="navbar navbar-dark bg-primary px-3 d-flex justify-content-between">
        <span class="navbar-brand mb-0"><span class="badge bg-primary">IN</span>mon</span>
        <div>
            <i class="bi bi-house text-light"></i><a href="index.php" class="text-white px-2">Home</a>
            <i class="bi bi-person text-light"></i> <a href="descriptions.php" class="text-white px-2">Profile</a>
            <i class="bi bi-box-arrow-right text-light"></i> <a href="register.php" class="text-white px-2">register</a>
        </div>
    </nav>
    <?php
    //connection to database
    $id = $_GET['id'];
    $db = new PDO("mysql:host=localhost;dbname=mon-in", "root", "");
    //fetch all users
    $query = $db->prepare("SELECT * FROM users WHERE id=$id");
    $query->execute();
    //store results
    $user = $query->fetch(PDO::FETCH_ASSOC);




    ?>
    <?php
    // connect to the database
    $db = new PDO("mysql:host=localhost;dbname=mon-in", "root", "");

    // fetch all posts 
    $query = $db->prepare("SELECT * FROM posts");
    $query->execute();

    // store the results
    $posts = $query->fetchAll(PDO::FETCH_ASSOC);
    ?>


    <div class="container-fluid pb-3" style="width: 55%;">
        <div class="card p-3">
            </i><img class="rounded-circle me-3 p-1" width="70" height="70" src=<?= $user['avatar'] ?>></a>
            <div class="h3 d-flex"><?= $user['name'] ?><button
                    class="ms-auto bg-light border-primary text-primary fs-6 p-2 bi bi-pen">Edit Profile</button></div>
            <p><?= $user['headline'] ?></p>
            <b>About</b>
            <p><?= $user['about'] ?>
                <br>
            </p>

        </div>




    </div>
    <?php
    $skills = explode(',', $user['skills']);
    $interests = explode(',', $user['interests']);
    ?>

    <div class="container-fluid pb-3" style="width: 55%;">
        <div class="card p-3">
            <div style="..." class="alert alert-light" role="alert">
                <h4 class="alert-heading"><i class="bi bi-tools"></i> Skills</h4>
                <?php foreach ($skills as $skill): ?>
                    <span class="badge text-bg-primary"><?= $skill ?></span>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-3" style="width: 55%;">
        <div class="card p-3">
            <div style="..." class="alert alert-light" role="alert">
                <h4 class="alert-heading"><i class="bi bi-heart"></i> Interests</h4>
                <?php foreach ($interests as $interest): ?>
                    <span class="badge text-bg-secondary"><?= $interest ?></span>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="container-fluid pb-3" style="width: 55%;">
        <div class="card p-3">
            <i class="bi-phone"><b>Posts</b></i>
            <?php foreach ($posts as $post): ?>
                <div class="mt-3 border-top pt-2">
                    <time><?= floor((time() - strtotime($post['created_at'])) / 3600) ?> uur geleden</time>
                        <p><?= $post['content'] ?></p>

                </div>
            <?php endforeach; ?>
        </div>
    </div>



</body>

</html>