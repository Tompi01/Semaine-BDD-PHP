<?php
require_once __DIR__ . '/../../src/init.php';

var_dump($_GET['product']);
if (!isset($_GET['product'])) {
    echo "eco prout";
    header('Location: /product.php?' . $_GET['product']); // redirige utilisateur
    die(); // stop execution du script
}

echo "eco prout +";
global $pdo;
$select = $pdo->prepare('INSERT INTO cart(id_user, id_product,product_number) VALUES (:id_user, :id_product, :product_number)');
$select->execute([':id_user' => $_SESSION['user_id'], ':id_product' => $_GET["product"], ':product_number' => $_POST['number']]);
die();
