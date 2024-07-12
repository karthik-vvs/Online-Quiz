<?php
session_start();
require_once "connection.php";

// Check if admin is not logged in
if(!isset($_SESSION['admin'])) {
    header("Location: admin.php");
    exit;
}

// Retrieve all questions from the database
$query = "SELECT * FROM questions";
$result = mysqli_query($connection, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>All Questions</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color:none;
            margin: 0;
            padding: 0;
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
            background-color:gray;
            padding:30px;
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

        tr:nth-child(even){
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        td a {
            text-decoration: none;
            color: #007bff;
            color:green;
        }

        td a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h2>All Questions</h2>
    <table border="1">
        <tr  >
            <th>ID</th>
            <th>Question</th>
            <th colspan= "4">Options</th>
            <th>Correct Answer</th>
            <th>Action</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['question']; ?></td>
            <td><?php echo $row['option1']; ?></td>
            <td><?php echo $row['option2']; ?></td>
            <td><?php echo $row['option3']; ?></td>
            <td><?php echo $row['option4']; ?></td>
            <td><?php echo $row['correct_answer']; ?></td>
            <td><a href="editquestions.php?id=<?php echo $row['id']; ?>">Edit</a></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
