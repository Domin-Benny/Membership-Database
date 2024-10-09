<?php
// Database connection settings
$host = 'sql110.infinityfree.com'; // Change if needed
$dbname = 'if0_37138362_church_db'; // Your database name
$username = 'if0_37138362'; // Your MySQL username
$password = 'SqRWbCsJswde'; // Your MySQL password

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
