<?php
session_start();
include("db.php"); // Connexion pour admin

// Permet d'entrer uniquement si l'utilisateur vient depuis Menu.php
$referer = $_SERVER['HTTP_REFERER'] ?? '';

if (isset($_POST['login'])) {
    $utilisateur = $_POST['username'];
    $motdepasse = $_POST['password'];

    $query = "SELECT * FROM admin WHERE username = :username";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':username', $utilisateur);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // if ($user && password_verify($motdepasse, $user['password'])) {
    if($user['password'] == $motdepasse){
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['usertype'] = $user['usertype'];
        header("Location: Menuprincipal.php");
        exit();
    } else {
        echo "<p style='color:red;'>Nom d'utilisateur ou mot de passe incorrect.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="connexion.css">
</head>
<body>
    <button class="bouton" onclick="window.location.href='Menuprincipal.php'">Retour</button>
    <div class="Bloc">
        <img class="Icone" src="https://static.vecteezy.com/ti/vecteur-libre/p2/566937-icone-de-personne-gratuit-vectoriel.jpg" alt="Icône utilisateur">
        <form method="POST" action="connexion.php">
            <div>
                <label for="username">Nom d'utilisateur :</label>
                <input type="text" id="username" name="username" required />
            </div>
            
            <div>
                <label for="pass">Mot de passe :</label>
                <input type="password" id="pass" name="password" required />
            </div>
            
            <button type="submit" class="Connexion" name="login">Connecter</button>
            
        </form>
    </div>      

    <script src="Total.JS"></script>    
</body>
</html>