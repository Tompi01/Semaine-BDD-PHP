<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu stylisé</title>

    
    <!-- * Styles pour le menu * -->
    <style>
        ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        li {
            display: inline-block;
            margin-top: 20px;
            margin-right: 20px;
        }

        a {
            text-decoration: none;
            padding: 10px 20px;
            color: #fff;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        a:hover {
            background-color: #0056b3;
            transform: translateY(-3px);
        }

        /* Animation de survol */
        @keyframes buttonHover {
            0% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-5px);
            }
            100% {
                transform: translateY(0);
            }
        }

        a:hover {
            animation: buttonHover 0.3s ease;
        }
        </style>

</head>
<body>
<ul>
    <li>
        <a href="/">Accueil</a>
    </li>
    <?php
    if ($user === false) { ?>
    <li>
        <a class="aa" href="/register.php">S'inscrire</a>
    </li>
    <li>
        <a href="/login.php">Se connecter</a>
    </li>
    <?php } else { ?>
    <li>
        <a href="/actions/logout.php">Se déconnecter</a>
    </li>
    <li>
        <a href="/order_list.php">Liste de commandes</a>
    </li>
    <li>
        <a href="/lapanier.php">Panier</a>
    </li>
    <?php } ?>
</ul>
</body>
</html>
