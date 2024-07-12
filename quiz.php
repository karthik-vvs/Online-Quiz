<?php
session_start();
require_once "connection.php";

// Check if user is not logged in
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

// Retrieve 10 random questions from the database
$query = "SELECT * FROM questions ORDER BY RAND() LIMIT 10";
$result = mysqli_query($connection, $query);

// Calculate the end time of the quiz (1 minute from now)
$endTime = time() + 60; // 60 seconds for 1 minute

// Initialize score
$score = 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Quiz</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: linear-gradient(to top, #bdc2e8 0%, #bdc2e8 1%, #e6dee9 100%);
            margin: 0;
            padding: 0;
        }

        h2 {
            color: white;
            background: linear-gradient(to bottom, #323232 0%, #3F3F3F 40%, #1C1C1C 150%), 
            linear-gradient(to top, rgba(255,255,255,0.40) 0%, rgba(0,0,0,0.25) 200%);
            background-blend-mode: multiply;            
            padding: 10px;
            margin-top: 0px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size:40px;
        }

        #timer {
            color: white;
            font-size: 30px;
            margin: 20px;
            margin-bottom:0px;
            display: flex;
            align-items: right;
        }

        form div {
            margin-bottom: 20px;
        }

        form div p {
            font-weight: bold;
            margin-bottom: 10px;
        }

        input[type="radio"] {
            margin-right: 10px;
        }

        input[type="submit"] {
            background-color: blue;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: blue;
        }
    </style>
    <script>
        var timerInterval; 
        function updateTimer() {
            var now = new Date().getTime();
            var distance = <?php echo $endTime * 1000 ?> - now;

            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById("timer").innerHTML = minutes + "m " + seconds + "s ";

            if (distance < 0) {
                clearInterval(timerInterval);
                document.getElementById("timer").innerHTML = "Time's up!";
                document.getElementById("quizForm").submit(); // Automatically submit the quiz when time's up
            }
        }
        
        function startTimer() {
            timerInterval = setInterval(updateTimer, 1000);
        }
      
        function stopTimer() {
            clearInterval(timerInterval);
        }

        function handleWindowSwitch() {
            stopTimer();
            alert("You've switched windows. Your quiz will be automatically submitted.");
            document.getElementById("quizForm").submit(); // Automatically submit the quiz when window is switched
        }

        window.onload = startTimer;

        window.addEventListener("blur", function() {
            handleWindowSwitch();
        });
    </script>
</head>
<body>
    <div class="quiz-container">
        <h2>
            Quiz
            <span id="timer">
                <span id="timer-text">1m 0s</span>
            </span>
        </h2>
        <form id="quizForm" method="post" action="results.php">
        <?php
        $i=1;
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div>";
            echo $i.") <p>" . $row['question'] . "</p>";
            echo "<input type='radio' name='answers[" . $row['id'] . "]' value='" . $row['option1'] . "'> " . $row['option1'] . "<br>";
            echo "<input type='radio' name='answers[" . $row['id'] . "]' value='" . $row['option2'] . "'> " . $row['option2'] . "<br>";
            echo "<input type='radio' name='answers[" . $row['id'] . "]' value='" . $row['option3'] . "'> " . $row['option3'] . "<br>";
            echo "<input type='radio' name='answers[" . $row['id'] . "]' value='" . $row['option4'] . "'> " . $row['option4'] . "<br>";
            echo "</div>";
            $i++;
            }
        ?>
        <input type="submit" value="Submit">
    </form>
    </div>
</body>
</html>