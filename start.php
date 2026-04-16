<?php
session_start();
require_once "functions.php";

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    initGame($_POST["difficulty"]);
    header("Location: game.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION["difficulty"] = $_POST["difficulty"];

    $_SESSION["p1"] = 0;
    $_SESSION["p2"] = 0;
    $_SESSION["turn"] = 1;
    $_SESSION["winner"] = null;

    $_SESSION["start_time"] = time();

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