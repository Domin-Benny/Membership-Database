<?php
// Include database connection
include './assets/includes/db.php';

// Fetch members from the database
$stmt = $pdo->query("SELECT profile_image, CONCAT(first_name, ' ', last_name) AS full_name, address, role FROM members");
$members = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="view-members-container">
    <h2>View All Members</h2>
    <table class="view-members-table">
        <thead>
            <tr>
                <th>Profile Image</th>
                <th>Full Name</th>
                <th>Address</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($members as $member): ?>
                <tr>
                    <td>
                        <img src="assets/includes/<?php echo $member['profile_image']; ?>" 
                             alt="Profile Image" class="member-img">
                    </td>
                    <td><?php echo htmlspecialchars($member['full_name']); ?></td>
                    <td><?php echo htmlspecialchars($member['address']); ?></td>
                    <td><?php echo htmlspecialchars($member['role']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

