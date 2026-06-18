<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <?php
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("location: login.php");
        exit();
    }

    try {
        $db = new PDO("mysql:host=localhost;dbname=mon-in", "root", "");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Database connection failed: " . $e->getMessage());
    }


    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty(trim($_POST['content']))) {
        $stmt = $db->prepare("INSERT INTO posts (user_id, content, created_at) VALUES (:user_id, :content, NOW())");
        $stmt->bindParam(':user_id', $_SESSION['user_id']);
        $stmt->bindParam(':content', $_POST['content']);
        $stmt->execute();
        header("Location: home.php");
        exit();
    }


    $stmt = $db->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->bindParam(':id', $_SESSION['user_id']);
    $stmt->execute();
    $currentUser = $stmt->fetch(PDO::FETCH_ASSOC);


    $posts = $db->query("SELECT * FROM posts ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);

    function getUser($id, $db)
    {
        $stmt = $db->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    ?>

    <nav class="navbar navbar-dark bg-primary px-3 d-flex justify-content-between">
        <span class="navbar-brand mb-0">
            <span class="bi bi-linkedin bg-primary"></span>
            <b>LinkedPro</b>
        </span>
        <div>
            <i class="bi bi-house text-light"></i>
            <a href="index.php" class="text-white px-2">Home</a>

            <i class="bi bi-person text-light"></i>
            <a href="descriptions.php?id=<?= htmlspecialchars($_SESSION['user_id']) ?>"
                class="text-white px-2">Profile</a>

            <i class="bi bi-box-arrow-right text-light"></i>
            <a href="logout.php" class="text-white px-2">Logout</a>
        </div>
    </nav>

    <div class="container mt-4 w-75">
        <p>Welkom <?= htmlspecialchars($currentUser['name']) ?></p>


        <div class="card mb-3 p-3">
            <form method="POST">
                <textarea name="content" class="form-control mb-2" placeholder="Wat wil je delen?" maxlength="500"
                    required></textarea>
                <button class="btn btn-primary w-100">Post</button>
            </form>
        </div>


        <?php foreach ($posts as $post):
            $postUser = getUser($post['user_id'], $db);
            $timestamp = strtotime($post['created_at']);
            $hoursAgo = floor((time() - $timestamp) / 3600);
            ?>
            <div class="card mb-3 shadow-sm p-3">
                <div class="d-flex align-items-center mb-2">
                    <a href="descriptions.php?id=<?= $postUser['id'] ?>">
                        <img class="rounded-circle me-2" width="50" height="50"
                            src="<?= htmlspecialchars($postUser['avatar']) ?>" alt="Avatar">
                    </a>
                    <div>
                        <strong><?= htmlspecialchars($postUser['name']) ?></strong><br>
                        <small class="text-muted"><?= htmlspecialchars($postUser['headline']) ?></small>
                    </div>
                </div>
                <p><?= htmlspecialchars($post['content']) ?></p>
                <small class="text-muted"><?= $hoursAgo ?> uur geleden - <?= date("H:i", $timestamp) ?></small>
            </div>
        <?php endforeach; ?>
    </div>
</body>

</html>