<?php
session_start();
require_once "connection.php";

// Check if admin is not logged in
if(!isset($_SESSION['admin'])) {
    header("Location: admin.php");
    exit;
}

// Check if question ID is provided in the URL parameter
if(!isset($_GET['id'])) {
    header("Location: allquestions.php");
    exit;
}

$question_id = $_GET['id'];

// Retrieve question details from the database
$query = "SELECT * FROM questions WHERE id = $question_id";
$result = mysqli_query($connection, $query);
$question = mysqli_fetch_assoc($result);

// Handle form submission
if(isset($_POST['submit'])) {
    $question_text = $_POST['question'];
    $option1 = $_POST['option1'];
    $option2 = $_POST['option2'];
    $option3 = $_POST['option3'];
    $option4 = $_POST['option4'];
    $correct_answer = $_POST['correct_answer'];

    // Update question details in the database
    $update_query = "UPDATE questions SET question = '$question_text', option1 = '$option1',  option2 = '$option2', option3 = '$option3',
     option4 = '$option4',correct_answer = '$correct_answer' WHERE id = $question_id";
    mysqli_query($connection, $update_query);

    // Redirect back to allquestions.php
    header("Location: all.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Question</title>
</head>
<body>
    <h2>Edit Question</h2>
    <form method="post" action="">
        <input type="text" name="question" value="<?php echo $question['question']; ?>" required><br>
        <input type="text" name="option1" value="<?php echo $question['option1']; ?>" required><br>
        <input type="text" name="option2" value="<?php echo $question['option2']; ?>" required><br>
        <input type="text" name="option3" value="<?php echo $question['option3']; ?>" required><br>
        <input type="text" name="option4" value="<?php echo $question['option4']; ?>" required><br>
        <input type="text" name="correct_answer" value="<?php echo $question['correct_answer']; ?>" required><br>
        <input type="submit" name="submit" value="Submit">
    </form>
</body>
</html>
