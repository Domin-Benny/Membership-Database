<?php
session_start();
include './db.php';

$data = json_decode(file_get_contents('php://input'), true);
$memberId = $data['id'] ?? null;
$adminPassword = $data['password'] ?? '';

if ($memberId && $adminPassword) {
    // Fetch the admin's stored password hash
    $adminId = $_SESSION['admin_id']; // Assuming the admin is logged in and their ID is stored in the session
    $query = "SELECT password FROM admins WHERE id = :admin_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':admin_id', $adminId, PDO::PARAM_INT);
    $stmt->execute();
    $storedPasswordHash = $stmt->fetchColumn();

    if ($storedPasswordHash && password_verify($adminPassword, $storedPasswordHash)) {
        // If password is correct, proceed to delete the member
        $deleteQuery = "DELETE FROM members WHERE id = :member_id";
        $deleteStmt = $pdo->prepare($deleteQuery);
        $deleteStmt->bindParam(':member_id', $memberId, PDO::PARAM_INT);

        if ($deleteStmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Database error: Unable to delete member']);
        }
    } else {
        // If the password is incorrect or admin not found
        echo json_encode(['success' => false, 'error' => 'Invalid admin password or admin not found']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Missing member ID or admin password']);
}
?>
