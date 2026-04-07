<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard | Adventures of the Dice</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Adventures of the Dice</h1>
        <h2>Leaderboard</h2>

        <table>
            <tr>
                <th>Rank</th>
                <th>Username</th>
                <th>Score</th>
            </tr>
            <tr>
                <td>1</td>
                <td>Player1</td>
                <td>100</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Player2</td>
                <td>80</td>
            </tr>
        </table>

        <div class="button-group">
            <a href="start.php" class="btn-link">Back to Start</a>
            <a href="game.php" class="btn-link">Back to Game</a>
        </div>
    </div>
</body>
</html>