<?php
require_once __DIR__ . '/../../src/init.php';

// Redirects the user to the home page if he doesn't have the get method.
if (isset($_SESSION["user_id"])) {
    header("Location: /index.php");
    die();
}

function get_user_orders()
{
    /**
    * Function that retrieves all user order information using a SQL query.
    * Return: the $info_orders variable, which contains orders informations.
    */
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
    /**
    * Function that retrieves all the site's order information, and also manages the associated filters using an SQL query.
    * Parameter: $search_category (the selected category filter)
    * Return: the $info_orders variable, which contains orders informations.
    */
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
    /**
    * Function that retrieves the entire composition of an order
    * Parameter: $order_id (desired order id)
    * Return: the $info_composition variable, which contains composition informations.
    */

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
