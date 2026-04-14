<?php
session_start();
require_once "functions.php";

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

if (!isset($_SESSION["p1"])) {
    header("Location: start.php");
    exit();
}

$dice = "-";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dice = rollDice();

    if ($_SESSION["turn"] == 1) {
        $_SESSION["p1"] += $dice;
        $_SESSION["turn"] = 2;
    } else {
        $_SESSION["p2"] += $dice;
        $_SESSION["turn"] = 1;
    }

    // Win condition
    if ($_SESSION["p1"] >= 100) {
        echo "<h2>Player 1 Wins!</h2>";
        session_destroy();
    }

    if ($_SESSION["p2"] >= 100) {
        echo "<h2>Player 2 Wins!</h2>";
        session_destroy();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Board | Adventures of the Dice</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="top-bar">
            <h1>Adventures of the Dice</h1>
            <a href="logout.php" class="small-link">Logout</a>
        </div>

        <h2>Game Board</h2>

        <div class="game-layout">
            <div class="board">
                <?php for ($i = 100; $i >= 1; $i--) : ?>
                    <div class="cell"><?php echo $i; ?></div>
                <?php endfor; ?>
            </div>

            <div class="game-panel">
                <p><strong>Current Turn:</strong> Player 1</p>
                <p><strong>Dice Result:</strong> -</p>
                <p><strong>Player 1 Position:</strong> 0</p>
                <p><strong>Player 2 Position:</strong> 0</p>

                <form action="#" method="post">
                    <button type="submit">Roll Dice</button>
                </form>

                <a href="leaderboard.php" class="btn-link">Leaderboard</a>
            </div>
        </div>
    </div>
</body>
</html>