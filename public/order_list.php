<?php
require_once __DIR__ . '/../src/init.php';
require_once __DIR__ . '/actions/order_list.php';
if (isset($_SESSION["role"]) && $_SESSION["role"] == "admin") {
    // On prends les commandes dans une variable donc admin
} else {
    $info_orders = get_user_orders();
    // On prends les commandes dans une variable donc user
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des commandes</title>
    <?php require_once __DIR__ . '/../src/partials/head_css.php'; ?>
</head>

<body>
    <?php require_once __DIR__ . '/../src/partials/menu.php'; ?>
    <?php require_once __DIR__ . '/../src/partials/show_error.php'; ?>
    <div class="container">
    <div class="row">
        <div class="col">
           <h1>Liste de commandes</h1>
            <?php global $i; ?>
           <?php foreach ($info_orders as $info_order):?>
            <h4>Commande n°<?php echo $info_order["id_order"]?></h4>
            <p><?php echo $info_order["quantity"]?> <?php echo $info_order["name"]?> | Categorie : <?php echo $info_order["category"]?></p>
            <h6>Prix : <?php echo $info_order["price"]?>€</h6>
            <php $i +=1; ?>
           <p> <?php echo $i; ?></p>
            <br>
            <?php endforeach;?>
        </div>
    </div>
</div>


</body>

</html>