<?php
include './db.php';

$memberId = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM members WHERE id = :id");
$stmt->bindParam(':id', $memberId);
$stmt->execute();

$member = $stmt->fetch(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($member);
?>
