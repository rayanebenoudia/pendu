<?php
session_start();

$alphabet= ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'];
$mot=['p','a','i','n'];
$longueur_de_mot= array();
$chances = 10;
$tours = 10; 
$i = 0;
if(isset($_POST['letter'])){
     if ( $mot[$i]=== $_POST['letter']){
        echo "c'est bien la lettre que je cherche";
        echo "condition verifiée: ".$mot[$i]."".$_POST['letter'] ;
        
     }
     echo $mot[$i];

}
var_dump($_POST); 
/*
faire deviner un mot avec un nombre de chance limité 
le mot doit etre masqué
1 chance  = 1 tour & chaque tour = une lettre 
lettre valide = elle s'affiche 
lettre invalide = elle s'affiche dans un bloc 

comment comparé une lettre avec les  lettres d'un mot 
il faudra afficher le nombre d'occurence d'une lettre dans le mot rechercher 
si la lettre apparait deux fois alors l'afficher deux fois à l'emplacement qui correspond
si la lettre apparait une fois l'afficher une fois a l'emplacement qui correspond
si la lettre n'apparait pas alors l'afficher dans le bloc " lettre invalide"





*/


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form>
        <input type= "alphabet" name= "lettre">entrez une lettre</input>
        <input type= "submit" name= "submit"></input>

        

    </form>
</body>
</html>