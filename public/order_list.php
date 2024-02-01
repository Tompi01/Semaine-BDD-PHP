<?php
require_once __DIR__ . '/../src/init.php';
require_once __DIR__ . '/actions/order_list.php';
if (isset($_SESSION["role"]) && $_SESSION["role"] == "admin") {
    // On prends les commandes dans une variable donc admin
} else {
    $info_orders = get_user_orders();
    
    // On prends les commandes dans une variable donc user
}
var_dump($info_orders[0]);?>
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
                <?php $i = 0 ;
                $total_price =0 ;?>
                <?php foreach($info_orders as $compo):?>
                    <?php if ($i != $compo["id_order"]):?>
                        <h3>Commande n°<?php echo $compo["id_order"]." Date de commande: ".$compo["order_date"];?></h3>
                    <?php $i = $compo["id_order"]?>
                    <?php endif;?>
                    <p><?php echo $compo["quantity"]." ".$compo["name"]." | ".$compo["price"]."€".$compo["delivery_date"];?></p>
                   <?php $O = floatval($compo["price"]) ;
                  echo $total_price += $O ;?>
                <?php endforeach;?>
            </div>
        </div>
    </div>
            
</body>
</html>