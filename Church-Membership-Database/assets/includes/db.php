<?php
// Database connection settings
$host = 'localhost'; // Change if needed
$dbname = 'arc-church'; // Your database name
$username = 'root'; // Your MySQL username
$password = ''; // Your MySQL password

// Create a connection
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}
?>
