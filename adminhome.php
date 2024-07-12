<?php
session_start();
require_once "connection.php";
// Check if admin is not logged in
if(!isset($_SESSION['admin'])) {
    header("Location: admin.php");
    exit;
}
$username = $_SESSION['admin'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: linear-gradient(to top, #f3e7e9 0%, #e3eeff 99%, #e3eeff 100%);            padding: 0;
            height:100vh;
            display:flex;
            flex-direction:column;
            align-items:center;
        }

        .container {
            max-width: 800px;
            margin:  auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size:50px;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
        }

        li a {
    display: block;
    padding: 15px;
    background-color: #052b9f;
    color: #fff;
    text-decoration: none;
    border-radius: 9px;
    text-align: center;
    width: 300px;
}

li a:hover {
    background-color: #0056b3;
    transform: scaleX(1.06);
    transition: all 0.3s ease;
}
    </style>
</head>
<body>
    <h2>Welcome, <?php echo $username; ?>!</h2>
    <ul>
        <li><a href="add.php">Add Questions</a></li>
        <li><a href="all.php">View All Questions</a></li>
        <li><a href="players.php">View Player Scores</a></li>
        <li><a href="ranking.php">Ranking</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</body>
</html>
