<?php

$pdo = null;

function getConnection() {
    global $pdo;

    if (is_null($pdo)) {
        $pdo = new PDO('pgsql:host=127.0.0.1;port=5432;dbname=shop_db',
        'evgen', 'Ev240382', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
}

return $pdo;

}





