<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Start Game | Adventures of the Dice</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container center-box">
        <h1>Adventures of the Dice</h1>
        <h2>Start Game</h2>

        <form action="#" method="post">
            <label for="difficulty">Choose Difficulty</label>
            <select id="difficulty" name="difficulty">
                <option value="easy">Easy</option>
                <option value="medium">Medium</option>
                <option value="hard">Hard</option>
            </select>

            <button type="submit">Start</button>
        </form>

        <div class="button-group">
            <a href="game.php" class="btn-link">Go to Game</a>
            <a href="leaderboard.php" class="btn-link">View Leaderboard</a>
            <a href="logout.php" class="btn-link">Logout</a>
        </div>
    </div>
</body>
</html>