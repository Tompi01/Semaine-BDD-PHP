<?php
// session_start();
// session_unset();
// session_destroy();
// session_abort();
$ok = 0;
if (isset($_POST['rememberme']) && $_POST['rememberme'] === 'yes') {
    $ok = session_set_cookie_params(1000000);
}

// require ici
require_once __DIR__ . '/../../src/init.php';

// session_start();

//var_dump($_POST, $ok);

// if (isset($_POST['email']) && isset($_POST['password'])) {
//     function validate($data)
//     {
//         $data = trim($data);
//         $data = stripslashes($data);
//         $data = htmlspecialchars($data);
//         return $data;
//     }

//     $password = validate($_POST['password']);
//     $email = validate($_POST['email']);


    if (empty($_POST['email'])) {
        // error
        $_SESSION['error_message'] = 'Champs email vide.';
        header('Location: /login.php'); // redirige utilisateur
        die(); // stop execution du script
    }

    if (empty($_POST['password'])) {
        // error
        $_SESSION['error_message'] = 'Champs mot de passe vide.';
        header('Location: /login.php'); // redirige utilisateur
        die(); // stop execution du script
    }

    $select = $pdo->prepare('SELECT * FROM users WHERE email = :email OR username = :username');
    $select->execute([":email" => $_POST["email"], ":username"=> $_POST["email"]]);
    $info_login = $select->fetch();
    $trypassword = $info_login['password'];
    $passworduser = hash('sha256',$_POST['password']);
    // VÉRIF MOT DE PASSE + VÉRIF EMAIL
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
   
    
    
    
    //  else {
    //     $sql = "SELECT * FROM users WHERE email='$email'  OR username='$email'";
    //     $result = mysqli_query($db, $sql);
    //     if (mysqli_num_rows($result) === 1) {
    //         $row = mysqli_fetch_assoc($result);

    //         if ($row['email'] === $email or $row['username'] === $email) {
    //             if (password_verify($password, $row['password'])) {
    //                 $_SESSION['username'] = $row['username'];
    //                 $_SESSION['id'] = $row['id'];
    //                 header("Location: ../../index.php");
    //                 exit();
    //             } else {
    //                 header("Location: ../login.php?error=mot de passe ou email incorrect");
    //                 exit();
    //             }
    //         } else {
    //             header("Location: ../login.php?error=mot de passe ou email incorrect");
    //             exit();

    //             if ($row['username'] === $email) {
    //                 if (password_verify($password, $row['password'])) {
    //                     $_SESSION['username'] = $row['username'];
    //                     $_SESSION['id'] = $row['id'];
    //                     header("Location: ../../index.php");
    //                     exit();
    //                 } else {
    //                     header("Location: ../login.php?error=mot de passe ou email incorrect");
    //                 }
    //             } else {
    //                 header("Location: ../login.php?error=mot de passe ou email incorrect");
    //                 exit();
    //             }
    //         }
    //     } else {
    //         header("Location: ../login.php?error=mot de passe ou email incorrect");
    //         exit();
    //     }
    // }
    
?>