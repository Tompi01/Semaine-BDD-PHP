<?php

$ok = 0;
if (isset($_POST['rememberme']) && $_POST['rememberme'] === 'yes') {
    $ok = session_set_cookie_params(1000000);
}

require_once __DIR__ . '/../../src/init.php';

    // If the email is missing, display the error using a $_SESSION, and redirect the user to the same page.
    if (empty($_POST['email'])) {
        // error
        $_SESSION['error_message'] = 'Champs email vide.';
        header('Location: /login.php');
        die();
    }

    // If the password is missing, display the error with a $_SESSION, and redirect the user to the same page.
    if (empty($_POST['password'])) {
        // error
        $_SESSION['error_message'] = 'Champs mot de passe vide.';
        header('Location: /login.php');
        die();
    }

    // Retrieves the user's email information from the database, based on an SQL query
    $select = $pdo->prepare('SELECT * FROM users WHERE email = :email OR username = :username');
    $select->execute([":email" => $_POST["email"], ":username"=> $_POST["email"]]);
    $info_login = $select->fetch();
    $trypassword = $info_login['password'];
    $passworduser = hash('sha256',$_POST['password']);

    // Check password
    if ($passworduser == $trypassword) {
        $_SESSION["user_id"] = $info_login['id'];
        $_SESSION["username"] = $info_login['username'];
        $_SESSION["email"] = $info_login['email'];
        $_SESSION["role"] = $info_login['role'];

        header("Location: /index.php");
        die();
    }
    else{
        header("Location: /login.php?eror =email user incorrect");
        $_SESSION['error_message'] = 'email ou mot de passe incorrect ';
    }
   

    
?>