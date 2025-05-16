<?php
$host = "localhost";
$dbname = "système_avis";  // même base que les avis, sauf si tu en veux deux
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion admin : " . $e->getMessage();
}
?>