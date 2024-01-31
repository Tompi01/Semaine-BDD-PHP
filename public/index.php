<?php
require_once __DIR__ . '/../src/init.php';
require_once __DIR__ . '/actions/search.php';
if(!isset($_POST['search'])){
    $_POST['search'] = "";

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
            <input type="submit" name="filter" id="filter" value="Rechercher" href="">
        </div>
    </form>
    <?php
        if ($_POST['search'] == "") {
            echo displayAllProduct();
        }
        else{
           echo displaySearchedProduct();
        }
    ?>


</body>

</html>