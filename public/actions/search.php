<?php
require_once __DIR__ . '/../../src/init.php';

function displaySearchedProduct($filter)
{
    /**
    * Function that creates a String display variable to display all the products searched for using an SQL query that retrieves the information.
    * Return: the $display variable, which contains HTML code in String format.
    */
    global $pdo;
    $select = $pdo->prepare('SELECT * FROM product WHERE name LIKE :name AND category LIKE :category');
    $select->execute([':name' => "%" . $_POST['search'] . "%", ':category' => "%". $filter . "%"]);
    $search_result = $select->fetchAll();
    $display = "";
    foreach ($search_result as $key) :
        $display .= '<p>';
        $display .=  '<a href="/product.php?product='.$key["id"].'"><b>'.$key['name'] .'</b> | Catégorie '.$key["category"] ." ". $key["price"] . '€ <br>' . $key["description"] . '<br>Stock disponible : '. $key["stock"] .'</a>';
        $display .= '</p>';
        $display .= '<br>';
    endforeach;
    return $display;
    
}

function displayAllProduct()
{
    /**
    * Function that creates a String display variable to display all the products searched for with a filter using an SQL query that retrieves the information.
    * Return: the $display variable, which contains HTML code in String format.
    */
    global $pdo;
    $select = $pdo->prepare('SELECT * FROM product');
    $select->execute();
    $info_login = $select->fetchAll();
    $display = "";
    foreach ($info_login as $key) :
        $display .= '<p>';
        $display .=  '<a href="/product.php?product='.$key["id"].'"><b>'.$key['name'] .'</b> | Catégorie '.$key["category"] ." ". $key["price"] . '€ <br>' . $key["description"] . '<br>Stock disponible : '. $key["stock"] .'</a>';
        $display .= '</p>';
        $display .= '<br>';
    endforeach;
    return $display;
}
?>