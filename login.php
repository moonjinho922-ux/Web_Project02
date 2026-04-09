<?php
session_start();
// note - still need to fix functions.php for this to work
if (isset($_SESSION['username'])) {
    header("Location: game.php");
    exit();
}

require_once 'functions.php';

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        $error = "Please fill in all fields.";
    } else {
        $user = getUserByUsername($username);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['username'] = $user['username'];
            header("Location: game.php");
            exit();
        } else {
            $error = "Invalid username or password.";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Adventures of the Dice</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container auth-box">
        <h1>Adventures of the Dice</h1>
        <h2>Login</h2>

        <form action="login.php" method="post">
            <label for="username">Username</label>
            <input type="text" id="username" name="username">

            <label for="password">Password</label>
            <input type="password" id="password" name="password">

            <button type="submit">Login</button>
        </form>

        <p class="link-text">Don’t have an account? <a href="register.php">Register here</a></p>
    </div>
</body>
</html>