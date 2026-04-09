<?php
session_start();

if (isset($_SESSION['username'])) {
    header("Location: game.php");
    exit();
}

require_once 'functions.php';

$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm  = $_POST['confirm_password'] ?? '';

    if ($password !== $confirm) {
        $error = "Passwords do not match.";
    } else {
        $result = registerUser($username, $password);
        if ($result === true) {
            $success = "Account created! <a href='login.php'>Login here</a>";
        } else {
            $error = $result; 
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Adventures of the Dice</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container auth-box">
        <h1>Adventures of the Dice</h1>
        <h2>Register</h2>

        <form action="register.php" method="post">
            <label for="new-username">Username</label>
            <input type="text" id="new-username" name="username">

            <label for="new-password">Password</label>
            <input type="password" id="new-password" name="password">

            <label for="confirm-password">Confirm Password</label>
            <input type="password" id="confirm-password" name="confirm_password">

            <button type="submit">Register</button>
        </form>

        <p class="link-text">Already have an account? <a href="login.php">Login here</a></p>
    </div>
</body>
</html>