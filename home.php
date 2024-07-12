<?php
session_start();
require_once "connection.php";
// Check if user is not logged in
if(!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}
$username = $_SESSION['user'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: linear-gradient(to right, #fa709a 0%, #fee140 100%);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .home-container {
            background-color: white;
            padding: 70px;
            border-radius: 50px;
            box-shadow: 4px 2px 20px rgb(204 40 40 / 53%);
            max-width: 300px;
            width: 100%;
            text-align: center;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
            font-size:40px;
        }

        a {
            display: inline-block;
            background-color: lightgreen;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 10px;
            transition: background-color 0.3s ease;
        }

        a:hover {
            background-color: green;
        }
    </style>
</head>
<body>
    <div class="home-container">
        <h2>Welcome <?php echo $username; ?>!</h2>
        <a href="quiz.php">Start Quiz</a><br>
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>

