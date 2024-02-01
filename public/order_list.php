<?php
require_once __DIR__ . '/../src/init.php';
require_once __DIR__ . '/actions/order_list.php';
if (!isset($_POST["search_status"])) {
    $_POST["search_status"] = "all";
}
if (isset($_SESSION["role"]) && $_SESSION["role"] == "admin") {
    var_dump($_POST["search_status"]);
    // On prends les commandes dans une variable donc admin
    if (!isset($_POST["search_status"])) {
        // Si y'a pas de filtre sélectionné
        $info_orders = get_admin_orders("all");
    } else {
        // Si y'a un filtre sélectionné
        $info_orders = get_admin_orders($_POST["search_status"]);
    }
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

                <?php if (isset($_SESSION["role"]) && $_SESSION["role"] == "admin") : ?>
                <form action="" method="post">
                    <select name="search_status" id="search_status">
                        <option value="all" selected>Tout</option>
                        <option value="Préparation">Préparation</option>
                        <option value="Livraison">Livraison</option>
                        <option value="Livrée">Livré</option>
                        <option value="Annulée">Annulé</option>
                    </select>
                    <input type="submit" name="submit" value="Trier" href="">
                </form>
                <?php endif; ?>

                <br>
                <?php $i = 0;
                $final_price = 0; ?>
                <?php foreach ($info_orders as $compo) : ?>
                    <?php if ($i != $compo["id_order"]) :
                        $total_price = total_price($compo['id_order']); ?>
                        <marquee>Commande n°<?php echo $compo["id_order"] ?></marquee>
                        <h6><?php echo "Date de commande: <b>" . $compo["order_date"] . "</b> | Prix Total : <b>" . $total_price[0][0] . "€</b>"; ?></h6>
                        <?php $i = $compo["id_order"] ?>
                        <?php if (isset($_SESSION["role"]) && $_SESSION["role"] == "admin") : ?>
                            <h6>Commandé par <b><?php echo $compo["username"] ?></b></h6>
                        <?php endif; ?>
                        <h6>Status <b><?php echo $compo["status"] ?></b></h6>

                        <?php if (isset($_SESSION["role"]) && $_SESSION["role"] == "admin") : ?>
                            <form action="/actions/change_status.php?id_order=<?php echo $compo['id_order'] ?>" method="post">
                                <select name="status" id="status">
                                    <option value="Préparation">Préparation</option>
                                    <option value="Livraison">Livraison</option>
                                    <option value="Livrée">Livré</option>
                                    <option value="Annulée">Annulé</option>
                                </select>
                                <input type="submit" name="submit" value="Valider" href="">
                            </form>
                        <?php endif; ?>

                    <?php endif; ?>
                    <ul>
                        <li>
                            <p><?php echo $compo["quantity"] . " " . $compo["name"] . " | " . $compo["price"] . "€" . $compo["delivery_date"]; ?></p>
                        </li>

                    </ul>



                <?php endforeach; ?>
            </div>
        </div>
    </div>

</body>

</html>