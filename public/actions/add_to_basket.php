<?php
require_once __DIR__ . '/../../src/init.php';


// Redirects the user to the home page if he doesn't have the get method.
if (!isset($_SESSION["user_id"])) {
    $_SESSION['error_message'] = "Vous n'êtes pas connectés";
    header("Location: /index.php");
    die();
}
// Redirects the user to the home page if he doesn't have the get method.

if (!isset($_GET['product'])) {
    header('Location: /product.php?' . $_GET['product']);
    die();
}

// Insert the product into the shopping cart using an SQL query

$select = $pdo->prepare('INSERT INTO cart(id_user, id_product,product_number) VALUES (:id_user, :id_product, :product_number)');
$select->execute([':id_user' => $_SESSION['user_id'], ':id_product' => $_GET["product"], ':product_number' => $_POST['number']]);
header('Location: /index.php?' . $_GET['product']); // redirige utilisateur
die();
