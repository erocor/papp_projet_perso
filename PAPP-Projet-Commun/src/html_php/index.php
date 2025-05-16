<?php
session_start();
include("db.php");

$host="localhost";
$user="root";
$password="";
$db="plantes_db";

$data=mysqli_connect($host,$user,$password,$db);

if($data===false)
{
    die("connection error");
}

$errorMessage = ''; // Initialize the error message variable

if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $username = mysqli_real_escape_string($data, $_POST['user']);
    $password = mysqli_real_escape_string($data, $_POST['fpass']);

    $sql="SELECT * FROM user WHERE username='".$username."' AND password='".$password."'";
    $result=mysqli_query($data, $sql);
    $row=mysqli_fetch_array($result);

    if($result->num_rows == 1)
    {
        $_SESSION['user'] = $username;
        $_SESSION['fpass'] = $password;
        header("Location: menu_site_projet.php");
        exit();
    }
    else
    {
        $errorMessage = "Pseudo ou mot de passe incorrecte"; // Set error message
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../ressources/css/stylesheetIndex.css">
    <title>Log in</title>
</head>
<body>
    <div class="container">
        <!-- Display error message at the top if there's an error -->
        <?php if ($errorMessage): ?>
            <div class="error-message">
                <?php echo $errorMessage; ?>
            </div>
        <?php endif; ?>
        
        <div class="connection">
            <h1>Connexion</h1>
        </div>
        <div class="info">
            <form action="index.php" method="POST">
                <input type="text" class="femail" name="user" placeholder="Utilisateur" required><br><br>
                <input type="password" class="fpass" name="fpass" placeholder="Mot de Passe" required> <br><br>
                <div>
                    <button type="submit" name="submitt" class="enter">Entrer</button>
                    <div class="enterasnonadmin">
                        <a href="invite.php">Entrer comme invité</a>
                    </div>
                </div>
            </form>            
        </div>
    </div>
            <button id="Retour"><a href="/Projet%20personnel/ProjetCommun.php">Retour</a></button>
</body>
</html>