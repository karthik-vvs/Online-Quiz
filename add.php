<?php
session_start();
require_once "connection.php";
// Check if admin is not logged in
if(!isset($_SESSION['admin'])) {
    header("Location: admin.php");
    exit;
}
// Database connection (code not shown)
// Assuming 'questions' table structure: id (AUTO_INCREMENT), question, options, correct_answer
if(isset($_POST['submit'])) {
    $question = $_POST['question'];
    $option1 = $_POST['option1'];
    $option2 = $_POST['option2'];
    $option3 = $_POST['option3'];
    $option4 = $_POST['option4'];
    $correct_answer = $_POST['correct_answer'];
    $insertQuery = "INSERT INTO questions (question, option1, option2, option3, option4, correct_answer) VALUES ('$question', '$option1', '$option2', '$option3', '$option4', '$correct_answer')";
    
    // Execute the insert query
    if(mysqli_query($connection, $insertQuery)) {
        // Redirect after successful insertion
        header("Location: all.php");
        exit;
    } else {
        echo "Error: " . $insertQuery . "<br>" . mysqli_error($connection);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Question</title>
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
    max-width: 600px;
    margin: 20px auto;
    background-color: #f0e4b7;
    padding: 20px;
    border-radius: 15px;
    box-shadow: 2px 2px 20px rgb(116 87 87 / 96%);
}

        h2 {
            text-align: center;
        }

        form {
            margin-top: 20px;
        }

        textarea,
        input[type="text"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-sizing: border-box;
        }

        input[type="submit"] {
    background-color: #0720d8;
    color: #fff;
    font-size: 20px;
    cursor: pointer;
}
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Add Question</h2>
        <form method="post" action="">
            <textarea name="question" placeholder="Enter question" required></textarea><br>
            <input type="text" name="option1" placeholder="Enter option1" required><br>
            <input type="text" name="option2" placeholder="Enter option2" required><br>
            <input type="text" name="option3" placeholder="Enter option3" required><br>
            <input type="text" name="option4" placeholder="Enter option4" required><br>
            <input type="text" name="correct_answer" placeholder="Enter correct answer" required><br>
            <input type="submit" name="submit" value="Submit">
        </form>
    </div>
</body>
</html>

