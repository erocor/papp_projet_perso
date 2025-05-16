<?php
include("bd.php");
session_start();

if(!isset($_SESSION["user"])){
    header("location:Connexion.php");
    exit();
    }

if (isset($_GET['id'])) {
    $id = $_GET['id'];  // Récupère l'ID de la plante à supprimer
    $query = "DELETE FROM avis WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    header("Location:Menuprincipal.php");
}
?>