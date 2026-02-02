<?php

if (isset($_POST['mot'])) {

    $mot = $_POST['mot'];

    if ($mot != "") {

        $lettres_ok = true;

        for ($i = 0; $i < strlen($mot); $i++) {
            $caractere = $mot[$i];

            if (
                ($caractere < 'a' || $caractere > 'z') &&
                ($caractere < 'A' || $caractere > 'Z')
            ) {
                $lettres_ok = false;
            }
        }

        if ($lettres_ok == true) {

            $mots = file('mots.txt');

            $existe = false;

            foreach ($mots as $mot_existant) {
                if ($mot_existant == $mot . "\n") {
                    $existe = true;
                }
            }

            if ($existe == false) {
                file_put_contents('mots.txt', $mot . "\n", FILE_APPEND);
            }
        }
    }
}

if (isset($_POST['supprimer'])) {

    $ligne_a_supprimer = $_POST['supprimer'];

    $mots = file('mots.txt');

    $nombre_mots = 0;
    foreach ($mots as $m) {
        $nombre_mots = $nombre_mots + 1;
    }

    if ($nombre_mots > 1) {

        $nouveau_texte = "";
        $i = 0;

        foreach ($mots as $mot) {
            if ($i != $ligne_a_supprimer) {
                $nouveau_texte = $nouveau_texte . $mot;
            }
            $i = $i + 1;
        }

        file_put_contents('mots.txt', $nouveau_texte);
    }
}

$mots = file('mots.txt');
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>Jeu du Pendu</h1>

    <nav>
        <a href="index.php">Jeu</a> |
        <a href="admin.php">Admin</a> |
        <a href="index.php">Rejouer</a>
    </nav>

    <hr>
</header>


<h1>Ajouter un mot</h1>

<form method="post">
    <input type="text" name="mot">
    <button type="submit">Ajouter</button>
</form>

<h2>Liste des mots</h2>

<ul>
<?php $index = 0; ?>
<?php foreach ($mots as $mot) : ?>
    <li>
        <?php echo $mot; ?>

        <form method="post" style="display:inline;">
            <button type="submit" name="supprimer" value="<?php echo $index; ?>">
                Supprimer
            </button>
        </form>
    </li>
<?php $index = $index + 1; ?>
<?php endforeach; ?>
</ul>

<p><a href="index.php">Retour au jeu</a></p>

<hr>

<footer>
    <p>Projet Jeu du Pendu - 2025</p>
</footer>


</body>
</html>
