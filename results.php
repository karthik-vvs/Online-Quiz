<!DOCTYPE html>
<html>
<head>
    <title>Quiz Results</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: linear-gradient(-20deg, #f794a4 0%, #fdd6bd 100%);
            height:97vh;
            
        }

        .result-container {
    display:flex;
    flex-direction:column;
    justify-content:center;
    align-items:center;
}

        h2 {
            color: #333;
            margin-bottom: 20px;
            font-size:50px;
        }

        p {
            color: #555;
            margin-bottom: 10px;
            font-size:40px;
        }

        .score {
            color: black;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        a {
            display: inline-block;
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 6px;
            transition: background-color 0.3s ease;
        }

        a:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="result-container">
        <h2>Quiz Results</h2>
<?php
session_start();
require_once "connection.php";

// Check if user is not logged in
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

// Initialize score
$score = 0;

// Retrieve submitted answers
if (isset($_POST['answers'])) {
    $submittedAnswers = $_POST['answers'];

    // Loop through submitted answers
    foreach ($submittedAnswers as $questionId => $submittedAnswer) {
        // Retrieve correct answer from database
        $query = "SELECT correct_answer FROM questions WHERE id = $questionId";
        $result = mysqli_query($connection, $query);
        $row = mysqli_fetch_assoc($result);
        $correctAnswer = $row['correct_answer'];

        // Check if submitted answer is correct
        if ($submittedAnswer === $correctAnswer) {
            $score++;
        }
    }

    // Update user's score and latest completion time
    $username = $_SESSION['user'];
    $currentTime = date('Y-m-d H:i:s');
    $updateQuery = "UPDATE users SET score = $score, completion_time = NOW() WHERE username = '$username'";
    mysqli_query($connection, $updateQuery);
}

// Display the score
echo " Quiz Results<br>";
echo " Your score: " . $score;
echo "<br><br>";
echo "<a href='home.php'>Go to Home Page</a>";
?>

    </div>
</body>
</html>