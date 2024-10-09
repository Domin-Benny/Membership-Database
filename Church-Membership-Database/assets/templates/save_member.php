<?php
include './assets/includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $memberId = $_POST['member_id'];
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $birthday = $_POST['birthday'];
    $role = $_POST['role'];
    $image = $_FILES['image'];

    // Handle image upload if a file is provided
    $imageName = null;
    if ($image['name']) {
        $targetDir = "../uploads/";
        $imageName = basename($image['name']);
        $targetFile = $targetDir . $imageName;
        move_uploaded_file($image['tmp_name'], $targetFile);
    }

    if ($memberId) {
        // Update existing member
        $stmt = $conn->prepare("UPDATE members SET first_name = ?, last_name = ?, email = ?, phone = ?, address = ?, birthday = ?, role = ?, image = ? WHERE id = ?");
        $stmt->execute([$firstName, $lastName, $email, $phone, $address, $birthday, $role, $imageName ?: $member['image'], $memberId]);
    } else {
        // Insert new member
        $stmt = $conn->prepare("INSERT INTO members (first_name, last_name, email, phone, address, birthday, role, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$firstName, $lastName, $email, $phone, $address, $birthday, $role, $imageName]);
    }

    header('Location: ../index.php'); // Redirect to the main page
    exit();
}
?>
