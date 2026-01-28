<?php
session_start();

if (!isset($_SESSION['mot_secret'])) {

    $mots = file('mots.txt');

    $i = 0;
    while (isset($mots[$i])) {
        $i++;
    }

    $aleatoire = rand(0, $i - 1);
    $_SESSION['mot_secret'] = $mots[$aleatoire];
}

$mot = $_SESSION['mot_secret'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Jeu du Pendu</title>
</head>
<body>

<h1>Jeu du Pendu</h1>

<h2>Mot à deviner :</h2>

<p>
<?php

$position = 0;
while (isset($mot[$position])) {
    echo "_ ";
    $position++;
}
?>
</p>

<h2>Propose une lettre :</h2>
<form method="post">
    <input type="text" name="lettre" maxlength="1" required>
    <button type="submit">Valider</button>
</form>

</body>
</html>
