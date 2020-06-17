<?php
define("USERS_FILE", "/home/evgen/workspace/magazinDB/allUsers.json");
include "/controllers/edit-image.php";

function createUser($login, $password) {
    $uuid = randomID();
    $users = getUsers();
    $user = [
        "uuid" => $uuid,
        "login" => $login,
        "password" => password_hash($password, PASSWORD_BCRYPT),
        "active" => true,
        "right" => "user"
    ];
    $users[] = $user;
    file_put_contents(USERS_FILE, json_encode($users));
    return $user;
}

function deleteUser($uuid) {
    editUser($uuid, ["active" => false]);
}

function editUser($uuid, $attributes) {
    $users = array_map(function($user) use ($uuid, $attributes) {
        if ($user["uuid"] == $uuid) {
            return array_merge($user, $attributes);
        } else {
            return $user;
        }
    }, getUsers());

    file_put_contents(USERS_FILE, json_encode($users));
}

function getUser($uuid) {
    foreach (getUsers() as $user) {
        if ($user["uuid"] == $uuid) {
            return $user;
        }
    }
    
    return null;
}

function getUsers($limit = PHP_INT_MAX, $page = 0)  {
    if (file_exists(USERS_FILE)) {
        $result = json_decode(file_get_contents(USERS_FILE), true);
        $result = array_slice($result, $page * $limit, $limit);
        return $result;
        
    } else {
        throw new Exception("User file not found");
    }
}
