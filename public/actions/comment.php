<?php
// Vérifie si le formulaire de commentaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_comment"])) {
    // Vérifie si l'utilisateur est connecté
    if (isset($_SESSION["id"])) {
        // Récupère les données du formulaire
        $comment = $_POST["comment"];
        $productId = $_GET["product"];
        $userId = $_SESSION["id"];

        // insérer le commentaire
        $sql = "INSERT INTO commentaries (id_user, id_product, commentary) VALUES (:userId, :productId, :comment)";
        
        // Préparer la requête
        $stmt = $pdo->prepare($sql);
        
        // Liaison des paramètres
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':productId', $productId, PDO::PARAM_INT);
        $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
        
        // Exécuter la requête
        $stmt->execute();
        
        // Rediriger vers la page du produit après avoir commenté
        header("Location: /product.php?product=$productId");
        exit();
    } else {
        // Si l'utilisateur n'est pas connecté, redirigez-le vers la page de connexion ou affichez un message d'erreur
        header("Location: /login.php");
        exit();
    }
} else {
    // Si le formulaire n'est pas soumis, redirigez l'utilisateur vers la page d'accueil ou affichez un message d'erreur
    header("Location: /index.php");
    exit();
}

?>
