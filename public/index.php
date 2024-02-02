<?php
require_once __DIR__ . '/../src/init.php';
require_once __DIR__ . '/actions/search.php';
require_once __DIR__ . '/actions/newproduct.php';

// Define methods well if they are not present to avoid problems
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
    <link rel="stylesheet" type="text/css" href="/home.css">
    <style>
        /* Style du formulaire d'ajout de produit */
        .add-product-form {
            display: none; /* Masquer le formulaire par défaut */
            position: absolute;
            top: 15px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #f9f9f9;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
            width: 300px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .add-product-form input[type="text"],
        .add-product-form select,
        .add-product-form input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .add-product-form input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .add-product-form input[type="submit"]:hover {
            background-color: #0056b3;
        }
        
    </style>
</head>

<body>
    <?php require_once __DIR__ . '/../src/partials/menu.php'; ?>
    <?php require_once __DIR__ . '/../src/partials/show_error.php'; ?>
    <div class="container">
        <div class="row">
            <div class="col">
                <br>
                <h1>Bonjour</h1>
                <div class="alert alert-success">
                    Bienvenue sur la boutique !
                </div>
    </br>
                <!-- Barre de recherche -->
                <form class="search-bar" action="search.php" method="post">
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

                <!-- Bouton pour afficher le formulaire d'ajout de produit -->
                <?php if ($_SESSION['role'] == 'admin') { ?>
                    <button id="show-form-btn">Ajouter un produit</button>
                <?php } ?>

                <!-- Formulaire d'ajout de produit -->
                <form action="newproduct.php" method="post" class="add-product-form" id="add-product-form">
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
            </div>
        </div>
    </div>

    <!-- Affichage des produits -->
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

    <script>
        // JavaScript pour afficher/masquer le formulaire d'ajout de produit
        const showFormButton = document.getElementById('show-form-btn');
        const addProductForm = document.getElementById('add-product-form');

        showFormButton.addEventListener('click', function() {
            addProductForm.style.display = addProductForm.style.display === 'none' ? 'block' : 'none';
        });
    </script>
</body>

</html>


