<?php
include '../db.php'; // Include your database connection (adjusted path)

// Fetch all members
$query = "SELECT * FROM members";
$stmt = $conn->prepare($query);
$stmt->execute();
$members = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify Members</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <div class="content">
        <h2>Manage Members</h2>
        <button id="addMemberBtn">Add New Member</button>
        
        <!-- Members Table -->
        <table id="membersTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Birthday</th>
                    <th>Role</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($members as $member): ?>
                <tr>
                    <td><?php echo $member['id']; ?></td>
                    <td><?php echo htmlspecialchars($member['first_name']); ?></td>
                    <td><?php echo htmlspecialchars($member['last_name']); ?></td>
                    <td><?php echo htmlspecialchars($member['email']); ?></td>
                    <td><?php echo htmlspecialchars($member['phone']); ?></td>
                    <td><?php echo htmlspecialchars($member['address']); ?></td>
                    <td><?php echo htmlspecialchars($member['birthday']); ?></td>
                    <td><?php echo htmlspecialchars($member['role']); ?></td>
                    <td>
                        <?php if ($member['image']): ?>
                            <img src="../uploads/<?php echo htmlspecialchars($member['image']); ?>" alt="Profile Image" style="width: 50px; height: 50px;">
                        <?php else: ?>
                            No Image
                        <?php endif; ?>
                    </td>
                    <td>
                        <button class="edit-btn" data-id="<?php echo $member['id']; ?>">Edit</button>
                        <button class="delete-btn" data-id="<?php echo $member['id']; ?>">Delete</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Add/Edit Member Modal -->
    <div id="memberModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2 id="modalTitle">Add New Member</h2>
            <form id="memberForm" method="POST" action="../templates/save_member.php" enctype="multipart/form-data">
                <input type="hidden" id="memberId" name="member_id">
                <label for="first_name">First Name:</label>
                <input type="text" id="first_name" name="first_name" required>

                <label for="last_name">Last Name:</label>
                <input type="text" id="last_name" name="last_name" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="phone">Phone:</label>
                <input type="text" id="phone" name="phone">

                <label for="address">Address:</label>
                <textarea id="address" name="address"></textarea>

                <label for="birthday">Birthday:</label>
                <input type="date" id="birthday" name="birthday" required>

                <label for="role">Role:</label>
                <input type="text" id="role" name="role">

                <label for="image">Profile Image:</label>
                <input type="file" id="image" name="image">

                <input type="submit" value="Save">
            </form>
        </div>
    </div>

    <script src="../assets/js/script.js"></script>
    <script>
        // Open Modal for Add/Edit
        document.getElementById('addMemberBtn').addEventListener('click', function() {
            document.getElementById('memberModal').style.display = 'block';
            document.getElementById('modalTitle').textContent = 'Add New Member';
            document.getElementById('memberForm').reset();
            document.getElementById('memberId').value = '';
        });

        document.querySelectorAll('.edit-btn').forEach(function(button) {
            button.addEventListener('click', function() {
                var id = this.getAttribute('data-id');
                fetch('../templates/get_member.php?id=' + id)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('memberModal').style.display = 'block';
                        document.getElementById('modalTitle').textContent = 'Edit Member';
                        document.getElementById('memberId').value = data.id;
                        document.getElementById('first_name').value = data.first_name;
                        document.getElementById('last_name').value = data.last_name;
                        document.getElementById('email').value = data.email;
                        document.getElementById('phone').value = data.phone;
                        document.getElementById('address').value = data.address;
                        document.getElementById('birthday').value = data.birthday;
                        document.getElementById('role').value = data.role;
                        // Handle image preview
                        if (data.image) {
                            // Add logic to show the image if needed
                        }
                    });
            });
        });

        document.querySelectorAll('.delete-btn').forEach(function(button) {
            button.addEventListener('click', function() {
                var id = this.getAttribute('data-id');
                if (confirm('Are you sure you want to delete this member?')) {
                    fetch('../templates/delete_member.php?id=' + id)
                        .then(response => response.text())
                        .then(result => {
                            if (result === 'success') {
                                location.reload();
                            } else {
                                alert('Error deleting member');
                            }
                        });
                }
            });
        });

        // Close Modal
        var modal = document.getElementById("memberModal");
        var closeBtn = document.querySelector(".modal-content .close");
        closeBtn.onclick = function() {
            modal.style.display = "none";
        }
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>
</html>
