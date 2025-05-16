<?php
// Database connection using PDO
$host = 'localhost';
$dbname = 'plantes_db';
$username = 'root';  // Replace with your actual database username if not 'root'
$password = '';      // Replace with your actual password if necessary

try {
    // Create a PDO instance and set error mode to exceptions
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Set error mode
} catch (PDOException $e) {
    // Catch connection error and display the message
    echo "Error in connection: " . $e->getMessage();
    exit();
}
?>
