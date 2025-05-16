<?php
session_start();
include("bd.php"); // Connexion à la base de données

// Vérifie si l'utilisateur est un administrateur
$is_admin = isset($_SESSION['usertype']) && $_SESSION['usertype'] === 'ETML';

// Permet d'entrer uniquement si l'utilisateur vient depuis Menu.php
$referer = $_SERVER['HTTP_REFERER'] ?? '';

/* =========================================================================
   ADMIN : SUPPRESSION D’UN AVIS
   ========================================================================= */
if (isset($_GET['delete_avis_id']) && $is_admin) {
    $delete_id = $_GET['delete_avis_id'];

    // Vérifie que l’ID est un nombre valide
    if (is_numeric($delete_id)) {
        try {
            // Supprime l'avis correspondant à l'ID
            $query_delete = "DELETE FROM avis WHERE id = :id";
            $stmt_delete = $conn->prepare($query_delete);
            $stmt_delete->bindParam(':id', $delete_id, PDO::PARAM_INT);
            $stmt_delete->execute();

            // Redirige vers le menu après suppression
            header("Location: Menuprincipal.php?success=delete");
            exit();
        } catch (PDOException $e) {
            echo "Erreur lors de la suppression de l'avis : " . $e->getMessage();
        }
    } else {
        echo "L'ID de l'avis n'est pas valide.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projet_Commun</title>
    <link rel="stylesheet" href="ProjetCommun.css">
</head>

<div class="Bloc_1">
Pour le projet commun, nous avons fabriqué une serre. Ce que vous voyez au milieu, c’est la version finale de notre réalisation. Ce projet a été conçu pour le Cofop (une école à Vennes), et a impliqué plusieurs sections qui ont travaillé ensemble.

Les informaticiens ont créé un site pour gérer les plantes, les électroniciens ont conçu un système de mesure, les polymécaniciens ont fabriqué les structures métalliques, et les ébénistes ont réalisé les éléments en bois.

En continuant votre lecture, vous découvrirez plus d’informations sur le travail de chaque groupe.
</div>

<div class="Bloc_2">

Informatique
<br><br>
Dans ce projet, l'équipe informatique a créé un site web pour présenter les plantes d'une serre construite par les autres sections. Chaque plante était accompagnée d'infos utiles : nom, température idéale, besoins en eau et humidité. Les administrateurs pouvaient gérer les plantes (ajouter, modifier, supprimer).
<br><br>
Organisation du travail
<br>
L'équipe était divisée en deux groupes :
<br>
Frontend : design et création des pages.
<br>
Backend : ma mission était de gérer la base de données et les fonctions liées aux plantes et utilisateurs.
<br><br>
Contenu du site: Une page d’accueil avec les plantes, Une page de connexion, Des pages pour ajouter/modifier une plante, Une page de description de chaque plante, Une page "crédits" et Une page "histoire du projet"
<br><br>
Outils utilisés:
Visual Studio Code, GitHub, Git Bash pour coder et collaborer
XAMPP pour tester le site
<br><br>
Langages : HTML, CSS, JavaScript, PHP
<br><br>    
Conclusion
<br>
Ce projet a permis de travailler en équipe et de créer un site utile, bien intégré.

</div>

<button id="ProjetCommun"><a href="https://cofop.vimodev.ch">Entrée dans le site projet commun</a></button>

<div class="Bloc_3">
Polymécanique
<br><br>
Dans ce projet, la section polymécanique a participé à la fabrication de la serre en réalisant les pièces en métal et en plexiglas. Nous avons aussi assemblé différentes parties de la structure.
<br><br>
Travail réalisé
<br>
Modélisation 3D : utilisation du logiciel Inventor pour dessiner, modéliser et assembler virtuellement les pièces de la serre
<br><br>
Fabrication en plexiglas : découpe des fenêtres, ponçage des bords pour la sécurité
<br><br>
Outils de jardinage : modélisation de pelles et râteaux sur Inventor
<br><br>
Travail du métal : fabrication de cadres et gouttières avec fraiseuse et plieuse, pose de joints pour réduire les vibrations
<br><br>
Assemblage : montage de la serre, perçage, fixation du plexiglas, et finitions
<br><br>
Installation finale : pose des charnières du toit, aide à l’installation des panneaux solaires et des ventilateurs, initiation au soudage
<br><br>
Conclusion
<br>
La section polymécanique a apporté une contribution essentielle à la solidité et à la finition de la serre. Ce projet nous a permis d’utiliser des outils de précision, de travailler en équipe, et de développer des compétences utiles pour le métier.
</div>

<div class="Bloc_4">
Bois
<br><br>
La section bois a participé à la construction de la serre en fabriquant toute la structure en bois. Mes camarades ont utilisé du bois d’épicéa, du plexiglas et divers outils pour découper, assembler et protéger les éléments de la serre.
<br><br>
Travail réalisé
<br>
Découpe et assemblage : création de la structure en bois
<br><br>
Baguettes à verre : fabrication des baguettes pour fixer le plexiglas
<br><br>
Toit : construction des poutres et des fenêtres pour l’aération et la lumière
<br><br>
Finitions : protection du bois contre l’eau
<br><br>
Montage final : assemblage complet avec pose du plexiglas et installation des éléments électroniques
<br>
Conclusion
<br>
La section bois a joué un rôle clé dans la réussite du projet. Les élèves ont appris à travailler en équipe, à manier les outils et à coordonner leur travail avec les autres sections.
</div>

<div class="Bloc_5">
Électronique
<br><br>
Dans ce projet, nous avons conçu un système permettant de mesurer la température et l’humidité dans une serre pour garantir des conditions idéales aux plantes. Des capteurs détectaient les valeurs, et des LEDs s’allumaient pour signaler s’il faisait trop chaud, trop froid, trop sec ou trop humide.
<br><br>
Fonctionnement
<br><br>
Capteur de température :
<br>
LED rouge = trop chaud
<br>
LED bleue = trop froid
<br>
Exemple : à 8,5°C → LED bleue / à 33°C → LED rouge
<br><br>
Capteur d’humidité :
<br>
LED rouge = air trop sec
<br>
LED bleue = air trop humide
<br>
Exemple : à 45% → LED rouge / à 73% → LED bleue
<br><br>
Matériel utilisé:
<br>
Multimètre et alimentation
<br>
Composants électroniques : résistances, capteurs, LEDs
<br><br>
Conclusion
<br>
Ce projet a permis de créer un système simple et efficace pour surveiller les conditions dans la serre. Grâce aux capteurs et aux signaux lumineux, on peut facilement savoir quand intervenir.
</div>

<header>
    <div class="Courbe">
        <!-- Logo de l'ETML -->
        <img src="Image+Audio-Projet-Personnel/etml_-_Copie-removebg-preview.png" width="225px" alt="Logo ETML">
    </div>

    <div class="menuLeft">
        <div id="menu">
            <div class="Menu">
                <div class="MenuLienBarre">
                    <!-- Liens de navigation vers les pages des formations -->
                    <a href="Informatique.php" class="MenuLien">Informatique</a>
                    <a href="Electronique.php" class="MenuLien">Electronique</a>
                    <a href="Polymécanique.php" class="MenuLien">Polymécanique</a>
                    <a href="Ebéniste.php" class="MenuLien">Ebéniste</a>
                    <a href="Menuprincipal.php" class="MenuLien">Menu</a>
                    <a href="Projetpersonnel.php" class="MenuLien">Projetpersonnel</a>

                    <!-- Lien dynamique pour connexion ou déconnexion -->
                    <a href="<?php echo isset($_SESSION['usertype']) ? 'déconnexion.php' : 'connexion.php'; ?>" 
                       class="MenuLien"
                       style="background-color: <?php echo isset($_SESSION['usertype']) ? 'Red' : '#04AA6D'; ?>; color: white;">
                       <?php echo isset($_SESSION['usertype']) ? 'Déconnexion' : 'Connexion'; ?>
                    </a>
                </div>
                <!-- Bouton menu (mobile) -->
                <a href="#" class="MenuBarreContainer">
                    <img class="MenuBarre" src="Image+Audio-Projet-Personnel/OIP_-_Copie-removebg-preview - Copie.png" width="74px" alt="Menu Bar">
                </a>
            </div>
        </div>
    </div>
</header>
<body >

    
    <footer>©Eros Corona</footer>
    <script src="Total.JS"></script>
</body>
</html