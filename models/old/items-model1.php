<?php
define("ITEMS_FILE", "/home/evgen/workspace/magazinDB/allItem.json");

function createItem($item, $file_path_json) {
    $items = getCommon($file_path_json);

    $items[] = $item;
   
    file_put_contents($file_path_json, json_encode($items));
    return $item;
}

function getCommon($file_path_json)  {
    if (file_exists($file_path_json)) {
        $result = file_get_contents($file_path_json);
       
        return json_decode($result, true);
    } else {
        throw new Exception("User file not found");
    }
}

function deleteItem($uuid) {
    editItem($uuid, ["active" => false]);
}

function deleteBasket($file_path_json, $uuid) {
    $items = getCommon($file_path_json);

     for($i = 0; $i < sizeof($items); $i++){
           if($items[$i] == $uuid[0]){
            unset($items[$i]);
        
            sort($items);
            var_dump("Удалено");
           }
       }

       file_put_contents($file_path_json, json_encode($items));
}

function editItem($uuid, $attributes) {
    $items = array_map(function($item) use ($uuid, $attributes) {
        if ($item["uuid"] == $uuid) {
            return array_merge($item, $attributes);
        } else {
            return $item;
        }
    }, getItems());

    file_put_contents(ITEMS_FILE, json_encode($items));
}

function getItem($uuid) {
    foreach (getItems() as $item) {
        if ($item["uuid"] == $uuid) {
            return $item;
        }
    }
    
    return null;
}

function getItems($limit = PHP_INT_MAX, $page = 0)  {
    if (file_exists(ITEMS_FILE)) {
        $result = json_decode(file_get_contents(ITEMS_FILE), true);
        $result = array_slice($result, $page * $limit, $limit);
        return $result;
        
    } else {
        throw new Exception("User file not found");
    }
}
