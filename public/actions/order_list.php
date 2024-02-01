<?php
require_once __DIR__ . '/../../src/init.php';

function get_user_orders()
{
    global $pdo;
    
    $i = 0 ;
    $select = $pdo->prepare('SELECT * FROM orders
        INNER JOIN composition ON orders.id = composition.id_order
        INNER  JOIN product ON product.id = composition.id_product
        WHERE id_user = :id');
    $select->execute([":id" => $_SESSION["user_id"]]);
    $info_orders = $select->fetchAll();
    //var_dump($info_product);
    return $info_orders ;
    
}
?>