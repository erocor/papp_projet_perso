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
    <title>Document</title>
    <link rel="stylesheet" href="Ebéniste.css">
</head>
<div class="Bloc_1">
    Dans le métier d'ébéniste, vous allez réaliser un projet tel qu'un carrom, un jeu de société aussi appelé billard indien, ou une porte-manette.
</div>

<div class="Bloc_2">
   Les outils qu'on utilise beaucoup sont le ciseau à bois,
</div>

<div class="Bloc_3">
Pour te lancer dans le métier d'ébéniste, pas besoin d’être un expert dès le départ : il faut surtout être patient, minutieux, et avoir envie de créer. Tu verras aussi qu’être créatif et savoir travailler avec les autres est super important, car beaucoup de projets se font en équipe. Et bien sûr, avoir une certaine passion pour le travail du bois.
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
                    <a href="Menuprincipal.php" class="MenuLien">Menu</a>
                    <a href="ProjetCommun.php" class="MenuLien">ProjetCommun</a>
                    <a href="ProjetPersonnel.php" class="MenuLien">ProjetPersonnel</a>

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
    
    <footer>©Eros Corona</footer>
    <script src="Total.JS"></script>
</body>
</html