<?php
session_start();
require_once "connection.php";

// Check if user is already logged in
if(isset($_SESSION['user']) || isset($_SESSION['admin'])) {
    if(isset($_SESSION['admin'])) {
        header("Location: adminhome.php"); // Redirect admin to admin home page
    } else {
        header("Location: home.php"); // Redirect regular user to home page
    }
    exit;
}

// Check if form is submitted
if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate credentials
    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);

    if($user) {
        if($user['is_admin']) {
            $_SESSION['admin'] = $username;
            header("Location: adminhome.php");
        } else {
            $_SESSION['user_id'] = $user['id']; // Set user ID in session
            $_SESSION['user'] = $username;
            header("Location: home.php");
        }
        exit;
    } else {
        $error = "Invalid username or password";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
             background-image: linear-gradient(120deg, #f6d365 0%, #fda085 100%);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
    background-color: white;
    padding: 80px;
    border-radius: 52px;
    box-shadow: 1px 1px 15px 0px rgb(161 31 6);
    max-width: 325px;
    width: 100%;
    text-align: center;
}

        h2 {
            font-size: 36px;
            color: #333;
            margin-bottom: 20px;
            margin-top: 0;
        }

        input[type="text"],
        input[type="password"] {
            width: calc(100% - 24px);
            padding: 12px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            border: 3px solid black;
            border-radius: 4px;
            box-sizing: border-box;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #007bff;
            outline: none;
        }

        input[type="submit"] {
            width: calc(100% - 24px);
            background-color: lightgreen;
            color: white;
            padding: 14px 0;
            margin-top: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: green;
        }

        p.error {
            color: #ff0000;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>
        <form method="post" action="">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <input type="submit" name="login" value="Login">
        </form>
    </div>
</body>
</html>
