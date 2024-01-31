<?php
require_once __DIR__ . '/../src/init.php';
require_once __DIR__ . '/actions/search.php';
require_once __DIR__ . '/actions/newproduct.php';
if (!isset($_POST['search'])) {
    $_POST['search'] = "";
}
if (!isset($_POST['filter'])) {
    $_POST['filter'] = "";
}
if (!isset($_SESSION['role'])) {
    $_SESSION['role'] = "user";
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
            <select name="filter" id="filter">
                <option value="">Pas de filtre </option>
                <option value="a4">A4</option>
                <option value="a3">A3</option>
                <option value="a2">A2</option>
            </select>
            <input type="submit" name="submit" id="submit" value="Rechercher" href="">
        </div>
    </form>
    <?php
    if ($_POST['search'] == "" && $_POST['filter'] == "") {
        echo displayAllProduct();
    } else {
        echo displaySearchedProduct($_POST['filter']);
    }



    if ($_SESSION['role'] == 'admin') { ?>
        <form action="newproduct.php" method="post">
            <input type="text" name="name" required="required" placeholder="Entrez le nom du produit">
            <input type="text" name="price" required="required" placeholder="Entrez le prix du produit">
            <input type="text" name="description" required="required" placeholder="Entrez la description du produit">
            <select name="category" id="category">
                <option value="A4">A4</option>
                <option value="A3">A3</option>
                <option value="A2">A2</option>
            </select>
            <input type="text" name="stock" required="required" placeholder="Entrez la quantité de produit dispo">
            <input type="submit" name="submit" value="Ajouter le produit" href="">


        </form>
    <?php } ?>


</body>

</html>