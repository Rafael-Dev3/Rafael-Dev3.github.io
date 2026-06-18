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
        <span class="navbar-brand mb-0"><span class="bi bi-linkedin bg-primary"> </span><b>LinkedPro</b></span>
        <div>
            <i class="bi bi-house text-light"></i><a href="index.php" class="text-white px-2">Home</a>
            <i class="bi bi-person text-light"></i> <a href="descriptions.php" class="text-white px-2">Profile</a>
            <i class="bi bi-box-arrow-right text-light"></i> <a href="register.php" class="text-white px-2">register</a>
        </div>
    </nav>
    <!-- connection from sql to php -->
    <?php
    $db = new PDO("mysql:host=localhost;dbname=mon-in", "root", "");
    $query = $db->prepare("SELECT * FROM posts");
    $query->execute();

    // fetch the posts editable later
    $posts = $query->fetchAll(PDO::FETCH_ASSOC);

    // function getuser to fetch usernames in the database
    function getUser($id, $db)
    {
        $sql = "
    SELECT *
    FROM users
    WHERE id=$id
    ";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    }

    // foreach loop that shows the posts in sql
    ?>

    <div class="container mt-4 w-75">
        <!-- cards with styling showing the posts the name the pfp, nicely in cards  -->
        <?php foreach ($posts as $post): ?>
            <?php $user = getUser($post['user_id'], $db); ?>
            <div class="card mb-3 shadow-sm p-3">
                <a href="descriptions.php?id=<?= $post['user_id'] ?>"><img class="rounded-circle me-3 p-1" width="70"
                        height="70" src=<?= $user['avatar'] ?>></a>
                <h6 class="card-title  font-monospace fw-bold bg-white d-flex justify-content-start"><?= $user["name"] ?>
                </h6>
                <p class="card-text bg-white d-flex justify-content-start"><?= $post['content'] ?></p>

            </div>
        <?php endforeach ?>
        


    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>