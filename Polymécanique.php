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
    <link rel="stylesheet" href="Polymécanique.css">
</head>
<div class="Bloc_1">
En polymécanique, vous allez apprendre à fabriquer de petits objets en métal à l’aide de différentes machines et outils. Par exemple, avec mon groupe, nous avons réalisé des étaux, des toupies ainsi qu’un porte-crayon.
</div>

<div class="Bloc_2">
    Les outiles: vous allez utilisé 
</div>

<div class="Bloc_3">
Pour te lancer en polymécanique, pas besoin d’avoir déjà tout compris aux machines : il faut surtout être minutieux, aimer travailler de ses mains et avoir un bon esprit logique. Si t’es du genre à aimer fabriquer des choses concrètes et que t’as un peu de patience.
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
                    <a href="Menuprincipal.php" class="MenuLien">Menu</a>
                    <a href="Ebéniste.php" class="MenuLien">Ebéniste</a>
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
<body >

    <footer>©Eros Corona</footer>
    <script src="Total.JS"></script>
</body>
</html