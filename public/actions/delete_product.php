<?php
require_once __DIR__ . '/../../src/init.php';

// Redirects the user to the home page if he doesn't have the get method.
if (!isset($_GET['product'])) {
    header("Location: /index.php");
    die();
}

// SQL query that deletes a product with a get method
global $pdo;
$select = $pdo->prepare('DELETE FROM product WHERE id = :id');
$select->execute([':id' => $_GET['product']]);
header("Location: /index.php");
die();
?>