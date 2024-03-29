<?php
require_once __DIR__ . '/../src/init.php';
require_once __DIR__ . '/actions/product.php';

// If the product method is available, then the info is retrieved, otherwise it is redirected to the home page.

if (isset($_GET["product"])) {
    $infos_product = get_product_infos();
} else {
    header('Location: /index.php');
    die();
}
// Vérifie si l'utilisateur est connecté
if (isset($_SESSION["id"])) {
    // Vérifie si l'utilisateur a déjà passé une commande pour ce produit
    $productId = $_GET["product"];
    $userId = $_SESSION["id"];

    // Vérifie si la commande existe dans la table composition
    $orderExists = checkOrderExistence($userId, $productId);

    // Affiche le formulaire de commentaire si la commande existe
    if (!$orderExists) {
        include '/comment.php'; // Affiche le formulaire de commentaire
    }
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

    
    <?php if (isset($_SESSION["role"]) && $_SESSION["role"] == "admin"): // If you're an admin ?>
    <form action="/actions/modify_product.php?product=<?php echo $_GET["product"]?>" method="post">
        <div>
            <button>Modifier le produit</button>
        </div>
    </form>

        <form action="/actions/delete_product.php?product=<?php echo $_GET["product"] ?>" method="post">
            <div class="modifsuppr1">
                <button>Supprimer le produit</button>
            </div>
        </form>
    <?php endif; ?>

    <div class="container">
        <div class="row">
            <div class="col">
                <div class="ajoutpanier">
                    <form action="/actions/add_to_basket.php?product=<?php echo $_GET["product"] ?> " method='post'>
                        <input type="number" name="number" value="1" min="1" placeholder="Quantité voulue">
                        <input type="submit" name="submit" value="Ajouter au panier">
                    </form>
                </div>
            <div class="product-box">
            <h1><?php echo $infos_product[0]["name"] ?></h1>
            <p>Catégorie <?php echo $infos_product[0]["category"] ?></p>
            <p><i><?php echo $infos_product[0]["description"] ?></i></p>
            <h6><?php echo $infos_product[0]["price"] ?>€</h6>
            <br><br>
            <div class="comment-box">
                <h1>Commentaires et avis :</h1>
              <form action="/actions/comment.php?product=<?php echo $_GET["product"] ?>" method="post">
                            <input type="text" name="comment" id="comment" placeholder="Laissez votre commentaire ici">
                            <label for="rating">Votre note</label>
                            <input type="number" name="rating" id="rating" value=5 min=0 max=5>
                            <input type="submit" name="submit_comment" id="submit_comment" value="Envoyer le commentaire">
                        </form>
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