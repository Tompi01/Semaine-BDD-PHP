<?php
require_once __DIR__ . '/../../src/init.php';
// Redirects the user to the home page if he doesn't have the get method.
if (!isset($_SESSION["user_id"])) {
    header("Location: /index.php");
    die();
}

if (isset($_POST['address']) && $_POST['address'] != "") {
    $select = $pdo->prepare('SELECT * FROM cart
        INNER JOIN product ON cart.id_product = product.id
        WHERE cart.id_user = :id_user');
    $select->execute([':id_user' => $_SESSION['user_id']]);
    $command_validation = $select->fetchAll();


    $buyable = true;
    foreach ($command_validation as $in_stock) {
        if (!isset($in_stock[0][9])) {
            $buyable = false;
        }
    }
    // envoyer dans order ici.
    if ($buyable == true) {
        $insert1 = $pdo->prepare('INSERT INTO orders(id_user,status,delivery_address,update_date) VALUES(?,?,?,now())');
        $insert1->execute([$_SESSION['user_id'], "Préparation", $_POST['address']]);

        $select2 = $pdo->prepare('SELECT MAX(id) FROM orders');
        $select2->execute();
        $max_id = $select2->fetch();

        $i = 0;
        foreach ($command_validation as $composition) :
            $insert2 = $pdo->prepare('INSERT INTO composition(id_product,id_order,quantity) VALUES(?,?,?)');
            $insert2->execute([$command_validation[$i]['id_product'], $max_id[0], $command_validation[$i]['product_number']]);

            $select3 = $pdo->prepare('SELECT stock FROM product WHERE id = :id_product');
            $select3->execute([':id_product' => $command_validation[$i]['id_product']]);
            $stock = $select3->fetch();
            $stock = $stock['stock'] - $command_validation[$i]["product_number"];



            $stock_update = $pdo->prepare('UPDATE product SET stock = :stock WHERE id = :id');
            $stock_update->execute([':stock' => $stock, ':id' => $command_validation[$i]['id_product']]);
            $i++;
        endforeach;

        $select = $pdo->prepare('DELETE FROM cart WHERE id_user = :id');
        $select->execute([':id' => $_SESSION['user_id']]);
    } else {
        $_SESSION['error_message'] = 'Rupture de Stock';
    }
}
header('Location: /../index.php');
die();
