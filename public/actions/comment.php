<?php
require_once __DIR__ . '/../../src/init.php';


if (isset($_SESSION["user_id"]) && isset($_GET["product"])) {

    // Get the count of the selected product
    $comment = $pdo->prepare('SELECT count(composition.id_product) as c FROM orders
                             INNER JOIN composition ON composition.id_order = orders.id
                             WHERE orders.id_user = ? AND composition.id_product = ?');
    $comment->execute([$_SESSION["user_id"], $_GET["product"]]);
    $infos = $comment->fetchAll();

    if ($infos[0]["c"] > 0) {
        // Insert the commentary in the BDD
        $comment = $pdo->prepare('INSERT INTO commentaries (id_user,id_product,rating, commentary) VALUES (?,?,?,?)');
        $comment->execute([$_SESSION['user_id'], $_GET["product"], $_POST["rating"], $_POST["comment"]]);
    } else {
        $_SESSION['error_message'] = "Vous n'avez jamais commandé ce produit";
    }
    header("Location: /product.php?product=" . $_GET['product']);
    die();
} else {
    header("Location: /product.php");
    die();
}
