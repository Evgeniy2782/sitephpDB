<?php

include "models/items-model-db.php";
include "util.php";
include "edit-image.php";

$pathFile = "/home/evgen/workspace/magazinDB/uploadsItems";
$file_urlImage = "http://178.72.90.83:8000/uploadsItems/";

if($requestUri == "/addItem"){
    $handleRequest = function() use($user){
    include "addItem.php";
        };

    include "header.php";
    die();
 }

if ($requestUri == "/itemsEdit") {

    $scriptAssets = ["/assets/js/usersView.js"];

  $page = filter_var($_GET['page'] ?? 1, FILTER_VALIDATE_INT);
  $limit = filter_var($_GET['limit'] ?? 6 , FILTER_VALIDATE_INT);
  $url = "/api/items";
  $urlProfile = "/profileItem/";

    $handleRequest = function() use ($url, $urlProfile ,$page, $limit) {
    include "templates/usersView.php";
    };

    include "header.php";
    die();
}

function profileItemEdit($item) {
    $handleRequest = function() use($item){
    include "profileItem.php";
    };

    include "header.php";
    die();
}

if (startsWith($requestUri, "/profileItem/")) {
    $path = explode("/", $requestUri);
    $itemId = filter_var($path[count($path) - 1], FILTER_VALIDATE_INT);
    $item = getItem($itemId);

    if (is_null($item)) {
       http_response_code(404);

        die();
    }
    profileItemEdit($item);
}

if (startsWith($requestUri, "/api/cart/")) {
    header('Content-Type: application/json');
    
    $path = explode("/", $requestUri);
    $itemId = filter_var($path[count($path) - 1], FILTER_VALIDATE_INT);
    $userId = $_SESSION["currentUser"]['id_user'];
    

    if (is_null($itemId)) {
        http_response_code(404);
        die();
    }

    if ($requestMethod == "GET") {
        $limit = filter_var($_GET["limit"], FILTER_VALIDATE_INT);
        $page = filter_var($_GET["page"], FILTER_VALIDATE_INT);
       
        echo json_encode(allItemToCartUser($userId));
        die();
      }  

    if ($requestMethod == "POST") {
        $quantity = itemQuantity($userId, $itemId);

        if(empty($quantity)){
            addCart($userId, $itemId);
            die();
        }
        
        if(!empty($quantity)){
            itemPlus($userId, $itemId);
            die();

            }
      
    }

    if ($requestMethod == "DELETE") {
      deleteCart($userId, $itemId);
      die();
      }
    }

if ($requestUri == "/api/items") {
    header('Content-Type: application/json');

    if ($requestMethod == "GET") {
        $limit = filter_var($_GET["limit"], FILTER_VALIDATE_INT);
        $page = filter_var($_GET["page"], FILTER_VALIDATE_INT);

        echo json_encode(getItems($limit, $page));
      die();
    }

    if ($requestMethod == "POST") {
        $name = filter_var($_POST['item'] ,FILTER_SANITIZE_STRING);
        $description = filter_var($_POST['description'] ,FILTER_SANITIZE_STRING);
        $price = filter_var($_POST['price'] ,FILTER_SANITIZE_STRING);

    if (!empty($_FILES)) {
       $image = editImage($pathFile, $file_urlImage);
    }
          
     createItem($name, $description, $price, $image);
        die();
    }
}

if (startsWith($requestUri, "/api/items/")) {
    header('Content-Type: application/json');

    $path = explode("/", $requestUri);
    $itemId = filter_var($path[count($path) - 1], FILTER_VALIDATE_INT);
    $itemName = getItem($itemId);

    if (is_null($itemName)) {
        http_response_code(404);
        die();
    }

    if ($requestMethod == "GET") {
        echo json_encode(getItem($itemId));
        die();
    }

    if ($requestMethod == "POST") {
        $item = filter_var($_POST['item'] ,FILTER_SANITIZE_STRING);
        $description = filter_var($_POST['description'] ,FILTER_SANITIZE_STRING);
        $price = filter_var($_POST['price'] ,FILTER_SANITIZE_STRING);
        $isActive = filter_var($_POST['active'] ,FILTER_SANITIZE_STRING);
      
        $attributes = [];
  
    if (!empty($_FILES)) {
        $attributes['image'] = editImage($pathFile, $file_urlImage);
    }

    if (!empty($item)) {
        $attributes["item"] = $item;
    }

    if (!empty($description)) {
        $attributes["description"] = $description;
    }

    if (!empty($price)) {
        $attributes["price"] = $price;
    }

    if (!empty($isActive)) {
        $attributes["active"] = $isActive = true;
    }else{
        $attributes["active"] = $isActive = false;
    }
   
    $newItem = array_merge($itemName, $attributes);
 var_dump($newItem);

    editItem($itemName, $attributes);
    die();

}
    if ($requestMethod == "DELETE") {
     deleteItem($itemId);
    die();

       }
    }



    