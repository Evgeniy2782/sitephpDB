<?php   
include "models/users-model-db.php";

function usersAddress($page, $limit) {
    return "/users?".http_build_query(["page" => $page, "limit" => $limit]);
}

if ($requestUri == "/users") {
    $scriptAssets = ["/assets/js/usersView.js"];

  $page = filter_var($_GET['page'] ?? 1, FILTER_VALIDATE_INT);
  $limit = filter_var($_GET['limit'] ?? 6 , FILTER_VALIDATE_INT);
  $url = "/api/users";
  $urlProfile = "/profile/";

    $handleRequest = function() use ($url, $urlProfile, $page, $limit) {
    include "templates/usersView.php";
    };

  include "header.php";
    die();
}
                     
function profileEdit($user) {
    $handleRequest = function() use($user){
    include "profile.php";
    };

    include "header.php";
    die();
}

function registrationCreate() {
    $scriptAssets = ["/assets/js/registration-user.js"];                       

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
    $userId = $path[2];
    $user = getUser($userId);

    if (is_null($user)) {
        http_response_code(404);
        die();
    }
    profileEdit($user);
}

if ($requestUri == "/api/users") {
    header('Content-Type: application/json');

    if ($requestMethod == "GET") {
        $limit = filter_var($_GET["limit"], FILTER_VALIDATE_INT);
        $page = filter_var($_GET["page"], FILTER_VALIDATE_INT);

        echo json_encode(getUsers($limit, $page));
     
        die();
    }

    if ($requestMethod == "POST") {
        $login = filter_var($_POST['login'] ,FILTER_SANITIZE_STRING);
        $password = filter_var($_POST['passwordOne'] ,FILTER_SANITIZE_STRING);
                    
        echo json_encode(createUser($login, $password));
        
        die();
    }
}

if (startsWith($requestUri, "/api/users/")) {
    header('Content-Type: application/json');

    $path = explode("/", $requestUri);
    $userId = filter_var($path[count($path) - 1], FILTER_VALIDATE_INT);
    $user = getUser($userId);

    if (is_null($user)) {
        http_response_code(404);
        die();
    }

    if ($requestMethod == "GET") {
        echo json_encode(getUser($userId));
        die();
    }

    if ($requestMethod == "POST") {
        $login = filter_var($_POST['login'] ,FILTER_SANITIZE_STRING);
        $password = filter_var($_POST['password'] ,FILTER_SANITIZE_STRING);
        $isActive = filter_var($_POST['active'] ,FILTER_SANITIZE_STRING);

        $attributes = [];

        if (!$_FILES["picture"]["error"] == UPLOAD_ERR_NO_FILE) {
            $folder = '/home/evgen/workspace/magazinDB/uploadsUsers';
            $file_path = upload_image($_FILES["picture"], $folder);
            $file_path_exploded = explode("/", $file_path);
            $filename = $file_path_exploded[count($file_path_exploded) - 1];
            $file_url = "http://178.72.90.83:8000/uploadsUsers/".$filename;
            $attributes["image"] = $file_url;
        }

        if (!empty($login)) {
            $attributes["login"] = $login;
        }

        if (!empty($password)) {
            $attributes["password"] = password_hash($password, PASSWORD_BCRYPT);
        }

        
        if (!empty($isActive)) {
            $attributes["active"] = $isActive = true;
        }else{
            $attributes["active"] = $isActive = false;
        }

        editUser($user, $attributes);
        die();
    }

    if ($requestMethod == "DELETE") {
        deleteUser($userUuid);
        die();
    }
}
