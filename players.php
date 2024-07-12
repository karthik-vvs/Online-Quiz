<?php
session_start();
require_once "connection.php";
// Check if admin is not logged in
if(!isset($_SESSION['admin'])) {
    header("Location: admin.php");
    exit;
}
$query = "SELECT * FROM users where id!=0";
$result = mysqli_query($connection, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Player Scores</title>
    <title>Player Scores</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #FAACA8;
            background-image: linear-gradient(19deg, #FAACA8 0%, #DDD6F3 100%);            
            margin: 0;
            padding: 0;
            height:100vh;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
        }

        table {
    width: 96%;
    margin: 36px;
    border-collapse: collapse;
    margin-top: 20px;
}

        th, td {
            border: 2px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color:#1174de;
            color: #fff;
        }

        tr:nth-child{
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>
    <h2>Player Scores</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Score</th>
            <th>Completion Time</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['score']; ?></td>
            <td><?php echo $row['completion_time']; ?></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
