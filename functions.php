<?php
// testing phase - hard code
$users = [
    "player1" => password_hash("123", PASSWORD_DEFAULT),
    "player2" => password_hash("456", PASSWORD_DEFAULT),
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