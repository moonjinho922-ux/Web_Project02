<?php
// Destroy session to log user out
session_start();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout | Adventures of the Dice</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container center-box">
        <h1>Adventures of the Dice</h1>
        <h2>You have been logged out.</h2>
        <a href="login.php" class="btn-link">Return to Login</a>
    </div>
</body>
</html>