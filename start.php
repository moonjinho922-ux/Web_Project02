<?php
session_start();
require_once "functions.php";

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    initGame($_POST["difficulty"]);
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
    <p>Welcome, <strong><?php echo htmlspecialchars($_SESSION["username"]); ?></strong>!</p>

    <form method="post">
        <select name="difficulty">
            <option value="easy">Easy</option>
            <option value="medium">Medium</option>
            <option value="hard">Hard</option>
        </select>
        <button type="submit">Start Game</button>
    </form>

    <div class="button-group">
        <a href="leaderboard.php" class="btn-link">Leaderboard</a>
        <a href="logout.php" class="btn-link">Logout</a>
    </div>
</div>
</body>
</html>