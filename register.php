<?php
// Session setup and registration handling
session_start();
require_once 'functions.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = $_POST["password"];
    $confirm = $_POST["confirm_password"];

    // Input validation
    if (empty($username)) {
        $error = "Username cannot be empty!";
    } elseif ($password !== $confirm) {
        $error = "Passwords do not match!";
    } else {
        $result = registerUser($username, $password);

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

        <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>

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