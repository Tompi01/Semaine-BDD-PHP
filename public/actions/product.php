<?php
require_once __DIR__ . '/../../src/init.php';


function get_product_infos()
{
    /**
    * Function that performs an SQL query to retrieve all the information about the selected product and its associated comments.
    * Return: the $info_product variable, which contains HTML code in String format.
    */
    global $pdo;
    $select = $pdo->prepare('SELECT * FROM product
        LEFT JOIN commentaries on product.id = commentaries.id_product 
        LEFT JOIN users on commentaries.id_user = users.id 
        WHERE product.id = :id');
    $select->execute([":id" => $_GET["product"]]);
    $info_product = $select->fetchAll();
    return $info_product;
}
