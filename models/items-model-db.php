<?php

include 'db.php';

function addCart($userId, $itemId) {

    $pdo = getConnection();
                          
    $statement = $pdo->prepare("insert into cart(user_id, item_id) values (?, ?) returning *");

     $statement->execute([$userId, $itemId]);
          return $statement->fetch();
}

function deleteCart($userId, $itemId) {

    $pdo = getConnection();

    $statement = $pdo->prepare("delete from cart WHERE user_id = ? and item_id = ? returning *");

     $statement->execute([$userId, $itemId]);
          return $statement->fetch();
}

function allItemToCartUser($userId) {

    $pdo = getConnection();
                       
    $statement = $pdo->prepare("select items.id_item, cart.quantity, items.item, items.description, items.price, items.active, items.image from cart, items where cart.user_id = ? and cart.item_id = items.id_item;");

     $statement->execute([$userId]);
          return $statement->fetchAll();
}

function itemQuantity($userId, $itemId){
    $pdo = getConnection();

    $statement = $pdo->prepare("select cart.quantity from cart where cart.user_id = ? and cart.item_id = ?");

     $statement->execute([$userId, $itemId]);
          return $statement->fetchAll();
};
function itemPlus($userId, $itemId) {
    
    $pdo = getConnection();
    
    $statement = $pdo->prepare("update cart set quantity = quantity+1 where cart.user_id = ? and cart.item_id = ?");

    $statement->execute([$userId, $itemId]);
    return $statement->fetchAll();
}


function createItem($item, $description, $price, $image) {

    $pdo = getConnection();
                                           
    $statement = $pdo->prepare("insert into items (item, description, price, image) values (?, ?, ?, ?) returning *");

     $statement->execute([$item, $description, $price, $image]);
          return $statement->fetch();

}

function deleteItem($id) {
    editItem($id, ["active" => false]);
}

function editItem($item, $attributes) {
    
    $pdo = getConnection();
    $newItem = array_merge($item, $attributes);

    $statement = $pdo->prepare("update items set item = ?, description = ?, price = ?, active = ?, image = ? where id_item = ?");
    $newItem['active'] = $newItem['active'] ? 'true' : 'false';

    try {
        $statement->execute([$newItem['item'], $newItem['description'], $newItem['price'], $newItem['active'], $newItem['image'], $item['id_item']]);
    } catch (PDOException $exception) {
        if ($exception->errorInfo[0] === 23505)
            throw new InvalidArgumentException("error");
        throw $exception;
    }
}

function getItem($id) {
    $pdo = getConnection();
    $statement = $pdo->prepare("select * from items where id_item = ?");
    $statement->execute([$id]);
    return $statement->fetch();
}

function getItems($limit = PHP_INT_MAX, $page = 0)  {
    $pdo = getConnection();
    $statement = $pdo->prepare("select * from items limit ? offset ?");
    $statement->execute([$limit, $page * $limit]);
    return $statement->fetchAll();
}

function findItem($item) {
    $pdo = getConnection();
    $result = $pdo->query("select * from items where item = '$item'");
    $item = $result->fetch();

    if ($item === false)
        return null;
    else
        return $item;
}