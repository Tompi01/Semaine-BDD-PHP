<?php
require_once __DIR__ . '/../src/init.php';
require_once __DIR__ . '/actions/product.php';
var_dump($_SESSION);
if (isset($_GET["product"])) {
    $infos_product = get_product_infos();
    
} else {
    header('Location: /index.php'); // redirige utilisateur
    die(); // stop execution du script
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bonjour</title>
    <?php require_once __DIR__ . '/../src/partials/head_css.php'; ?>
</head>

<body>
    <?php require_once __DIR__ . '/../src/partials/menu.php'; ?>
    <?php require_once __DIR__ . '/../src/partials/show_error.php'; ?>

    <?php if (isset($_SESSION["role"]) && $_SESSION["role"] == "admin"): ?>
    <form action="/actions/modify_product.php?product=<?php echo $_GET["product"]?>" method="post">
        <div>
            <button>Modifier le produit</button>
        </div>
    </form>

    <form action="/actions/delete_product.php?product=<?php echo $_GET["product"]?>" method="post">
        <div>
            <button>Supprimer le produit</button>
        </div>
    </form>
    <?php endif; ?>

    <div class="container">
        <div class="row">
            <div class="col">
                <h1><?php echo $infos_product["name"] ?></h1>
                <p>Catégorie <?php echo $infos_product["category"] ?></p>
                <p><i><?php echo $infos_product["description"] ?></i></p>
                <h6><?php echo $infos_product["price"] ?>€</h6>
                <br><br>
                <h1>Commentaires et avis :</h1>
                <?php if (isset($infos_product["rating"])) { ?>
                    <p><?php echo $infos_product["username"]." : ".  $infos_product["date"] ?></p>
                    <p><?php echo "Note: " . $infos_product["rating"] . '/5' ?></p>
                    <p><?php echo $infos_product["commentary"] ?></p>
                <?php } ?>

            </div>
        </div>
    </div>


</body>

</html>