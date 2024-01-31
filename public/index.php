<?php
require_once __DIR__ . '/../src/init.php';
require_once __DIR__ . '/actions/search.php';
if(!isset($_POST['search'])){
    $_POST['search'] = "";

}
if(!isset($_POST['filter'])){
    $_POST['filter'] = "";

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bonjour</title>
    <?php require_once __DIR__ . '/../src/partials/head_css.php'; ?>
    <link rel="stylesheet" type="text/css" href="/home.css">
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

<form class="search-bar" action="search.php" method="post">
    <input type="text" name="search" id="search" placeholder="Entrez le nom du produit">
    <select name="filter" id="filter">
        <option value="">Pas de filtre</option>
        <option value="a4">A4</option>
        <option value="a3">A3</option>
        <option value="a2">A2</option>
    </select>
    <input type="submit" name="submit" id="submit" value="Rechercher">
</form>

<div class="container">
    <div class="row">
        <div class="col">
            <?php
            if ($_POST['search'] == "" && $_POST['filter'] == "") {
                echo '<div class="product-box">' . displayAllProduct() . '</div>';
            } else {
                echo '<div class="product-box">' . displaySearchedProduct($_POST['filter']) . '</div>';
            }
            ?>
        </div>
    </div>
</div>

</body>

</html>