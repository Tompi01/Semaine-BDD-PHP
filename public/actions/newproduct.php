<?php
if (isset($_POST['price'])) {
    $_POST['price']= floatval($_POST['price']);
    if (!is_double($_POST['price'])) {
        $_SESSION['error_message'] = 'Rentrez un nombre au format "XXX.XX"';
        die(); // stop execution du script
    }
}
if (isset($_POST['stock'])) {
    $_POST['stock']= intval($_POST['stock'],$base = 10);
    if (!is_int($_POST['stock'])) {
        $_SESSION['error_message'] = 'Rentrez un nombre entier';
        die(); // stop execution du script
    }
}
if (isset($_POST['name'])) {
    $st2 = $pdo->prepare('INSERT INTO product(name, price, description, category,stock) VALUES(?, ?, ?, ?,?)');
    $st2->execute([$_POST['name'], $_POST['price'], $_POST['description'], $_POST['category'], $_POST['stock']]);
}
