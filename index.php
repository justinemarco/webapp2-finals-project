<?php

require 'config.php';

$dsn = "mysql:host=$host;dbname=$db;charset=UTF8";
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

try {
    $pdo = new PDO($dsn, $user, $password, $options);

    if ($pdo) {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $query = "SELECT * FROM `users` WHERE username = :username";
            $statement = $pdo->prepare($query);
            $statement->execute([':username' => $username]);

            $user = $statement->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                if ('laverdad' === $password) {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];

                    header("Location: loading.html");
                    exit;
                } else {
                    echo "Invalid password!";
                }
            } else {
                echo "User not found!";
            }
        }
    }
} catch (PDOExeption $e) {
    echo $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>

    <!-- THE PASSWORD IS: laverdad -->

    <style>

    @import url('https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&display=swap');

        body {
            font-family: "Josefin Sans", sans-serif;
            font-optical-sizing: auto;
            font-style: normal;
            background: linear-gradient(-45deg, #f26627, #f9a26c, #efeeee, #98d7d1, #325d79);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
            height: 100vh;
        }

        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        .headers {
            text-align: left;
            margin:auto;
            padding-left: 85px;
            padding-top: 200px;
            font-size: 25px;
            width: 200px;
        }

        h3 {
            font-size: 18px;
            padding: 0px;
            color:rgb(74, 77, 77);
        }

        h5 {
            font-size: 15px;
            margin: 20px 0px;
        }

        .login-container {
            text-align: left;
            max-width: 400px;
            margin: auto;
            padding: 20px;
            border: 1px solid black;
            border-radius: 5px;
        }

        .isa-pang-container {
            width: 178px;
            margin: 50px 100px 0px;
        }

        .submit {
            margin: auto;
            margin-top: 40px;
            font-family: "Josefin Sans", sans-serif;
            font-optical-sizing: auto;
            font-style: normal;
            padding: 5px 80px;
            border-radius: 20px;
            width: 300px;
            height: 40px;
            background-color: black;
            color: white;
        }

        .submit:hover  {
            background-color: white;
            color: black;
            transition: .5s;
            border: 2px solid;
            border-color: white;
        }

        input[type="text"], input[type="password"], button {
            display: block;
            margin-bottom: 20px;
            margin: 0px;
            padding: 10px;
            font-family: "Josefin Sans", sans-serif;
            font-optical-sizing: auto;
            font-style: normal;
            font-size: 15px;
            border-radius: 5px;
        }

        hr {
            width: 500px;
        }

    </style>
</head>

<body>
    <div class="main-container">
            <div class="headers">
                <h2>Login</h2>
                <h3>Hi, welcome!👋</h3>
            </div>
        <div class="login-container">
            <div class="isa-pang-container">
                <form id="loginForm" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                    <h5>Username</h5>
                    <input type="text" id="username" placeholder="Enter your username" name="username" required>
                    <h5>Password</h5>
                    <input type="password" id="password" placeholder="Enter your password" name="password" required>
            </div>
                    <button class="submit">Login</button>
                </form>
        </div>
    </div>

    
</body>

<!-- This section is the JavaScript code to connect the Log In Page to the Posts Page -->

<!-- <script>
    Login Page
    document.getElementById("loginForm").addEventListener("submit", function(event) {
        event.preventDefault();

        const username = document.getElementById("username").value;
        const password = document.getElementById("password").value;

        fetch("https://jsonplaceholder.typicode.com/users")
            .then(response => response.json())
            .then(users => {
                const user = users.find(user => user.username === username);

                if (user) {
                    if (password === "wadproject2") {
                    
                        window.location.href = "loading.html";
                        
                    } else {
                        alert("Incorrect password!");
                    }
                } else {
                    alert("User not found!");
                }
            })
            .catch(error => alert("Error fetching users:", error));
    });
</script> -->
</html>
