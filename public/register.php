<?php 
require_once __DIR__ . '/../src/init.php';
if(isset($_SESSION['user_id'])){
    header("Location: /index.php");
};
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="/register.css">
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
    <form action="/actions/register.php" method="post">
        <h2>Inscription</h2>
        <div class="inputBox">
            <input type="text" name="email" id="email" required ="required">
            <span>email</span>
            <i></i>
        </div>
        <div class="inputBox">
            <input type="password" name="password" id="password" required ="required">
            <span>password</span>
            <i></i>
        </div>
        <div class="inputBox">
            <input type="password" name="cpassword" id="cpassword" required ="required">
            <span>comfirm password</span>
            <i></i>
        </div>
        <div class="inputBox">
            <input type="username" name="username" id="username" required ="required">
            <span>username</span>
            <i></i>
        </div>
        <div >
            <label for="rememberme">Remember Me</label>
            <input type="checkbox" name="rememberme" id="rememberme" value="yes">
        </div>
        <div class="links">
            <a href="/login.php">sign in</a>
        </div> 
        <div>
            <input type="submit" name ="boutonInscrire" value ="register NOW">
        </div>
    </form>
    </div>
</body>
</html>
