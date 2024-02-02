<?php
    require_once __DIR__ . '/../../src/init.php';


if (isset($_POST['status']) && isset($_GET['id_order'])) {
    $select = $pdo->prepare('UPDATE orders SET status = ? WHERE id = ?');
    $select->execute([$_POST['status'],$_GET['id_order']]);
   
}

header('Location: /order_list.php');