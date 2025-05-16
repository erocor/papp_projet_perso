<?php
$host = "localhost";
$dbname = "système_avis";  // même base (tu peux garder une seule base)
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion avis : " . $e->getMessage();
}
?>