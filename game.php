<?php
session_start();
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