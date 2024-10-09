<?php
// Include database connection
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $birthday = $_POST['birthday'];
    $role = $_POST['role'];
    
   // Handle file upload
$uploadFile = null;
if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == UPLOAD_ERR_OK) {
    $uploadDir = 'uploads/'; // Relative path for web access
    $uploadFile = $uploadDir . basename($_FILES['profile_image']['name']);
    
    // Check if the directory exists
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true); // Create the directory if it doesn't exist
    }

    if (move_uploaded_file($_FILES['profile_image']['tmp_name'], __DIR__ . '/' . $uploadFile)) {
        // Store only the relative path or filename in the database
    } else {
        echo "File upload failed.";
        exit;
    }
}

// Insert data into database
$stmt = $pdo->prepare("INSERT INTO members (first_name, last_name, email, phone, address, birthday, role, profile_image) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->execute([$firstName, $lastName, $email, $phone, $address, $birthday, $role, $uploadFile]);

    // Redirect or show success message
    header('Location: index.php'); // Redirect to index.php or another page
    exit;
}
?>
