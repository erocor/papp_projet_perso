<?php
include("db.php");
session_start();

if(!isset($_SESSION["user"])){
    header("location:index.php");
    exit();
    }
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="..\ressources\css\histoirstyle.css">
    <meta charset="utf8">
</head>
<body>
    <div class="menuLeft">
        
        <div name="petit_vert" class="mini">
            <!-- petitVert = petit carré en haut à droite et titre = "Répertoire de plantes" -->
            <div class="menuIcon">
                <a href="creditADMIN.php" class="menuItem">
                    <img id="credits" src="..\ressources\images\Copyright.svg.png" class="menuItemImage">
                </a>
                <a href="#" class="menuItem">
                    <img id="histoire"src="..\ressources\images\book.png" class="menuItemImage">
                </a>
                <a href="menu_site_projet.php"class="menuItem">
                        <img id="House" src="..\ressources\images\maison.png" class="menuItemImage">
                </a>
            </div>
            <a class="menuBarreIconContainer">
                <img class="menuBarre" src="..\ressources\images\menuprojet.png">
            </a>
        </div>
    </div>
    <h1>Comment ce projet a-t-il été fait ?</h1>
    <p>En partenariat avec les apprentis du COFOP ainsi que les préapprentis de l'ETML, nous avons créé une serre qui sera mise à disposition pour les cuisiniers et les cuisinières du COFOP et visible à la terrasse de la cafétéria.</p>
    <h1>Voici les étapes de notre projet :</h1>
    <p>Les informaticiens ont dû créer le site et ses fonctionnalités.<br>
        Les ébénistes ont réalisé la structure de la serre.<br>
        Les polymécaniciens ont assuré l'étanchéité de la structure avec des finitions.<br>
        Les électroniciens se sont occupés de tous les systèmes électriques reliés à la serre.
        <script src="..\ressources\js\menu.js"></script>
    </body>
</html>
