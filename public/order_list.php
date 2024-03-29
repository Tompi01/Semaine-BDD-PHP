<?php
require_once __DIR__ . '/../src/init.php';
require_once __DIR__ . '/actions/order_list.php';

// Redirects the user to the home page if he doesn't have the get method.
if (!isset($_SESSION["user_id"])) {
    header("Location: /index.php");
    die();
}

// Define methods well if they are not present to avoid problems
if (!isset($_POST["search_status"])) {
    $_POST["search_status"] = "all";
}
if (isset($_SESSION["role"]) && $_SESSION["role"] == "admin") { // We take the commands in a variable, so admin
    // On prends les commandes dans une variable donc admin

    if (!isset($_POST["search_status"])) {
        // Si y'a pas de filtre sélectionné
        $info_orders = get_admin_orders_status("all");
    } else {
        // Si y'a un filtre sélectionné
        $info_orders = get_admin_orders_status($_POST["search_status"]);
    }

    if (!isset($_POST["date_modif"])) {
        // Si y'a pas de filtre sélectionné
        sort($info_orders);
    } else {
        // Si y'a un filtre sélectionné
        if ($_POST['date_modif'] == "recently") {
            sort($info_orders);
        } else {
            rsort($info_orders);
        }
    }
} else { // We take the commands in a variable, so user
    $info_orders = get_user_orders();
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
    <link rel="stylesheet" type="text/css" href="/order_list.css">
    <div class="container">
        <div class="row">
            <div class="col">
                <br>
                <br>
                <h1>Liste de commandes</h1>
                </br>
                </br>
                <?php if (isset($_SESSION["role"]) && $_SESSION["role"] == "admin") : ?>
                    <form action="" method="post">
                        <div class="trie">
                            <select name="search_status" id="search_status">
                                <option value="all" selected>Tout</option>
                                <option value="Préparation">Préparation</option>
                                <option value="Livraison">Livraison</option>
                                <option value="Livrée">Livré</option>
                                <option value="Annulée">Annulé</option>
                            </select>
                            <select name="date_modif" id="date_modif">
                                <option value="recently">Du plus récent au plus ancien</option>
                                <option value="ancien">Du plus ancien au plus récent</option>
                            </select>
                            <input type="submit" name="submit" value="Trier" href="">
                    </form>
            </div>
        <?php endif; ?>

        <br>
        <?php $i = 0;
        $final_price = 0; ?>
        <?php foreach ($info_orders as $compo) : ?>
            <?php if ($i != $compo["id_order"]) :
                $total_price = total_price($compo['id_order']); ?>

                <div class="marque">
                    <marquee>Commande n°<?php echo $compo["id_order"] ?></marquee>
                </div>
                <h6><?php echo "Date de commande: <b>" . $compo["order_date"] . "</b> | Prix Total : <b>" . $total_price[0][0] . "€</b>"; ?></h6>
                <?php $i = $compo["id_order"] ?>
                <?php if (isset($_SESSION["role"]) && $_SESSION["role"] == "admin") : ?>
                    <h6>Commandé par <b><?php echo $compo["username"] ?></b></h6>
                <?php endif; ?>
                <h6>Status <b><?php echo $compo["status"] ?></b></h6>

                <?php if (isset($_SESSION["role"]) && $_SESSION["role"] == "admin") : ?>
                    <form action="/actions/change_status.php?id_order=<?php echo $compo['id_order'] ?>" method="post">
                        <div class="trie1">
                            <select name="status" id="status">
                                <option value="Préparation">Préparation</option>
                                <option value="Livraison">Livraison</option>
                                <option value="Livrée">Livré</option>
                                <option value="Annulée">Annulé</option>
                            </select>

                            <input type="submit" name="submit" value="Valider" href="">
                    </form>
        </div>
    <?php endif; ?>

<?php endif; ?>
<ul>
    <div class="quantity">
        <li>
            <p><?php echo $compo["quantity"] . " " . $compo["name"] . " | " . $compo["price"] . "€" . $compo["delivery_address"]; ?></p>
        </li>
    </div>

</ul>



<?php endforeach; ?>

    </div>
    </div>
    </div>

</body>

</html>