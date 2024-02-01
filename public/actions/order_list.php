<?php
require_once __DIR__ . '/../../src/init.php';

function get_user_orders()
{
    global $pdo;

    $select = $pdo->prepare('SELECT * FROM orders
        INNER JOIN composition ON orders.id = composition.id_order
        INNER  JOIN product ON product.id = composition.id_product
        WHERE id_user = :id');
    $select->execute([":id" => $_SESSION["user_id"]]);
    $info_orders = $select->fetchAll();
    //var_dump($info_product);
    return $info_orders;
}

function get_admin_orders($search_category)
{
    global $pdo;

    if ($search_category == "all") { // Si on recherche tout
        $select = $pdo->prepare('SELECT * FROM orders
        INNER JOIN composition ON orders.id = composition.id_order
        INNER JOIN product ON product.id = composition.id_product
        INNER JOIN users ON users.id = orders.id_user');
        $select->execute();
        $info_orders = $select->fetchAll();
        return $info_orders;
    } else { // Si on recherche un status
        $select = $pdo->prepare('SELECT * FROM orders
        INNER JOIN composition ON orders.id = composition.id_order
        INNER JOIN product ON product.id = composition.id_product
        INNER JOIN users ON users.id = orders.id_user
        WHERE orders.status = :status');
        $select->execute([':status' => $search_category]);
        $info_orders = $select->fetchAll();
        return $info_orders;
    }
}

function get_order_composition($order_id)
{

    global $pdo;

    $select = $pdo->prepare('SELECT * FROM composition 
    INNER JOIN orders ON orders.id = composition.id_order
    WHERE id_order = :id_order');
    $select->execute([":id_order" => $order_id]);
    $info_composition = $select->fetchAll();

    return $info_composition;
}

function total_price($order_id)
{
    global $pdo;

    $select = $pdo->prepare('SELECT SUM(product.price) FROM orders
    INNER JOIN composition ON orders.id = composition.id_order
    INNER  JOIN product ON product.id = composition.id_product
    WHERE id_order = :id_order');
    $select->execute([":id_order" => $order_id]);
    $total_price = $select->fetchAll();

    return $total_price;
}
