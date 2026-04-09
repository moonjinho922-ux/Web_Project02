<?php
// testing phase - hard code
$users = [
    "test1" => password_hash("123", PASSWORD_DEFAULT),
    "test2" => password_hash("456", PASSWORD_DEFAULT),
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