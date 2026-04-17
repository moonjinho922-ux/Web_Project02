<?php
session_start();
require_once "functions.php";

$board = loadLeaderboard();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Leaderboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Leaderboard</h1>
        <table>
            <tr>
                <th>Rank</th>
                <th>Username</th>
                <th>Rolls</th>
                <th>Result</th>
            </tr>

            <?php if (empty($board)): ?>
                <tr><td colspan="4">No scores yet</td></tr>
            <?php else: ?>
                <?php $rank = 1; ?>
                <?php foreach ($board as $player): ?>
                    <tr>
                        <td><?php echo $rank++; ?></td>
                        <td><?php echo htmlspecialchars($player["username"]); ?></td>
                        <td><?php echo $player["rolls"]; ?></td>
                        <td><?php echo $player["result"]; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </table>

        <div class="button-group">
            <a href="start.php" class="btn-link">Play Again</a>
            <a href="game.php" class="btn-link">Back to Game</a>
        </div>
    </div>
</body>
</html>