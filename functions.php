<?php
// Load all users from users.json
function loadUsers() {
    if (!file_exists("users.json")) {
        file_put_contents("users.json", json_encode([], JSON_PRETTY_PRINT));
    }
    $data = json_decode(file_get_contents("users.json"), true);
    return is_array($data) ? $data : [];
}

function saveUsers($users) {
    file_put_contents("users.json", json_encode($users, JSON_PRETTY_PRINT));
}

// Find a user by username
function getUserByUsername($username) {
    $users = loadUsers();
    foreach ($users as $user) {
        if ($user["username"] === $username) {
            return $user;
        }
    }
    return false;
}

// Register user
function registerUser($username, $password) {
    $username = trim($username);

    if (getUserByUsername($username)) {
        return "Username already exists!";
    }

    $users = loadUsers();
    $users[] = [
        "username" => $username,
        "password" => password_hash($password, PASSWORD_DEFAULT)
    ];
    saveUsers($users);

    return true;
}

// Login user
function loginUser($username, $password) {
    $user = getUserByUsername(trim($username));

    if (!$user) {
        return false;
    }

    if (password_verify($password, $user["password"])) {
        $_SESSION["username"] = $user["username"];
        return true;
    }

    return false;
}

// Roll dice
function rollDice() {
    return rand(1, 6);
}

// Snakes by difficulty: key = head (where you land), value = tail (where you slide to)
function getSnakesByDifficulty($difficulty) {
    if ($difficulty === "easy") {
        return [17 => 7, 54 => 34];
    } elseif ($difficulty === "hard") {
        return [17 => 7, 54 => 34, 62 => 19, 64 => 60, 87 => 24, 93 => 73, 95 => 75, 99 => 78];
    } else { // medium
        return [17 => 7, 54 => 34, 62 => 19, 64 => 60, 87 => 24];
    }
}

// Ladders by difficulty: key = bottom (where you land), value = top (where you climb to)
function getLaddersByDifficulty($difficulty) {
    if ($difficulty === "easy") {
        return [4 => 14, 9 => 31, 20 => 38, 28 => 84, 40 => 59, 51 => 67, 63 => 81, 71 => 91];
    } elseif ($difficulty === "hard") {
        return [4 => 14, 9 => 31];
    } else { // medium
        return [4 => 14, 9 => 31, 20 => 38, 28 => 84, 40 => 59];
    }
}

// Initialize game
function initGame($difficulty) {
    $_SESSION["p1"] = 0;
    $_SESSION["p2"] = 0;
    $_SESSION["turn"] = 1;
    $_SESSION["difficulty"] = $difficulty;
    $_SESSION["winner"] = null;
    $_SESSION["history"] = [];
}

// Load leaderboard
function loadLeaderboard() {
    if (!file_exists("leaderboard.json")) {
        file_put_contents("leaderboard.json", json_encode([]));
    }
    return json_decode(file_get_contents("leaderboard.json"), true);
}

// Save leaderboard
function saveLeaderboard($data) {
    file_put_contents("leaderboard.json", json_encode($data, JSON_PRETTY_PRINT));
}

// Add winner to leaderboard
function addToLeaderboard($username, $score) {
    $board = loadLeaderboard();

    $board[] = [
        "username" => $username,
        "score" => $score
    ];

    // sort highest score first
    usort($board, function($a, $b) {
        return $b["score"] - $a["score"];
    });

    saveLeaderboard($board);
}


?>


