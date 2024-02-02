<?php
require_once __DIR__ . '/../../src/init.php';

if (!isset($_GET['product'])) {
    echo "eco prout";
    header('Location: /product.php?' . $_GET['product']); // redirige utilisateur
    die(); // stop execution du script
}
$select = $pdo->prepare('INSERT INTO cart(id_user, id_product,product_number) VALUES (:id_user, :id_product, :product_number)');
$select->execute([':id_user' => $_SESSION['user_id'], ':id_product' => $_GET["product"], ':product_number' => $_POST['number']]);
header('Location: /index.php?' . $_GET['product']); // redirige utilisateur
die();
