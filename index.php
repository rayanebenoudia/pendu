<?php
session_start();



$mots = file('mots.txt');

if (!isset($_SESSION['word'])) {
    $word_select = trim($mots[rand( 0, count($mots) - 1)]);
    $_SESSION['word'] = $word_select;
    $_SESSION['guessed'] = [$word_select[0]];
    // var_dump(trim($word_select));
}

if (isset($_GET['lettre'])) {
    $_SESSION['guessed'][] = $_GET['lettre'];
}

if (isset($_GET['reset'])) {
    session_destroy();
    header('Location: index.php');
    exit;
}

$GuessWord = $_SESSION['word'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Pendu</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="guessword">
        <?php
        $i = 0;
        $win = true;
        // var_dump($GuessWord);
        while (isset($GuessWord[$i])) {
            if (in_array($GuessWord[$i], $_SESSION['guessed'])) {
                echo $GuessWord[$i] . '';
            }
            elseif ($GuessWord[$i]== '-') {
            echo '- ';
            }
            else {
                echo '_ ';
                $win = false;
            }
            $i++;
        }
        ?>
    </div>

    <div id="clavier">
        <?php
        if ($win) {
            echo "gg";
        } else {
            $alphabet = range('a', end: 'z');
            foreach ($alphabet as $lettre) {
                if (!in_array($lettre, $_SESSION['guessed'])) {
                    echo '<a href="?lettre=' . $lettre . '" class="lettre">' . $lettre . '</a> ';
                } else {
                    echo '<span class="use">' . $lettre . '</span> ';
                }
            }
        }
        ?>
    </div>

    <br><br><a href="?reset=1">reset</a>
</body>
</html>
