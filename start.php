<?php
// Session check to ensure user is logged in
session_start();
require_once "functions.php";

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

// Handle game start request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Initialize game using selected difficulty
    initGame($_POST["difficulty"]);

    // Redirect to main game board
    header("Location: game.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Start Game</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container center-box">
        <h1>Adventures of the Dice</h1>

        <form method="post">
            <select name="difficulty">
                <option value="easy">Easy</option>
                <option value="medium">Medium</option>
                <option value="hard">Hard</option>
            </select>
            <button type="submit">Start</button>
        </form>
    </div>
</body>
</html>