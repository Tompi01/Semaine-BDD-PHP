<?php
require_once __DIR__ . '/../../src/init.php';


function get_display_lapanier()
{
    global $pdo;
    $select = $pdo->prepare('SELECT * FROM cart
    INNER JOIN product ON product.id = cart.id_product
    WHERE id_user = :id_user');
    $select->execute([":id_user" => $_SESSION['user_id']]);
    $display_lapanier = $select->fetchAll();
    return $display_lapanier;
}
