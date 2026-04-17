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

if (!isset($_SESSION["winner"])) {
    $_SESSION["winner"] = null;
}

$config = getBoardConfig($_SESSION["difficulty"]);

$dice = "-";

function applySnakesLadders($pos, $config) {
    if (isset($config["snakes"][$pos])) {
        return $config["snakes"][$pos];
    }
    if (isset($config["ladders"][$pos])) {
        return $config["ladders"][$pos];
    }
    return $pos;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && !$_SESSION["winner"]) {
    $dice = rand(1, 6);
    $_SESSION["rolls"]++;

    if ($_SESSION["turn"] == 1) {
        $_SESSION["p1"] += $dice;
        $_SESSION["p1"] = applySnakesLadders($_SESSION["p1"], $config);
        $_SESSION["turn"] = 2;
    } else {
        $_SESSION["p2"] += $dice;
        $_SESSION["p2"] = applySnakesLadders($_SESSION["p2"], $config);
        $_SESSION["turn"] = 1;
    }

    // Win check
    if ($_SESSION["p1"] >= 100 && !$_SESSION["winner"]) {
        $_SESSION["winner"] = "Player 1";
        addToLeaderboard($_SESSION["user"], $_SESSION["rolls"]);
    }

    if ($_SESSION["p2"] >= 100 && !$_SESSION["winner"]) {
        $_SESSION["winner"] = "Player 2";
        addToLeaderboard($_SESSION["user"], $_SESSION["rolls"]);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Snakes & Ladders Game</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">

        <div class="top-bar">
            <h1>Snakes & Ladders</h1>
            <a href="logout.php" class="small-link">Logout</a>
        </div>

        <h3>Difficulty: <?php echo $_SESSION["difficulty"]; ?></h3>

        <div class="game-layout">

            <!-- board -->
            <div class="board">

            <?php for ($i = 100; $i >= 1; $i--): ?>
                <div class="cell">

                    <?php echo $i; ?>

                    <!-- tokens -->
                    <?php if ($_SESSION["p1"] == $i && $_SESSION["p2"] == $i): ?>
                        <div class="player p1 overlap"></div>
                        <div class="player p2 overlap"></div>

                    <?php elseif ($_SESSION["p1"] == $i): ?>
                        <div class="player p1"></div>

                    <?php elseif ($_SESSION["p2"] == $i): ?>
                        <div class="player p2"></div>
                    <?php endif; ?>

                    <!-- visual markers -->
                    <?php if (isset($config["snakes"][$i])): ?>
                        <div class="snake">Snake</div>
                    <?php endif; ?>

                    <?php if (isset($config["ladders"][$i])): ?>
                        <div class="ladder">Ladder</div>
                    <?php endif; ?>

                </div>
            <?php endfor; ?>

            </div>

            <!-- panel -->
            <div class="game-panel">
                <p>Turn: Player <?php echo $_SESSION["turn"]; ?></p>
                <p>Dice: <?php echo $dice; ?></p>
                <p>Rolls: <?php echo $_SESSION["rolls"]; ?></p>

                <p>P1: <?php echo $_SESSION["p1"]; ?></p>
                <p>P2: <?php echo $_SESSION["p2"]; ?></p>

                <?php if (!$_SESSION["winner"]): ?>
                    <form method="post">
                        <button type="submit">Roll Dice</button>
                    </form>
                <?php else: ?>
                    <h2><?php echo $_SESSION["winner"]; ?> Wins!</h2>

                    <div class="button-group">
                        <a href="start.php" class="btn-link">Play Again</a>
                        <a href="leaderboard.php" class="btn-link">Leaderboard</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>