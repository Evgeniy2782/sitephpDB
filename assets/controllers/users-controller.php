<?php


if ($requestUri == "/users") {
    $scriptAssets = ["/assets/js/usersView.js"];

    $handleRequest = function() {
        echo "
    <a href=\"/users/create\" class=\"btn btn-success\">Create new User</a>
    <div id='users-list'></div>";
    };

    include "layout.php";
    die();
}

function profileEdit($user) {
    $scriptAssets = ["/assets/js/edite-profile.js"];
    $handleRequest = function() use($user){
    include "profile.php";
    };

    include "header.php";
    die();
}

function registrationCreate() {
    $scriptAssets = ["/assets/js/registration-user.js"];                        
   // $user = ["active" => true];
   // $user = ["right" => "user"];

    $handleRequest = function() use($user){
        include "registration.php";
        };

        include "header.php";
        die();
}

if($requestUri == "/registration"){
    registrationCreate();
 }

if (startsWith($requestUri, "/profile/")) {
    $path = explode("/", $requestUri);
    $userUuid = $path[2];
    $user = getUser($userUuid);

    if (is_null($user)) {
        http_response_code(404);
        die();
    }
    profileEdit($user);
}

if ($requestUri == "/api/users") {
    header('Content-Type: application/json');

    if ($requestMethod == "POST") {
        $login = filter_var($_POST['login'] ,FILTER_SANITIZE_STRING);
        $password = filter_var($_POST['password'] ,FILTER_SANITIZE_STRING);
        $password = password_hash($password, PASSWORD_BCRYPT);
        echo json_encode(createUser($login, $password));
        die();
    }
    if ($requestMethod == "GET") {
        echo json_encode(getUsers());
        die();
    }
}

if (startsWith($requestUri, "/api/users/")) {
   header('Content-Type: application/json');

    $path = explode("/", $requestUri);
    $userUuid = $path[count($path) - 1];
    $user = getUser($userUuid);
 
    if (is_null($user)) {
        http_response_code(404);
        die();
    }

    if ($requestMethod == "GET") {
        echo json_encode(getUser($userUuid));
        die();
    }

    if ($requestMethod == "POST") {
        $login = filter_var($_POST['login'] ,FILTER_SANITIZE_STRING);
        $password = filter_var($_POST['password'] ,FILTER_SANITIZE_STRING);
        $isActive = filter_var($_POST['active'] ,FILTER_SANITIZE_STRING);

        $attributes = [];

        if (!empty($login)) {
            $attributes["login"] = $login;
        }

        if (!empty($password)) {
            $attributes["password"] = password_hash($password, PASSWORD_BCRYPT);
        }

        if (!empty($isActive)) {
            $attributes["active"] = $isActive == 'true';
        }

        editUser($userUuid, $attributes);
        die();
    }

    if ($requestMethod == "DELETE") {
        deleteUser($userUuid);
        die();
    }
}