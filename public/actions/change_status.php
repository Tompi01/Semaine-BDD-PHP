<?php
    require_once __DIR__ . '/../../src/init.php';

// Redirects the user to the home page if he doesn't have the get method.
if (!isset($_POST['status'])) {
    header('Location: /order_list.php');
    die();
}

// Redirects the user to the home page if he doesn't have the get method.
if (!isset($_GET['id_order'])) {
    header('Location: /order_list.php');
    die();
}

// Fais une requête SQL qui change le status de la commande si y'a bien les méthodes présentes
if (isset($_POST['status']) && isset($_GET['id_order'])) {
    $select = $pdo->prepare('UPDATE orders SET status = ? WHERE id = ?');
    $select->execute([$_POST['status'],$_GET['id_order']]);
   
}

header('Location: /order_list.php');