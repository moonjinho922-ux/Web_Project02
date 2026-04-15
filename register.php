<?php
session_start();
require_once 'functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["password"] !== $_POST["confirm_password"]) {
        $error = "Passwords do not match!";
    } else {
        $result = registerUser($_POST["username"], $_POST["password"]);

        if ($result === true) {
            header("Location: login.php");
            exit();
        } else {
            $error = $result;
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container auth-box">
    <h1>Adventures of the Dice</h1>
    <h2>Register</h2>

    <?php if (!empty($error)) echo "<p>$error</p>"; ?>

    <form method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
        <button type="submit">Register</button>
    </form>

    <p class="link-text">
        <a href="login.php">Login</a>
    </p>
</div>
</body>
</html>