<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "plantes_db";

require("db.php");

$data = mysqli_connect($host, $user, $password, $db);

if (!$data) {
    die("Erreur de connexion : " . mysqli_connect_error());
}

// Vérification de l'ID passé en paramètre
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']); // Sécurisation de l'ID

    // Requête pour récupérer uniquement la plante sélectionnée
    $sql = "SELECT * FROM plante WHERE id = ?";
    $stmt = mysqli_prepare($data, $sql);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $plante = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);
    } else {
        die("Erreur de requête : " . mysqli_error($data));
    }

    if (!$plante) {
        die("Plante introuvable.");
    }
} else {
    die("ID de la plante non spécifié ou invalide.");
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Description de la plante</title>
    <link rel="stylesheet" href="../ressources/css/description2.css">
</head>

<body>
    <div class="menuLeft">
        <div name="petit_vert" class="mini">
            <div class="menuIcon">
                <a href="creditVisiteur.php" class="menuItem">
                    <img id="credits" src="../ressources/images/Copyright.svg.png">
                </a>
                <a href="histoireVisiteur.php" class="menuItem">
                    <img id="histoire" src="../ressources/images/book.png">
                </a>
                <a href="invite.php" class="menuItem">
                    <img id="House" src="../ressources/images/maison.png">
                </a>
            </div>
            <a class="menuBarreIconContainer">
                <img class="menuBarre" src="../ressources/images/menuprojet.png">
            </a>
        </div>
    </div>

    <h1 id="titre">Répertoire des plantes</h1>

    <div id="vert">
        <div id="bulle">
            <?php if (!empty($plante['libelle'])): ?>
                <img width="200px" height="200px" class="image" src="<?php echo htmlspecialchars($plante['libelle']); ?>">
            <?php else: ?>
                <p>Aucune image disponible.</p>
            <?php endif; ?>

            <h2 class='texte'>Nom :<?php echo htmlspecialchars($plante['Nom']); ?></h2>
            <h2 class="texte">Humidité : <?php echo htmlspecialchars($plante['Humidité']); ?>%</h2>
            <h2 class="texte">Arrosage : <?php echo htmlspecialchars($plante['Arrosage']); ?></h2>
            <h2 class="texte">Température Min : <?php echo htmlspecialchars($plante['Temperature_min']); ?>°C</h2>
            <h2 class="texte">Température Max : <?php echo htmlspecialchars($plante['Temperature_max']); ?>°C</h2>
        </div>

        <div id="bulle2">
            <h2 class="texte"><?php echo nl2br(htmlspecialchars($plante['Description'])); ?></h2>
        </div>
    </div>

    <script src="../ressources/js/menu.js"></script>
</body>

</html>
