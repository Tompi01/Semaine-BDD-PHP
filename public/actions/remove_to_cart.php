<?php
require_once __DIR__ . '/../../src/init.php';

// Redirects the user to the home page if he doesn't have the get method.
if (!isset($_SESSION["user_id"])) {
    header("Location: /index.php");
    die();
}

// Redirects the user to the home page if he doesn't have the get method.
if (!isset($_GET['product'])) {
    header('Location: /product.php?' . $_GET['product']);
    die();
}

// Delete the product in the cart into the shopping cart using an SQL query
global $pdo;
$select2 = $pdo->prepare('DELETE FROM cart
                    WHERE id_user = :id_user AND id_product = :id_product');
$select2->execute([':id_user' => $_SESSION['user_id'], ':id_product' => $_GET["product"]]);
header('Location: /lapanier.php');
die();
