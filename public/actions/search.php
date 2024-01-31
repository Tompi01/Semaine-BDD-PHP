<?php
require __DIR__ .  '/../../src/init.php';
if ($_POST['search'] == "") {
    header('Location: /index.php');


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

    <?php endforeach;
} else {
    $select = $pdo->prepare('SELECT * FROM product WHERE name LIKE :name');
    $select->execute([':name' => "%" . $_POST['search'] . "%"]);
    $search_result = $select->fetchAll();
    foreach ($search_result as $key) :
    ?>
        <form action="product.php" method="post">
            <p>
                <?php echo $key["name"]; ?> | Categorie: <?php echo $key["category"]; ?> (<?php echo $key["price"]; ?>€) <br><?php echo $key["description"]; ?> <br>Stock disponible : <?php echo $key["stock"]; ?>
            </p>
            <div>
                <input type="button" name="button" id="button" value="Aller sur le produit">
            </div>
        </form>
        <br>

<?php endforeach;
} 

function displaySearchedProduct(){
    global $pdo;
    $select = $pdo->prepare('SELECT * FROM product WHERE name LIKE :name');
    $select->execute([':name' => "%" . $_POST['search'] . "%"]);
    $search_result = $select->fetchAll();
    $display = "";
    foreach ($search_result as $key) :
        $display .= '<form action="product.php" method="post">';
        $display .= '<p>';
        $display .= '<?php echo $key["name"]; ?> | Categorie: <?php echo $key["category"]; ?> (<?php echo $key["price"]; ?>€) <br><?php echo $key["description"]; ?> <br>Stock disponible : <?php echo $key["stock"]; ?>';
        $display .= '</p>';
        $display .= '<div>';
        $display .= '<input type="button" name="button" id="button" value="Aller sur le produit">';
        $display .= '</div>';
        $display .= '</form>';
        $display .= '<br>';
    endforeach;



}
?>