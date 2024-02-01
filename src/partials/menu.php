<ul>
    <li>
        <a href="/">Accueil</a>
    </li>
    <?php
    if ($user === false) { ?>
    <li>
        <a href="/register.php">S'inscrire</a>
    </li>
    <li>
        <a href="/login.php">Se connecter</a>
    </li>
    <?php } else { ?>
    <li>
        <a href="/actions/logout.php">Se déconnecter</a>
    </li>
    <?php } ?>
    <li>
        <a href="/order_list.php">Liste de commandes</a>
    </li>
</ul>
