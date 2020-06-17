<?php

session_start();

$requestUri = $_SERVER["REQUEST_URI"];
$requestUri = explode("?", $requestUri);
$query_params = $requestUri[1];
$_GET = [];
parse_str($query_params, $_GET);
$requestUri = $requestUri[0];
$requestMethod = $_SERVER["REQUEST_METHOD"];
$scriptAssets = [];

$errors = array();

include "controllers/item-controller.php";
include "controllers/users-controller.php";   
      
if (is_null($_SESSION["currentUser"]) && $requestUri != '/login' && $requestUri != '/auth' && $requestUri != '/profile') {
    header("Location: /login");
    die();
}

if ($requestUri == "/cart"){

   $scriptAssets = ["/assets/js/cart.js"];
   $handleRequest = function(){

    include 'cart.php';
    };
    include "header.php";

    die();
}

if ($requestUri == "/logout"){
    session_destroy();
    header("Location: /");
    die();
}

if ($requestUri == "/users/list"){
    echo json_encode(getUsers());
    die();
    }

if ($requestUri == "/login"){
    include "login.html";
    die();
    }

if ($requestUri == "/"){
    $scriptAssets = ["/assets/js/allItem.js"];
    $page = filter_var($_GET['page'] ?? 1, FILTER_VALIDATE_INT);
    $limit = filter_var($_GET['limit'] ?? 6 , FILTER_VALIDATE_INT);
    $url = "/api/items";

    $handleRequest = function() use ($url, $page, $limit) {
    
      include "templates/usersView.php";
      };
  
      include "header.php";
      die();
    }

if($requestUri == "/auth"){
$login = filter_var($_POST['login'], FILTER_SANITIZE_STRING);
$pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);

    $user = findUser($login);
    
if($user['active'] && $user['login'] == $login && password_verify($pass, $user['password'])){
             $currentUsers = $user['login'];
             $_SESSION["currentUser"] = $user;
}

if($user['active'] == false){
    $_SESSION['error_Authorization'] = "Учетаная запись отключена!";
    header("Location: /logout");
    die();
 }   

if(is_null($currentUsers)){
    $_SESSION['error_Authorization'] = "Неверный логин или пароль!";
    header("Location: /logout");
    die();
 }

 header("Location: /");
 die();
 
  }
http_response_code(404);
die();
?>
