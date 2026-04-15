<?php
// Simple database using JSON file
function loadUsers() {
    if (!file_exists("users.json")) {
        file_put_contents("users.json", json_encode([]));
    }
    return json_decode(file_get_contents("users.json"), true);
}

function saveUsers($users) {
    file_put_contents("users.json", json_encode($users, JSON_PRETTY_PRINT));
}

// Register user
function registerUser($username, $password) {
    $users = loadUsers();

    if (isset($users[$username])) {
        return "Username already exists!";
    }

    $users[$username] = password_hash($password, PASSWORD_DEFAULT);
    saveUsers($users);

    return true;
}

// Login user
function loginUser($username, $password) {
    $users = loadUsers();

    if (!isset($users[$username])) {
        return false;
    }

    if (password_verify($password, $users[$username])) {
        $_SESSION["username"] = $username;
        return true;
    }

    return false;
}

// Roll dice
function rollDice() {
    return rand(1, 6);
}

// Initialize game
function initGame($difficulty) {
    $_SESSION["p1"] = 0;
    $_SESSION["p2"] = 0;
    $_SESSION["turn"] = 1;
    $_SESSION["difficulty"] = $difficulty;
    $_SESSION["winner"] = null;
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


