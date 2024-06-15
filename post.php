<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="post.css">
    <title>Post Page</title>
</head>

<body>

    <input type="checkbox" name="btn" id="btn" checked>

<div class="content">

    <div class="post-container">
        <h1>Post Page</h1>
        <div id="postDetails">
            <?php

            require 'config.php';

            if (!isset($_SESSION['user_id'])) {
                header("Location: index.php");
                exit;
            }

            $dsn = "mysql:host=$host;dbname=$db;charset=UTF8";
            $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

            try {
                $pdo = new PDO($dsn, $user, $password, $options);

                if ($pdo) {
                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];

                        $query = "SELECT * FROM `posts` WHERE id = :id";
                        $statement = $pdo->prepare($query);
                        $statement->execute([':id' => $id]);

                        $post = $statement->fetch(PDO::FETCH_ASSOC);

                        if ($post) {
                            echo '<h3>Title: ' . $post['title'] . '</h3>';
                            echo '<p>Body: ' . $post['body'] . '</p>';
                        } else {
                            echo "No post found with ID $id!";
                        }
                    } else {
                        echo "No post ID provided!";
                    }
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            ?>
        </div>
    </div>

            <div class="ground">
                <div class="sewer"></div>
            </div>
            <div class="streetlamp">
                <div class="base"></div>
                <div class="basetop"></div>
                <div class="pole"></div>
                <div class="poletop"></div>
                <div class="head">
                    <label for="btn"></label>
                    <div class="top"></div>
                    <div class="glass"></div>
                    <div class="bot"></div>
                </div>
                <div class="light"></div>
                <div class="ground-light"></div>
            </div>
    
</div>
</body>

</html>