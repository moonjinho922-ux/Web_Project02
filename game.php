<?php
session_start();
require_once "functions.php";

// Redirect if not logged in
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

// Redirect if game not started
if (!isset($_SESSION["p1"])) {
    header("Location: start.php");
    exit();
}

// Prevent undefined errors
if (!isset($_SESSION["winner"])) {
    $_SESSION["winner"] = null;
}

$dice = "-";

if ($_SERVER["REQUEST_METHOD"] == "POST" && !$_SESSION["winner"]) {
    $dice = rollDice();

    if ($_SESSION["turn"] == 1) {
        $_SESSION["p1"] += $dice;
        $_SESSION["turn"] = 2;
    } else {
        $_SESSION["p2"] += $dice;
        $_SESSION["turn"] = 1;
    }

    // Win check and save to leaderboard 
    if ($_SESSION["p1"] >= 100 && !$_SESSION["winner"]) {
        $_SESSION["winner"] = "Player 1";
        addToLeaderboard($_SESSION["user"], $_SESSION["p1"]);
    }

    if ($_SESSION["p2"] >= 100 && !$_SESSION["winner"]) {
        $_SESSION["winner"] = "Player 2";
        addToLeaderboard($_SESSION["user"], $_SESSION["p2"]);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Game | Adventures of the Dice</title>
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
        
        <!-- Baord -->
        <div class="board">
            <?php for ($i = 100; $i >= 1; $i--): ?>
                <div class="cell"><?php echo $i; ?></div>
            <?php endfor; ?>
        </div>

        <!-- Game Panel -->
        <div class="game-panel">
            <p><strong>Turn:</strong> Player <?php echo $_SESSION["turn"]; ?></p>
            <p><strong>Dice:</strong> <?php echo $dice; ?></p>
            <p><strong>Player 1 Position:</strong> <?php echo $_SESSION["p1"]; ?></p>
            <p><strong>Player 2 Position:</strong> <?php echo $_SESSION["p2"]; ?></p>

            <?php if (!$_SESSION["winner"]): ?>
                <form method="post">
                    <button type="submit">Roll Dice</button>
                </form>
            <?php else: ?>
                <h3><?php echo $_SESSION["winner"]; ?> Wins!</h3>

                <div class="button-group">
                    <a href="start.php" class="btn-link">Play Again</a>
                    <a href="leaderboard.php" class="btn-link">View Leaderboard</a>
                </div>
            <?php endif; ?>

            <br>
            <!-- <a href="leaderboard.php" class="btn-link">Leaderboard</a> -->
        </div>

    </div>
</div>
</body>
</html>