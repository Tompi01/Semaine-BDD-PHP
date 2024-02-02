<?php
require_once __DIR__ . '/../../src/init.php';


function get_product_infos()
{
    /**
    * Function that performs an SQL query to retrieve all the information about the selected product and its associated comments.
    * Return: the $info_product variable, which contains HTML code in String format.
    */
    global $pdo;
    $select = $pdo->prepare('SELECT * FROM product
        LEFT JOIN commentaries on product.id = commentaries.id_product 
        LEFT JOIN users on commentaries.id_user = users.id 
        WHERE product.id = :id');
    $select->execute([":id" => $_GET["product"]]);
    $info_product = $select->fetchAll();
    return $info_product;
}


// Fonction pour vérifier si l'utilisateur a déjà passé une commande pour un produit donné
function checkOrderExistence($userId, $productId) {
    global $pdo;
    
    // Préparer la requête SQL pour vérifier si une commande existe
    $sql = "SELECT * FROM composition,orders 
            INNER JOIN orders ON composition.id_order = orders.id 
            WHERE orders.id_user = :userId AND composition.id_product = :productId";
    

    $stmt = $pdo->prepare($sql);
    
    // Liaison des paramètres
    $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
    $stmt->bindParam(':productId', $productId, PDO::PARAM_INT);
    
    // Exécuter la requête
    $stmt->execute();
    
    // Récupérer le résultat de la requête
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Vérifier si une commande existe pour ce produit et cet utilisateur
    if ($result > 0) {
        return true;
    } else {
        return false;
    }
}



?>
