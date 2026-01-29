<?php
if (isset($_POST['mot'])) {

    $mot = $_POST['mot'];

    if ($mot != "") {

        $mots = file('mots.txt');

        $existe = false;

        foreach ($mots as $mot_existant) {
            if ($mot_existant == $mot) {
                $existe = true;
        
            }
        }

        if ($existe == false) {
            file_put_contents('mots.txt', "\n" . $mot , FILE_APPEND);
        }
    }
}
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
    <nav>
        <a href="#">Jeu</a> |
        <a href="#">Admin</a> |
        <a href="#">Rejouer</a>
    </nav>
    <hr>
</header>

<h1>Ajouter un mot</h1>

<form method="post">
    <input type="text" name="mot">
    <button type="submit">Ajouter</button>
</form>

<p><a href="index.php">Retour au jeu</a></p>

<hr>
<footer>
    <p>Projet Jeu du Pendu - 2025</p>
</footer>

</body>
</html>
