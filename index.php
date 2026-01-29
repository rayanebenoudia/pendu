<?php
session_start();

$words = file('mots.txt');


if (!isset($_SESSION['word'])) { // Si pas de session je prend un mot a deviner et je set mes _SESSION en valeur par défaut
    $selected_word = trim($words[rand(0, count($words) - 1)]);
    $_SESSION['word'] = $selected_word;
    $_SESSION['guessed'] = [$selected_word[0]];
    $_SESSION['vie'] = 8;
    $_SESSION['try'] = 0;
}

$Guessword = $_SESSION['word'];  // Quand je reviens sur ma page je me souviens du mot

if (isset($_GET['letter'])) { // Quand il y à une tentative
    $clicked_letter = $_GET['letter'];
    $already_guessed = false;
    
    foreach ($_SESSION['guessed'] as $checked_letter) { // Je fais que ça ne se répète pas
        if ($checked_letter == $clicked_letter) {
            $already_guessed = true;
        }
    }

    if (!$already_guessed && $_SESSION['vie'] > 0) { // Il faut ne pas avoir perdu
        $_SESSION['guessed'][] = $clicked_letter;
        $_SESSION['try']++;
        
        $is_correct = false;
        $i = 0;
        while (isset($Guessword[$i])) {  // C'est faux tant qu'on ne trouve pas la lettre le mot
            if ($Guessword[$i] == $clicked_letter) {
                $is_correct = true;
            }
            $i++;
        }

        if (!$is_correct) {
            $_SESSION['vie'] --;
        }
    }
}

if (isset($_GET['reset'])) {
    session_destroy();
    header('Location: index.php');
    exit;
}

$remaining_lives = $_SESSION['vie'];
$try = $_SESSION['try'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Pendu</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="ui"> <!-- Titre plus info sur nos chance restantes -->
        <h1>PENDU</h1>
        <p>Chance restantes <?php echo $remaining_lives; ?></p> 
        <p>Tentatives <?php echo $try; ?></p>
    </div>

    <div id="guessword">
        <?php
        $x = 0;
        $win = true;
        while (isset($Guessword[$x])) {
            $found = false;
            foreach ($_SESSION['guessed'] as $g) {
                if ($Guessword[$x] == $g) {
                    $found = true;
                }
            }

            if ($found) {
                echo $Guessword[$x] . ' ';
            } elseif ($Guessword[$x] == '-') {
                echo '- ';
            } else {
                echo '_ ';
                $win = false;
            }
            $x++;
        }
        ?>
    </div>

    <div id="clavier">
        <?php
        if ($win) {
            echo "Bravo";  // si il gagne 
        } elseif ($remaining_lives <= 0) {
            echo "Perdu le mot était " . $Guessword; // Si il perd
        } else { // Sinon on affiche le clavier
            $alphabet = range('a', 'z');
            foreach ($alphabet as $letter) {
                $is_used = false;
                foreach ($_SESSION['guessed'] as $used_letter) {  // C'est faux jusqu'a quand la trouve dans la liste
                    if ($used_letter == $letter) {
                        $is_used = true;
                    }
                }
                if (!$is_used) {
                    echo '<a href="?letter=' . $letter . '" class="lettre">' . $letter . '</a> ';  // Pas utilisé normal
                } else {
                    echo '<span class="use">' . $letter . '</span> ';  // Utilisé grisé
                }
            }
        }
        ?>
    </div>

</body>
<footer>
        <br><br><a class= reset href="?reset=1">Recommencer</a>
</footer>
</html>