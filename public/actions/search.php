<?php
require_once __DIR__ . '/../../src/init.php';

function displaySearchedProduct($filter)
{
    global $pdo;
    $select = $pdo->prepare('SELECT * FROM product WHERE name LIKE :name AND category LIKE :category');
    $select->execute([':name' => "%" . $_POST['search'] . "%", ':category' => "%". $filter . "%"]);
    $search_result = $select->fetchAll();
    $display = "";
    foreach ($search_result as $key) :
        $display .= '<p>';
        $display .= $key['name'] .'| Categorie: '.$key["category"] ." ". $key["price"] . '€ <br>' . $key["description"] . '<br>Stock disponible : '. $key["stock"];
        $display .= '</p>';
        $display .= '<br>';
    endforeach;
    return $display;
    
}

function displayAllProduct()
{
    global $pdo;
    $select = $pdo->prepare('SELECT * FROM product');
    $select->execute();
    $info_login = $select->fetchAll();
    $display = "";
    foreach ($info_login as $key) :
        $display .= '<p>';
        $display .=  $key['name'] .'| Categorie:'.$key["category"] ." ". $key["price"] . '€ <br>' . $key["description"] . '<br>Stock disponible : '. $key["stock"];
        $display .= '</p>';
        $display .= '<br>';
    endforeach;
    return $display;
}
?>