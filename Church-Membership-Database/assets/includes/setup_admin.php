<?php
include 'db.php'; // Adjust the path if necessary

// Check if there's already an admin in the database
$stmt = $pdo->prepare("SELECT COUNT(*) FROM admins");
$stmt->execute();
$count = $stmt->fetchColumn();

if ($count == 0) {
    // No admin exists, create one
    $username = 'admin'; // Predefined username
    $password = password_hash('admin123', PASSWORD_DEFAULT); // Predefined password
    $email = 'admin@example.com'; // Predefined email
    
    $stmt = $pdo->prepare("INSERT INTO admins (username, password, email) VALUES (?, ?, ?)");
    $stmt->execute([$username, $password, $email]);
    
    echo "Admin account created successfully.";
} else {
    echo "Admin account already exists.";
}
?>
