<?php
session_start();
session_unset(); // Supprime toutes les variables de session
session_destroy(); // Détruit la session
header("Location: menu.php"); // Redirige l'utilisateur vers le menu après la déconnexion
exit();
?>