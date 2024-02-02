<?php
require_once __DIR__ . '/../../src/init.php';

// Redirects the user to the home page if he doesn't have the get method.
if (isset($_SESSION["user_id"])) {
    header("Location: /index.php");
    die();
}

function get_display_lapanier()
{
    /**
    * Function that retrieves all basket information
    * Return: the $display_lapanier variable, which contains cart informations.
    */

    global $pdo;
    $select = $pdo->prepare('SELECT * FROM cart
    INNER JOIN product ON product.id = cart.id_product
    WHERE id_user = :id_user');
    $select->execute([":id_user" => $_SESSION['user_id']]);
    $display_lapanier = $select->fetchAll();
    return $display_lapanier;
}
