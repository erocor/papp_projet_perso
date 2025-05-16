<?php
session_start();
include("bd.php"); // Connexion à la base de données

// Vérifie si l'utilisateur est un administrateur
$is_admin = isset($_SESSION['usertype']) && $_SESSION['usertype'] === 'ETML';

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
    <link rel="stylesheet" href="informatique.css">
</head>
<div class="Bloc_1">
En informatique, tu vas découvrir deux domaines : 
<br><br>    
le développement (créer des sites, applis, etc.) et 
<br>
l’infrastructure (installer, connecter, faire fonctionner les systèmes et les réseaux). 
<br><br>
Pas besoin d’être un pro pour commencer : ici, tu apprends petit à petit, en pratiquant.
</div>

<div class="Bloc_2">
Côté développement, tu vas apprendre à utiliser des aplications et plusieurs langages :
<br>
<br>
Visual Studio Code: Cette aplication permet sutout utiliser des langages pour des site comme html, css et php permet
<br>
<br>
HTML : il permet de créer la structure d’un site internet, un peu comme les fondations d’une maison.
<br>
<br>
CSS : il sert à styliser le site, à choisir les couleurs, les polices, la mise en page — bref, à le rendre joli.
<br>
<br>
PHP : lui, il est utilisé pour rendre les sites interactifs, comme gérer des formulaires, des connexions, ou du contenu dynamique.
<br>
<br>
Visual Studio : La diffrence avec le visual studio code celui-la permet de faire des aplications ou des jeux.
<br>
<br>
C# : ce langage est souvent utilisé pour créer des applications (comme des logiciels ou des jeux), surtout sur Windows.
</div>
<div class="Image">
<img src="Image+Audio-Projet-Personnel/visual-studio-code-removebg-preview.png">
<img src="Image+Audio-Projet-Personnel/HTML5_logo_and_wordmark.svg-removebg-preview.png">
<img src="Image+Audio-Projet-Personnel/th-removebg-preview (1).png">
<img src="Image+Audio-Projet-Personnel/PHP-logo.svg-removebg-preview.png">
</div>


<div class="Bloc_3">
Côté infrastructure, tu vas aussi découvrir des outils pratiques comme :
<br>
<br>
VirtualBox : un logiciel qui te permet de créer des machines virtuelles, c’est-à-dire des ordinateurs « fictifs » que tu peux tester sans rien casser sur ton vrai PC.
<br>
<br>
XAMPP : un outil qui installe facilement un serveur web sur ton ordi. Il te permet de faire tourner des sites localement (sans connexion internet), comme si ton ordi était un petit serveur.
<br>
<br>
Ces outils te permettent de comprendre comment fonctionnent les coulisses de l’informatique — et t'entraînent à gérer des systèmes.
</div>
<div class="Image_1">
    <img src="Image+Audio-Projet-Personnel/OIP-removebg-preview.png">
    <img src="Image+Audio-Projet-Personnel/XAMPP-removebg-preview.png">
</div>


<div class="Bloc_4">
Pour te lancer en informatique, pas besoin d’être un génie : il faut surtout être curieux, patient, et avoir envie d’apprendre. Tu verras aussi que savoir travailler en groupe est super important, parce que beaucoup de projets se font en équipe. Et bien sûr, avoir un minimum d’intérêt pour l’informatique.
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
                    <a href="Menuprincipal.php" class="MenuLien">Menu</a>
                    <a href="Electronique.php" class="MenuLien">Electronique</a>
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

    <script src="Total.JS"></script>

    <footer>©Eros Corona</footer>
</html