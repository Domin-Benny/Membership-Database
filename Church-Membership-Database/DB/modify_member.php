<?php
include './assets/includes/db.php';

// Fetch members from the database
$stmt = $pdo->prepare("SELECT * FROM members");
$stmt->execute();
$members = $stmt->fetchAll();
?>

<div class="modify-member-container">
    <h2>Modify Members</h2>
    <table>
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Birthday</th>
                <th>Role</th>
                <th>Profile Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($members as $member) : ?>
            <tr>
                <td><?= htmlspecialchars($member['first_name']) ?></td>
                <td><?= htmlspecialchars($member['last_name']) ?></td>
                <td><?= htmlspecialchars($member['email']) ?></td>
                <td><?= htmlspecialchars($member['phone']) ?></td>
                <td><?= htmlspecialchars($member['address']) ?></td>
                <td><?= htmlspecialchars($member['birthday']) ?></td>
                <td><?= htmlspecialchars($member['role']) ?></td>
                <td><img src="assets/includes/<?php echo $member['profile_image']; ?>" alt="Profile" width="50"></td>
                <td>
                    <button onclick="editMember(<?= $member['id'] ?>)">Edit</button>
                    <button onclick="deleteMember(<?= $member['id'] ?>)">Delete</button>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
