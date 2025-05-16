<?php
include("db.php");
session_start();

/*if(!isset($_SESSION["user"])){
    header("location:index.php");
    exit();
    }*/
 
    if (isset($_POST['add_plante'])) {
        $nom = trim($_POST['nom']);
        $humidite = trim($_POST['humidite']);
        $arrosage = trim($_POST['arrosage']);
        $temp_min = trim($_POST['temp_min']);
        $temp_max = trim($_POST['temp_max']);
        $description = trim($_POST['description']);
        
        
        // Validation simple
        if (empty($nom) || empty($type) || empty($humidite) || empty($arrosage)) {
            echo "Tous les champs sont obligatoires.";
        } else {
            // Requête d'insertion
            $query = "INSERT INTO plante (Nom, Humidité, Arrosage, Temperature_min, Temperature_max, Description)
                      VALUES (:nom, :type, :humidite, :arrosage, :temp_min, :temp_max, :description)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':humidite', $humidite);
            $stmt->bindParam(':arrosage', $arrosage);
            $stmt->bindParam(':temp_min', $temp_min);
            $stmt->bindParam(':temp_max', $temp_max);
            $stmt->bindParam(':description', $description);
            $stmt->execute();
        }
    }

    // Supprimer une plante
if (isset($_POST['delete_plante']) && isset($_POST['id'])) {
    $id = $_POST['id'];  // Récupère l'ID de la plante à supprimer
    $query = "DELETE FROM plante WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Répertoire de plantes</title>
    <link rel="stylesheet" href="..\ressources\css\menu_site_projet.css"/>
</head>
<body>
    <div id="title">
        <div class="menuRight">
            <h1 id="pageTitle">Répertoire de plantes</h1>
        </div>
        <div class="menuLeft">
        <a class="Deconnexion" href="index.php"><h1 class ="decotxt"id ="decoTxt">connexion</h1></a>
            <div class="mini">
                <div class="menuIcon">
                    <a href="creditVisiteur.php" class="menuItem">
                        <img id="credits" src="..\ressources\images\Copyright.svg.png">
                    </a>
                    <a href="histoireVisiteur.php" class="menuItem">
                        <img id="histoire" src="..\ressources\images\book.png" class="menuItemImage">
                    </a>
                </div>
                <a href="#" class="menuBarreIconContainer">
                    <img class="menuBarre" src="..\ressources\images\menuprojet.png">
                </a>
            </div>
        </div>
    </div>

    <div class="vert">
        <?php
        $query = "SELECT * FROM plante";
        $stmt = $conn->query($query);
        $plantes = $stmt->fetchAll();

        foreach ($plantes as $plante) {
            ?>
            <div class='plante'>
                <a href="des"></a>
                <h3><?php echo htmlspecialchars($plante['Nom']); ?></h3>
                <a href="descriptionVisiteur.php?id=<?php echo $plante['id']?>"> 
                    <?php if (!empty($plante['libelle'])): ?>
                        <img src="<?php echo htmlspecialchars($plante['libelle']); ?>" alt="Image de la plante" width="180px" height="150px">
                    <?php else: ?>
                        <p>Aucune image disponible.</p>
                    <?php endif; ?>
                </a>
            </div>
            <?php
        }
        ?>
    </div>

    <script src="..\ressources\js\menu.js"></script>
</body>
</html>