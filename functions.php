<?php
// testing phase - isn't finalized
$users = [
    "player1" => password_hash("pass123", PASSWORD_DEFAULT),
    "player2" => password_hash("pass456", PASSWORD_DEFAULT),
];

function getUserByUsername($username) {
    global $users;
    if (isset($users[$username])) {
        return [
            'username' => $username,
            'password' => $users[$username]
        ];
    }
    return false;
}