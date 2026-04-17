<?php
// Load users
function loadUsers() {
    $file = __DIR__ . "/users.json";

    if (!file_exists($file)) {
        // create as object (important)
        file_put_contents($file, json_encode(new stdClass()));
    }

    return json_decode(file_get_contents($file), true);
}

// Save users
function saveUsers($users) {
    $file = __DIR__ . "/users.json";
    file_put_contents($file, json_encode($users, JSON_PRETTY_PRINT));
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
        $_SESSION["user"] = $username;
        return true;
    }

    return false;
}

// Game Logic
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
    $_SESSION["start_time"] = time();
    $_SESSION["rolls"] = 0;
    $_SESSION["last_event"] = "";
    $_SESSION["events_log"] = [];
}

// Load leaderboard
function loadLeaderboard() {
    $file = __DIR__ . "/leaderboard.json";

    if (!file_exists($file)) {
        file_put_contents($file, json_encode([]));
    }

    return json_decode(file_get_contents($file), true);
}

// Save leaderboard
function saveLeaderboard($data) {
    $file = __DIR__ . "/leaderboard.json";
    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
}

// Add winner
function addToLeaderboard($username, $rolls) {
    $board = loadLeaderboard();

    $board[] = [
        "username" => $username,
        "rolls" => $rolls,
        "result" => "win"
    ];

    // sort fewest rolls first
    usort($board, function($a, $b) {
        return $a["rolls"] - $b["rolls"];
    });

    saveLeaderboard($board);
}

// Event cells
function getEventCells() {
    return [
        15 => ["type" => "bonus", "move" => 5,  "msg" => "Found a shortcut!"],
        30 => ["type" => "penalty", "move" => -4, "msg" => "Lost your map!"],
        42 => ["type" => "warp",  "move" => 8,  "msg" => "Magic portal!"],
        58 => ["type" => "bonus", "move" => 3,  "msg" => "Tailwind boost!"],
        75 => ["type" => "penalty", "move" => -6, "msg" => "Caught in a trap!"]
    ];
}

// Apply event to position
function applyEvent($event) {
    if ($_SESSION["turn"] == 2) {
        $_SESSION["p1"] += $event["move"];
    } else {
        $_SESSION["p2"] += $event["move"];
    }
}

// Return a story message for the event
function narrateEvent($event, $playerName, $cell) {
    if ($event["type"] == "bonus") {
        return "$playerName landed on cell $cell - " . $event["msg"] . " Move forward " . $event["move"] . "!";
    }
    if ($event["type"] == "penalty") {
        return "$playerName landed on cell $cell - " . $event["msg"] . " Move back " . abs($event["move"]) . "!";
    }
    if ($event["type"] == "warp") {
        return "$playerName landed on cell $cell - " . $event["msg"] . " Warped forward " . $event["move"] . "!";
    }
    return "$playerName landed on cell $cell - " . $event["msg"];
}

// Snakes and Ladders
function getBoardConfig($difficulty) {
    // easy
    if ($difficulty == "easy") {
        return [
            "snakes" => [
                17 => 7,
                54 => 34,
                62 => 19
            ],
            "ladders" => [
                3 => 22,
                11 => 26,
                20 => 38
            ]
        ];
    }

    // medium
    if ($difficulty == "medium") {
        return [
            "snakes" => [
                17 => 7,
                54 => 34,
                62 => 19,
                87 => 24,
                95 => 56
            ],
            "ladders" => [
                3 => 22,
                11 => 26,
                20 => 38,
                28 => 55,
                40 => 59
            ]
        ];
    }

    // hard
    return [
        "snakes" => [
            17 => 7,
            54 => 34,
            62 => 19,
            87 => 24,
            95 => 56,
            99 => 78,
            73 => 52,
            48 => 9,
            66 => 45
        ],
        "ladders" => [
            3 => 22,
            11 => 26,
            20 => 38,
            28 => 55,
            40 => 59,
            50 => 72,
            64 => 83,
            70 => 91,
            80 => 98
        ]
    ];
}
?>