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
    <link rel="stylesheet" href="Electronique.css">
</head>
<div class="Bloc_1">
En électronique, tu vas apprendre à faire quelques calculs de base, à souder des composants (ce qu’on appelle braser), 
et à utiliser la loi d’Ohm. Ces notions permettent de comprendre comment fonctionne un circuit électrique et comment les différents éléments sont connectés entre eux.
</div>

<div class="Bloc_2">
Voici quelques outils que tu vas utiliser en électronique :
<br><br>
Fer à braser : pour souder les composants sur un circuit imprimé.
<br><br>
Gabarit de pliage : pour plier correctement les pattes des composants avant de les souder.
<br><br>
Pince à brucelles : pour manipuler les petits composants avec précision.
<br><br>
Pince coupante : pour couper les fils ou les pattes des composants après soudure.
<br><br>
Ampèremètre : pour mesurer l’intensité du courant dans un circuit.
<br><br>
Générateur de courant : pour alimenter les circuits et tester leur fonctionnement.
<br><br>
Tu apprendras à les utiliser correctement en atelier, étape par étape.
</div>

<div class="Bloc_3">
Pour bien avancer en électronique, certaines qualités peuvent vraiment t’aider. 
Il faut être un minimum précis, surtout quand tu soudes ou manipules des petits composants. 
La patience est aussi importante, car certains montages demandent du temps et de l’attention. 
Être observateur et avoir le sens du détail, ça aide à repérer les erreurs ou les problèmes dans un circuit. 
Et comme toujours, un peu de curiosité, ça fait la différence.
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
                    <a href="Menuprincipal.php" class="MenuLien">Menu</a>
                    <a href="Polymécanique.php" class="MenuLien">Polymécanique</a>
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