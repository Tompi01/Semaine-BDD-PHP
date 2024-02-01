<?php
require_once __DIR__ . '/../../src/init.php';


function get_product_infos()
{
    global $pdo;
    $select = $pdo->prepare('SELECT * FROM product
        LEFT JOIN commentaries on product.id = commentaries.id_product 
        LEFT JOIN users on commentaries.id_user = users.id 
        WHERE product.id = :id');
    $select->execute([":id" => $_GET["product"]]);
    $info_product = $select->fetchAll();
    //var_dump($info_product);
    return $info_product;
}
