<?php
require_once __DIR__ . '/../src/init.php';
require_once __DIR__ . '/actions/search.php';
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
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Bonjour</h1>
                <div class="alert alert-success">
                    Bienvenue sur la boutique !
                </div>
            </div>
        </div>
    </div>

    <form action="search.php" method="post">
        <div>
            <input type="text" name="search" id="search" placeholder="Entrez le nom du produit">
            <input type="button" name="filter" id="filter" value="Rechercher" href="">
        </div>
    </form>
    <?php

    $select = $pdo->prepare('SELECT * FROM product');
    $select->execute();
    $info_login = $select->fetchAll();

    foreach ($info_login as $key) : ?>

        <form action="product.php" method="post">
            <p>
                <?php echo $key["name"]; ?> | Categorie: <?php echo $key["category"]; ?> (<?php echo $key["price"]; ?>€) <br><?php echo $key["description"]; ?> <br>Stock disponible : <?php echo $key["stock"]; ?>
            </p>
            <div>
                <input type="button" name="button" id="button" value="Aller sur le produit">
            </div>
        </form>
        <br>
    <?php endforeach; ?>


</body>

</html>