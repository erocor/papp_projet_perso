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
    <link rel="stylesheet" href="ProjetPersonnel.css">
</head>

<div class="container">
<div class="Bloc_1">
Pourquoi j’ai fait ce projet?
<br><br>
J’ai choisi de réaliser ce projet pour présenter le préapprentissage à l’ETML. 
Je voulais montrer les différentes activités qu’on a fait, ce que j’ai appris, et comment cela m’a aidé à mieux comprendre certains domaines. 
Ce projet m’a aussi permis de comprendre mieux l'informatique, en design de site web et en travail autonome.
</div>

<div class="Bloc_2">
Quelle application et quelle langage j'ai utilisé ?
<br><br>
J’ai utilisé Visual Studio Code et XAMPP pour créer mon site.
Pour les langages, j’ai utilisé du HTML, CSS, PHP et JavaScript.
Le JavaScript m’a surtout servi pour les animations, comme la barre de menu.

Je ne vous en ai pas parlé plus tôt, parce que le JavaScript, c’était un peu à part :
on pouvait faire ce qu’on voulait, mais on devait l’apprendre nous-mêmes.
Alors, pendant mon temps libre, j’ai appris le JavaScript pour réussir à faire mes animations.
</div>
</div>


<div class="Bloc_3">
Comment va se passer le projet personnel ?
<br><br>
Le projet personnel permet de montrer votre niveau et votre créativité. Pendant 8 semaines, vous allez travailler sur votre propre réalisation.
<br><br>
Voici quelques exemples de projets personnels réalisés par mes camarades dans différents domaines :
<br><br>
Informatique : Il y a mon propre projet, un site web.
<br><br>
Électronique : Un camarade a créé un jeu Simon.
<br><br>
Ébénisterie : Un autre camarade a fabriqué un tiroir de rangement.
<br><br>
Polymécanique : Un camarade a fabriqué un Levitating Shoe Display, un support qui fait léviter une chaussure grâce à un aimant.
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
                    <a href="ProjetCommun.php" class="MenuLien">ProjetCommun</a>
                    <a href="Menuprincipal.php" class="MenuLien">Menu</a>

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