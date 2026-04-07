<?php
session_start();
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

        <form action="#" method="post">
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