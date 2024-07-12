<!DOCTYPE html>
<html>
<head>
    <title>User Ranking</title>
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
            border-radius: 10px;
            box-shadow: 2px 2px 20px rgb(227 111 111);
        }

        h2 {
            text-align: center;
            border-radius: 10px;
            background-color:#aef359;
            padding:10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        th:hover{
            background-color: #0056b3;
    transform: scaleX(1.06);
    transition: all 0.3s ease;
        }
        td:hover{
            background-color: white;
    transform: scaleX(1.06);
    transition: all 0.3s ease;
        }
        .Hi:hover{
    transform: scaleX(1.06);
    transition: all 0.3s ease;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="Hi">User Ranking</h2>
<?php
session_start();
require_once "connection.php";

// Query to select users ordered by score
$query = "SELECT username, score FROM users where id>0 ORDER BY score DESC";
$result = mysqli_query($connection, $query);

// Check if there are any users
if(mysqli_num_rows($result) > 0) {
    // Counter for rank
    $rank = 1;

    // Display table headers
    echo "<table border='1'>
            <tr>
                <th>Rank</th>
                <th>Username</th>
                <th>Score</th>
            </tr>";

    // Display user data
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>$rank</td>
                <td>{$row['username']}</td>
                <td>{$row['score']}</td>
              </tr>";
        $rank++;
    }

    // Close table
    echo "</table>";
} else {
    // Display message if no users found
    echo "No users found.";
}
?>
</div>
</body>
</html>