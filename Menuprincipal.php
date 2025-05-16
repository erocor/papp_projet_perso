<?php
session_start();
include("bd.php"); // Connexion à la base de données

// Permet d'entrer uniquement si l'utilisateur vient depuis Menu.php
$referer = $_SERVER['HTTP_REFERER'] ?? '';

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

/* =========================================================================
   AVIS : TRAITEMENT DU FORMULAIRE
   ========================================================================= */
if (isset($_POST['submit_avis'])) {
    // Récupère et sécurise les données du formulaire
    $pseudo = isset($_POST['pseudo']) ? trim($_POST['pseudo']) : null;
    $commentaire = isset($_POST['commentaire']) ? trim($_POST['commentaire']) : null;
    $etoile = isset($_POST['etoiles']) ? (int) $_POST['etoiles'] : null;

    try {
        // Insertion de l'avis dans la base de données
        $query = "INSERT INTO avis (pseudo, commentaire, étoile) VALUES (:pseudo, :commentaire, :etoile)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':pseudo', $pseudo);
        $stmt->bindParam(':commentaire', $commentaire);
        $stmt->bindParam(':etoile', $etoile, PDO::PARAM_INT);

        // Redirection selon le résultat de l’insertion
        if ($stmt->execute()) {
            header("Location: Menuprincipal.php?success=1");
            exit();
        } else {
            header("Location: Menuprincipal.php?error=1");
            exit();
        }
    } catch (PDOException $e) {
        echo "Erreur SQL : " . $e->getMessage();
        exit;
    }
}

/* =========================================================================
   AVIS : MOYENNE DES ÉTOILES
   ========================================================================= */
$query_moyenne = "SELECT AVG(étoile) AS moyenne_etoiles FROM avis";
$stmt_moyenne = $conn->prepare($query_moyenne);
$stmt_moyenne->execute();
$result = $stmt_moyenne->fetch(PDO::FETCH_ASSOC);

// Arrondit la moyenne à une décimale
$moyenne_etoiles = round($result['moyenne_etoiles'], 1);

/* =========================================================================
   AVIS : AFFICHAGE DE TOUS LES AVIS
   ========================================================================= */
$query_avis = "SELECT id, pseudo, commentaire, étoile, DATE_FORMAT(date_avis, '%d.%m.%Y à %Hh%i') as date_formatee 
               FROM avis 
               ORDER BY date_avis DESC";
$stmt_avis = $conn->prepare($query_avis);
$stmt_avis->execute();

$referer = $_SERVER['HTTP_REFERER'] ?? '';

// Récupère tous les avis sous forme de tableau associatif
$avis_list = $stmt_avis->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Preapprentissage</title>
    <link rel="stylesheet" href="Menuprincipal.css"> <!-- Feuille de style -->
</head>
<body>

<!-- ======================== HEADER : Logo + Menu ======================== -->
<header>
    <div class="Courbe">
        <!-- Logo de l'ETML -->
        <img src="Image+Audio-Projet-Personnel/etml_-_Copie-removebg-preview.png" width="225px" alt="Logo ETML">
    </div>
    <!-- Bouton en dehors de la courbe, mais toujours dans le header -->
    <div class="BoutonContainer">
        <button class="bouton" onclick="window.location.href='Menu.php'">Retour</button>
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
<!-- ===================== CONTENU PRINCIPAL ===================== -->
<div id="Position">
    <h1 id="Titre">PREAPPRENTISSAGE</h1>
    <div class="Text">
        <p>
        C’est quoi le préapprentissage à l’ETML? Le préapprentissage permet de préciser le choix du métier que vous souhaitez exercer plus tard.
         Vous allez passer un mois dans chaque domaine avec un encadrant de chaque métier : que ce soit en informatique, en polymécanique, en électronique et ébeniste.
         Chaque semaine, vous recevrez un rapport de stage rédigé par vos encadrants et à la fin du mois de stage, il y a un rapport de stage réuni, très détaillé avec tous les critères réussis.
        </p>
        <!-- Images illustratives -->
        <img src="Image+Audio-Projet-Personnel/OP-removebg-preview.png" width="350px" alt="Préapprentissage Image 1">
        <img src="Image+Audio-Projet-Personnel/Shéma.png" width="350px" alt="Préapprentissage Image 2">
        <p> En Savoir plus...</p>
        <div class="Lien_Acivité">
        <!-- Liens vers d'autres activités -->
        <button><a href="Camp.php" id="ActivitéLien">Camp</a></button>
        <button><a href="Entretien.php" id="ActivitéLien">Entretien fictif</a></button>
        <button><a href="Epreuve.php" id="ActivitéLien">Epreuve</a></button>
        <button><a href="Théatre.php" id="ActivitéLien">Théatre</a></button>
        </div>

    </div>
</div>

<!-- ===================== MOYENNE DES ÉTOILES ===================== -->
<div class="moyenne_etoiles">
    <h3 id="Moyenne_Etoile1"><?php echo $moyenne_etoiles; ?> / 5 ⭐</h3>
</div>

<!-- ===================== AVIS : FORMULAIRE + AFFICHAGE ===================== -->
<div class="form-container">

    <!-- Formulaire d'envoi d'un avis -->
    <div class="left-container">
        <form method="POST" action="Menuprincipal.php">
            <input type="text" name="pseudo" placeholder="Votre pseudo" required><br>
            <textarea name="commentaire" placeholder="Votre commentaire" required></textarea><br>

            <!-- Étoiles interactives (JS pour choisir la note) -->
            <div class="etoiles" id="etoiles">
                <span data-value="1">★</span>
                <span data-value="2">★</span>
                <span data-value="3">★</span>
                <span data-value="4">★</span>
                <span data-value="5">★</span>
            </div><br>

            <!-- Champ caché pour envoyer la note choisie -->
            <input type="hidden" name="etoiles" id="etoilesInput" value="1">

            <!-- Bouton d'envoi -->
            <button type="submit" name="submit_avis">Envoyer l'avis</button>
        </form>
    </div>

    <!-- Affichage de tous les avis -->
    <div class="right-container">
        <h3>Commentaires :</h3>

        <?php foreach ($avis_list as $avis): ?>
            <div class="avis-item">
                <!-- Pseudo + Date -->
                <p><strong><?php echo htmlspecialchars($avis['pseudo']); ?></strong> (<?php echo $avis['date_formatee']; ?>)</p>

                <!-- Commentaire (avec retour à la ligne) -->
                <p><?php echo nl2br(htmlspecialchars($avis['commentaire'])); ?></p>

                <!-- Note étoile -->
                <p id="Moyenne_Etoile"><?php echo $avis['étoile']; ?> / 5 ⭐</p>

                <!-- Lien de suppression visible uniquement pour l'admin -->
                <?php if ($is_admin): ?>
                    <a href="Menuprincipal.php?delete_avis_id=<?php echo $avis['id']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet avis ?');">Supprimer</a>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- ===================== PIED DE PAGE ===================== -->
<footer>©Eros Corona</footer>

<!-- Script JavaScript (pour les étoiles probablement) -->
<script src="Total.JS"></script>

</body>
</html>