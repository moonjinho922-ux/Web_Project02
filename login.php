<?php
// Session setup and login processing
session_start();
require_once 'functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (loginUser($_POST["username"], $_POST["password"])) {
        header("Location: start.php");
        exit();
    } else {
        $error = "Invalid login!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container auth-box">
        <h1>Adventures of the Dice</h1>
        <h2>Login</h2>

        <?php if (!empty($error)) echo "<p>$error</p>"; ?>

        <form method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>

        <p class="link-text">
            <a href="register.php">Register</a>
        </p>
    </div>
</body>
</html>