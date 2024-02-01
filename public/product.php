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
    <link rel="stylesheet" href="/product.css">
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

            <form action="/actions/add_to_basket.php?product=<?php echo $_GET["product"]?> "method='post'>
                <input type="number" name="number" min="1" placeholder="Quantité voulue">
                <input type="submit" name="submit" value="Ajouter au panier">
            </form>

            <div class="product-box">
            <h1><?php echo $infos_product[0]["name"] ?></h1>
            <p>Catégorie <?php echo $infos_product[0]["category"] ?></p>
            <p><i><?php echo $infos_product[0]["description"] ?></i></p>
            <h6><?php echo $infos_product[0]["price"] ?>€</h6>
            <br><br>
            <div class="comment-box">
                <h1>Commentaires et avis :</h1>
                <?php foreach($infos_product as $commentary):?>
                    <?php if (isset($commentary["rating"])) { ?>
                        <div class="commentary">
                            <div class="commentary_infos">
                                <?php $newDate = "Le ".date("j M Y", strtotime($commentary["date"]));?>
                                <p><?php echo "<b>".$commentary["username"]."</b> : ".  $newDate ?></p>
                                <p><?php echo "Note: " . $commentary["rating"] . '/5' ?></p>
                            </div>
                            <div class="commentary_text">
                                <marquee direction="right" scrollamount="10"><?php echo $commentary["commentary"] ?></marquee>
                            </div>
                        </div>
                    <?php } ?>
                    <br>
                <?php endforeach;?>
            </div>
        </div>
    </div>
</div>


</body>

</html>