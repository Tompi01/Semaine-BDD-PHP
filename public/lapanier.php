<?php
require_once __DIR__ . '/../src/init.php';
require_once __DIR__ . '/actions/display_lapanier.php';
$product_cart = get_display_lapanier();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>panier</title>
    <link rel="stylesheet" type="text/css" href="/lapanier.css">
</head>

<body>
    <?php require_once __DIR__ . '/../src/partials/menu.php'; ?>

    <h1>Panier</h1>
    <h3>Votre panier-piano</h3>
    <!--  mettre le code ici -->
    <div class ="liste">
    <ul>
        <?php foreach ($product_cart as $product) : ?> </p>
            <li><p><?php echo "<b>".$product["product_number"]."x</b> ".$product["name"]." (".$product["price"]."€)" ?> </p></li>
        <?php endforeach; ?> </p>
    </ul>
    </div>
    <div class = "valid">
    <form action="/actions/validate_order.php" method="post">
        <input type="submit" value="Passer la commande" name="validate" id="validate">
    </form>
    </div>

</body>



</form>

</html>