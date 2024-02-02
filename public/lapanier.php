<?php
require_once __DIR__ . '/../src/init.php';
require_once __DIR__ . '/actions/display_lapanier.php';

// Redirects the user to the home page if he doesn't have the get method.
if (!isset($_SESSION["user_id"])) {
    header("Location: /index.php");
    die();
}

// Retrieves cart information from variable
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
    <div class ="liste">
    <ul>
        <?php foreach ($product_cart as $product) : ?> </p>
            <li>
                <p><?php echo "<b>".$product["product_number"]."x</b> ".$product["name"]." (".$product["price"]*$product["product_number"]."€)" ?> </p>
                <form action="/actions/remove_to_cart.php?product=<?php echo $product["id"] ?>" method="post">
                    <input type="submit" value="Retirer" name="validate" id="validate">
                </form>
            </li>
        <?php endforeach; ?> </p>
    </ul>
    </div>
    <div class = "valid">
      <button><a href="order_validation.php">Confirmer la Commande</a></button>
    </div>
</body>



</form>

</html>