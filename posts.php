
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts Page</title>
    <style>

    @import url('https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&display=swap');

        body {
            font-family: "Josefin Sans", sans-serif;
            font-optical-sizing: auto;
            font-style: normal;
            margin: auto;
            overflow: auto;
            background-image: url("gifbg.gif");
            background-repeat: repeat-y;
            background-size: cover;
        }

        h1 {
            font-family: "Josefin Sans", sans-serif;
            font-optical-sizing: auto;
            font-style: normal;
            text-align: center;
            margin: 50px 0px;
            font-size: 50px;
            color: #fff;
        }

        .intro {
            background-color: #557692;
            color: white;
            font-family: "Josefin Sans", sans-serif;
            font-optical-sizing: auto;
            font-style: normal;
            text-align: center;
            margin: 100px auto 5px;
            border: 2px solid white;
            width: 600px;
            border-radius: 10px;
        }

        .posts-container {
            max-width: auto;
            margin: 0px 200px;
            padding: 20px;
            border-radius: 5px;
            
        }

        #posts {
            color: #fff;
        }

        ul {
            font-family: "Josefin Sans", sans-serif;
            font-optical-sizing: auto;
            font-style: normal;
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 30px;
            cursor: pointer;
            padding: 4em 3em 1em;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 2.5px;
            font-size: 12px;
            font-weight: 700;
            color: #0a0a0a;
            background-color: #fff;
            border: none;
            border-radius: 20px;
            box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease 0s;
            cursor: pointer;
            outline: none;
            height: 50px;
            text-align: center;
            opacity: 0.10;
        }

        li:hover {
            background-color: #6e91af;
            box-shadow: 0px 15px 20px rgba(35, 37, 36, 0.4);
            color: #faf7f7;
            transform: translateY(-7px);
            opacity: 1;
        }

        li:active {
            transform: translateY(-1px);

        }

    </style>
</head>

<body>
    <div class="intro">
        <h2>🎉 Welcome to the Posts Menu! 🎉<br><br> Choose and click on any of the posts to view </h2>
    </div>

    <div class="posts-container">
        <h1>Posts Menu</h1>
        <ul id="posts">
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
                    $user_id = $_SESSION['user_id'];

                    $query = "SELECT * FROM `posts` WHERE user_id = :id";
                    $statement = $pdo->prepare($query);
                    $statement->execute([':id' => $user_id]);

                    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($rows as $row) {
                        echo '<li><a href="post.php?id=' . $row['id'] . '">' . $row['title'] . '</li>';
                    }
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
            }

            ?>
        </ul>
    </div>
</body>


<!-- This section is the JavaScript code to connect the Posts Menu to the Post Page -->
<!-- <script>
    // Posts Page
    document.addEventListener("DOMContentLoaded", function() {
        fetch("https://jsonplaceholder.typicode.com/posts")
            .then(response => response.json())
            .then(posts => {
                const postLists = document.getElementById("posts");

                posts = posts.slice(0, 7);
                posts.forEach(post => {
                    const li = document.createElement("li");
                    li.textContent = post.title;
                    li.setAttribute("data-id", post.id);
                    li.addEventListener("click", function() {
                        const id = this.getAttribute("data-id");
                        // window.location.href = "post.html?id=" + id;
                        window.location.href = `post.html?id=${id}`;
                    });
                    postLists.appendChild(li);
                });
            })
            .catch(error => console.error("Error fetching posts:", error));
    });
</script> -->
</html>
