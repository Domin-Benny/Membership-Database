<?php
include './assets/includes/db.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM members WHERE id = ?");
$stmt->execute([$id]);
$member = $stmt->fetch();

if ($member) {
    echo '<h2>Edit Member</h2>';
    echo '<form id="editMemberForm" method="POST" action="./assets/templates/save_member.php" enctype="multipart/form-data">';
    echo '<input type="hidden" name="member_id" value="'.htmlspecialchars($member['id']).'">';
    echo '<label for="first_name">First Name:</label>';
    echo '<input type="text" id="first_name" name="first_name" value="'.htmlspecialchars($member['first_name']).'" required>';
    echo '<label for="last_name">Last Name:</label>';
    echo '<input type="text" id="last_name" name="last_name" value="'.htmlspecialchars($member['last_name']).'" required>';
    echo '<label for="email">Email:</label>';
    echo '<input type="email" id="email" name="email" value="'.htmlspecialchars($member['email']).'" required>';
    echo '<label for="phone">Phone:</label>';
    echo '<input type="text" id="phone" name="phone" value="'.htmlspecialchars($member['phone']).'">';
    echo '<label for="address">Address:</label>';
    echo '<textarea id="address" name="address">'.htmlspecialchars($member['address']).'</textarea>';
    echo '<label for="birthday">Birthday:</label>';
    echo '<input type="date" id="birthday" name="birthday" value="'.htmlspecialchars($member['birthday']).'" required>';
    echo '<label for="role">Role:</label>';
    echo '<input type="text" id="role" name="role" value="'.htmlspecialchars($member['role']).'">';
    echo '<label for="image">Profile Image:</label>';
    echo '<input type="file" id="image" name="image">';
    echo '<input type="submit" value="Save">';
    echo '</form>';
} else {
    echo '<p>Member not found.</p>';
}
?>
