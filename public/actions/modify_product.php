<?php
require_once __DIR__ . '/../../src/init.php';

require_once __DIR__ . '/product.php';

// Redirects the user to the home page if he doesn't have the get method.
if (!isset($_SESSION["user_id"])) {
    header("Location: /index.php");
    die();
}

// If product id is present on URL, get product info
if (isset($_GET["product"])) {
    $infos_product = get_product_infos();
}

// If the product modification is successful, then modify the product on the DB with the SQL query and redirect the user to the product page
if (isset($_GET["sucess"])) {
    if ($_GET["sucess"] == 1) {
        global $pdo;
        $select = $pdo->prepare('UPDATE product
                                SET name = :name, price = :price, description = :description, category = :category, stock = :stock 
                                WHERE id = :id;');
        $select->execute([':id' => $_GET['product'],':price' => $_POST["price"],':description' => $_POST["description"]
        ,':category' => $_POST["category"],':stock' => $_POST["stock"], ':name' => $_POST["name"]]);
        header("Location: /product.php?product=" . $_GET['product']);
        die();
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $redirection = "/actions/modify_product.php?sucess=1&product=" . $_GET['product'];
    ?>

    <h1>Modification du produit</h1>

    <form action="<?php echo $redirection;?>" method="post">
        <div>
            <label for="name">Nom</label>
            <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($infos_product[0]['name']); ?>">
            <label for="description">Description</label>
            <input type="text" name="description" id="description" value="<?php echo htmlspecialchars($infos_product[0]['description']); ?>">
            <label for="category">Catégorie</label>
            <select name="category" id="category">
                <option value="a4" selected>A4</option>
                <option value="a3">A3</option>
                <option value="a2">A2</option>
            </select>
            <label for="price">Prix</label>
            <input type="number" name="price" id="price" value="<?php echo htmlspecialchars($infos_product[0]['price']); ?>">
            <label for="stock">Stock</label>
            <input type="number" name="stock" id="stock" value="<?php echo htmlspecialchars($infos_product[0]['stock']); ?>">
            <button>Modifier le produit</button>
        </div>
    </form>

</body>
</html>