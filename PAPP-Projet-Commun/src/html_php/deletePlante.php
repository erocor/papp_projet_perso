<?php

include("db.php");
session_start();

if(!isset($_SESSION["user"])){
    header("location:index.php");
    exit();
    }

if (isset($_GET['id'])) {
    $id = $_GET['id'];  // Récupère l'ID de la plante à supprimer
    $query = "DELETE FROM plante WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    header("Location:menu_site_projet.php");
}

?>