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
</head>

<body>
    <?php require_once __DIR__ . '/../src/partials/menu.php'; ?>

    <h1>Dernière étape avant de valider votre commande!</h1>
    <h3>Veuillez entrer votre adresse de livraison:</h3>
    <!--  mettre le code ici -->

    <form action="/actions/validate_order.php" method="post">
        <input type="text" name="address" id="address" placeholder="Addresse">
        <input type="submit" name="submit" value="Valider la commande">
    </form>

</body>



</form>

</html>