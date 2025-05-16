<?php
include("db.php");

session_start();
if (!isset($_SESSION["user"])) {
    header("location:index.php");
    exit();
}

if (isset($_POST['accepter'])) {
    $id = isset($_POST['id']) ? $_POST['id'] : null; // Vérifier si on modifie une plante existante
    $nom = $_POST['nom'];
    $humidite = $_POST['humidite'];
    $arrosage = $_POST['arrosage'];
    $temp_min = $_POST['temp_min'];
    $temp_max = $_POST['temp_max'];
    $description = $_POST['description'];

    $target_directory = "image/"; // Dossier où stocker les images

    // Vérifier et créer le dossier si nécessaire
    if (!is_dir($target_directory)) {
        mkdir($target_directory, 0777, true);
    }

    // Vérifier si on est en mode modification et récupérer l'image existante
    $existing_image = null;
    if ($id) {
        $stmt = $conn->prepare("SELECT libelle FROM plante WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $existing_image = $stmt->fetchColumn();
    }

    // Vérifier si une nouvelle image est envoyée
    if (!empty($_FILES["image_file"]["tmp_name"])) {
        $file_basename = pathinfo($_FILES["image_file"]["name"], PATHINFO_FILENAME);
        $file_extension = pathinfo($_FILES["image_file"]["name"], PATHINFO_EXTENSION);
        $new_image_name = $file_basename . '_' . date("Ymd_His") . '.' . $file_extension;
        $target_path = $target_directory . $new_image_name; // Chemin complet

        // Supprimer l'ancienne image si elle existe et éviter la répétition
        if ($existing_image && file_exists($existing_image)) {
            unlink($existing_image);
        }

        // Déplacer la nouvelle image
        if (move_uploaded_file($_FILES["image_file"]["tmp_name"], $target_path)) {
            $image_path_db = $target_path;
        } else {
            header("Location:AjoutsDePlantes.php?message=er"); // Erreur d'upload
            exit();
        }
    } else {
        // Conserver l'ancienne image ou mettre une image par défaut
        $image_path_db = $existing_image ?: 'image/default.jpg';
    }

    // Vérifier si on est en mode modification ou ajout
    if ($id) {
        // Mettre à jour la plante existante
        $query = "UPDATE plante SET Nom = :nom, Humidité = :humidite, Arrosage = :arrosage, 
                  Temperature_min = :temp_min, Temperature_max = :temp_max, 
                  Description = :description, libelle = :image WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
    } else {
        // Insérer une nouvelle plante
        $query = "INSERT INTO plante (Nom, Humidité, Arrosage, Temperature_min, Temperature_max, Description, libelle) 
                  VALUES (:nom, :humidite, :arrosage, :temp_min, :temp_max, :description, :image)";
        $stmt = $conn->prepare($query);
    }

    // Liaison des paramètres
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':humidite', $humidite);
    $stmt->bindParam(':arrosage', $arrosage);
    $stmt->bindParam(':temp_min', $temp_min);
    $stmt->bindParam(':temp_max', $temp_max);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':image', $image_path_db);

    if ($stmt->execute()) {
        header("Location: menu_site_projet.php");
        exit();
    } else {
        header("Location:AjoutsDePlantes.php?message=no");
        exit();
    }
    
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouts de plantes</title>
    <link rel="stylesheet" href="../ressources/css/stylesheetAjoutsPlantes.css">
</head>

<body>
    <div class="formm">
        <div class="bulle">
            <form method="POST" enctype="multipart/form-data">
                <!-- Nom de la plante -->
                <div class="hautdepage">
                    <h1>Ajout de Plantes</h1>
                    <input type="text" name="nom" placeholder="Nom de la plante" required>
                </div>
                <!-- Description de la plante -->
                <div class="description">
                    <textarea name="description" placeholder="Description" required></textarea>
                </div>
                <!-- Image de la plante -->
                <div class="image-container">
                    <button type="button" id="insert-image-btn" class="image-button" onclick="triggerFileInput()">
                        <?php if (!empty($row['libelle'])): ?>
                            <img id="preview" src="<?php echo $row['libelle']; ?>" alt="Aperçu de l'image">
                        <?php else: ?>
                            Insérer une image
                        <?php endif; ?>
                    </button>
                    <input type="file" id="file-input" name="image_file" style="display: none;" onchange="previewImage(event)">
                </div>
                <!-- Température, arrosage et humidité de la plante -->
                <input type="text" name="temp_min" placeholder="Température min" required>
                <input type="text" name="temp_max" placeholder="Température max" required>
                <input type="text" name="arrosage" placeholder="Arrosage" required>
                <input type="text" name="humidite" placeholder="Humidité" required>
                <!-- Accepter -->
                <div class="accept">
                    <button type="submit" name="accepter" id="accepter">Ajouter</button>
                </div>
            </form>
            <!-- Retour -->
            <div class="retour">
                <a href="menu_site_projet.php">
                    <button class="retour">Retour</button>
                </a>
            </div>
        </div>
    </div>        
    <script>
        src="../ressources/js/js.js"
        function triggerFileInput() {
            document.getElementById('file-input').click();
        }

        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function () {
                var button = document.getElementById('insert-image-btn');
                var img = document.getElementById('preview');

                if (!img) {
                    img = document.createElement('img');
                    img.id = "preview";
                    button.innerHTML = ''; // Supprime le texte
                    button.appendChild(img);
                }

                img.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</body>

</html>
