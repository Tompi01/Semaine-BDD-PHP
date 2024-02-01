<?php
require_once __DIR__ . '/../../src/init.php';

global $pdo;
$select = $pdo->prepare('DELETE FROM product WHERE id = :id');
$select->execute([':id' => $_GET['product']]);
header("Location: /index.php");
die();
?>