<?php
require_once __DIR__ . '/../../src/init.php';

$select = $pdo->prepare('SELECT * FROM cart
        INNER JOIN product ON cart.id_product = product.id
        WHERE cart.id_user = :id_user');
$select->execute([':id_user' => $_SESSION['user_id']]);
$command_validation = $select->fetchAll();

foreach ($command_validation as $composition) :
    $insert1 = $pdo->prepare('INSERT INTO composition(id_product,quantity) VALUES(?,?)');
    $insert1->execute([$command_validation[$i]['id_product'], $command_validation[$i]['product_number']]);

    $update1= 
    $i++;
endforeach;
