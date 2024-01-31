<?php 
require_once __DIR__ . '/../src/init.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/login.css">
</head>
<body>
    <?php require_once __DIR__ . '/../src/partials/show_error.php'; ?>
    
    <div class="bulle"> 
    <span style="--i:11;"></span>
    <span style="--i:12;"></span>
    <span style="--i:24;"></span>
    <span style="--i:10;"></span>
    <span style="--i:14;"></span>
    <span style="--i:23;"></span>
    <span style="--i:18;"></span>
    <span style="--i:16;"></span>
    <span style="--i:20;"></span>
    <span style="--i:22;"></span>
    <span style="--i:25;"></span>
    <span style="--i:18;"></span>
    <span style="--i:21;"></span>
    <span style="--i:15;"></span>
    <span style="--i:13;"></span>
    <span style="--i:26;"></span>
    <span style="--i:17;"></span>
    <span style="--i:13;"></span>
    <span style="--i:28;"></span>
    <span style="--i:11;"></span>
    <span style="--i:12;"></span>
    <span style="--i:24;"></span>
    <span style="--i:10;"></span>
    <span style="--i:14;"></span>
    <span style="--i:23;"></span>
    <span style="--i:18;"></span>
    <span style="--i:16;"></span>
    <span style="--i:20;"></span>
    <span style="--i:22;"></span>
    <span style="--i:25;"></span>
    <span style="--i:18;"></span>
    <span style="--i:21;"></span>
    <span style="--i:15;"></span>
    <span style="--i:13;"></span>
    <span style="--i:26;"></span>
    <span style="--i:17;"></span>
    <span style="--i:13;"></span>
    <span style="--i:28;"></span>
    <span style="--i:11;"></span>
    <span style="--i:12;"></span>
    <span style="--i:24;"></span>
    <span style="--i:10;"></span>
    <span style="--i:14;"></span>
    <span style="--i:23;"></span>
    <span style="--i:18;"></span>
    <span style="--i:16;"></span>
    <span style="--i:20;"></span>
    <span style="--i:22;"></span>
    <span style="--i:20;"></span>
    </div> 

    <div class="box">
    <span class="borderLine"></span>
    <form action="/actions/login.php" method="post">
    <h2>connexion</h2>
        <div class="inputBox">
            <input type="text" name="email" id="email">
            <span>nom d'utilisateur ou e-mail</span>
                <i></i>
        </div>
        <div class="inputBox">
            <input type="password" name="password" id="password">
            <span>password</span>
                <i></i>
        </div>
        <div class="links">
            <a href="/register.php">sign up</a>
        </div> 
        <input type="submit" name="connexion" value ="connexion" >
    </form>
    </div>
</body>
</html>
