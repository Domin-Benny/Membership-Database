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
                <th>Title</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($members as $member): ?>
                <tr>
                    <td><?= htmlspecialchars($member['title']); ?></td>
                    <td><?= htmlspecialchars($member['first_name']); ?></td>
                    <td><?= htmlspecialchars($member['middle_name']); ?></td>
                    <td><?= htmlspecialchars($member['last_name']); ?></td>
                    <td><?= htmlspecialchars($member['email']); ?></td>
                    <td><?= htmlspecialchars($member['phone']); ?></td>
                    <td>
                        <button class="edit-btn" data-id="<?= htmlspecialchars($member['id']); ?>">Edit</button>
                        <button class="delete-btn" data-id="<?= htmlspecialchars($member['id']); ?>">Remove</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Member Registration and Edit Modal -->
<div id="registerMemberModallle" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Member Form</h2>
        <form id="registerFormmme" method="POST" action="./assets/includes/edit_member.php" enctype="multipart/form-data">
            <input type="hidden" id="member_id" name="member_id">

            <!-- Title -->
            <label for="title">Title:</label>
            <select id="title" name="title" required>
                <option value="Mr.">Mr.</option>
                <option value="Mrs.">Mrs.</option>
                <option value="Miss">Miss</option>
                <option value="Dr.">Dr.</option>
                <option value="Prof.">Prof.</option>
                <option value="Rev.">Rev.</option>
                <option value="Sir">Sir</option>
                <option value="Madam">Madam</option>
            </select>

            <!-- First Name -->
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" required>
            
            <!-- Middle Name -->
            <label for="middle_name">Middle Name:</label>
            <input type="text" id="middle_name" name="middle_name">

            <!-- Last Name -->
            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" required>

            <!-- Email -->
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <!-- Primary Phone -->
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" required>

            <!-- Additional Phone Numbers -->
            <label for="additional_phones">Additional Phone Numbers:</label>
            <textarea id="additional_phones" name="additional_phones" placeholder="Separate multiple contacts with commas"></textarea>

            <!-- Address -->
            <label for="address">Address:</label>
            <textarea id="address" name="address"></textarea>

            <!-- Birthday -->
            <label for="birthday">Birthday:</label>
            <input type="date" id="birthday" name="birthday" required>

            <!-- Gender -->
            <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>

            <!-- Role -->
            <label for="role">Role:</label>
            <input type="text" id="role" name="role">

            <!-- Profile Image -->
            <label for="profile_image">Profile Image:</label>
            <input type="file" id="profile_image" name="profile_image" accept="image/*">

            <!-- Occupation / Institution (if student) -->
            <label for="occupation">Occupation:</label>
            <input type="text" id="occupation" name="occupation" required>
            <div id="institutionField">
                <label for="institution">Institution (if student):</label>
                <input type="text" id="institution" name="institution">
            </div>

            <!-- Father's Name and Status -->
            <label for="father_name">Father's Name:</label>
            <input type="text" id="father_name" name="father_name">
            <label for="father_status">Father's Status:</label>
            <select id="father_status" name="father_status">
                <option value="Alive">Alive</option>
                <option value="Deceased">Deceased</option>
            </select>

            <!-- Mother's Name and Status -->
            <label for="mother_name">Mother's Name:</label>
            <input type="text" id="mother_name" name="mother_name">
            <label for="mother_status">Mother's Status:</label>
            <select id="mother_status" name="mother_status">
                <option value="Alive">Alive</option>
                <option value="Deceased">Deceased</option>
            </select>

            <!-- Marital Status -->
            <label for="marital_status">Marital Status:</label>
            <select id="marital_status" name="marital_status">
                <option value="Single">Single</option>
                <option value="Married">Married</option>
                <option value="Divorced">Divorced</option>
                <option value="Widowed">Widowed</option>
            </select>

            <!-- Spouse Name -->
            <div id="spouseField">
                <label for="spouse_name">Spouse Name:</label>
                <input type="text" id="spouse_name" name="spouse_name">
            </div>

            <!-- Spouse Contact -->
            <label for="spouse_contact">Spouse Contact:</label>
            <input type="text" id="spouse_contact" name="spouse_contact">

            <!-- Number of Children -->
            <label for="children_number">Number of Children:</label>
            <input type="number" id="children_number" name="children_number" min="0">

            <!-- Accept Jesus Christ as Saviour -->
            <label for="accepted_jesus">Accepted Jesus Christ as Personal Saviour and Lord?</label>
            <select id="accepted_jesus" name="accepted_jesus" required>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
            <div id="acceptJesusDateField">
                <label for="accept_jesus_date">Date:</label>
                <input type="date" id="accept_jesus_date" name="accept_jesus_date">
            </div>

            <!-- Baptized -->
            <label for="baptized">Baptized?</label>
            <select id="baptized" name="baptized" required>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
            <div id="baptismDateField">
                <label for="baptized_date">Date:</label>
                <input type="date" id="baptized_date" name="baptized_date">
            </div>

            <!-- Group or Ministry -->
            <label for="group">Group or Ministry:</label>
            <input type="text" id="group" name="group">

            <!-- Emergency Contact -->
            <label for="emergency_contact">Emergency Contact (Name & Relationship):</label>
            <input type="text" id="emergency_contact" name="emergency_contact" required>
            <label for="emergency_number">Emergency Contact Number:</label>
            <input type="text" id="emergency_number" name="emergency_number" required>

            <!-- Date of Membership -->
            <label for="date_of_membership">Date of Membership:</label>
            <input type="date" id="date_of_membership" name="date_of_membership" required>

            <!-- Tithe Number -->
            <label for="tithe_number">Tithe Number:</label>
            <input type="text" id="tithe_number" name="tithe_number">

            <input type="submit" value="Register">
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    console.log('JavaScript loaded');

    // Attach event listeners to Edit buttons
    const editButtons = document.querySelectorAll('.edit-btn');
    if (editButtons.length > 0) {
        editButtons.forEach(button => {
            console.log('Edit button found:', button);
            button.addEventListener('click', function() {
                console.log('Edit button clicked:', this);

                const memberId = this.getAttribute('data-id');
                document.getElementById('registerForm').action = './assets/includes/edit_member.php';

                // Fetch member data via AJAX and populate the form
                fetch('./assets/includes/get_member.php?id=' + memberId)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Fetched data:', data);
                        document.getElementById('member_id').value = data.id;
                        document.getElementById('title').value = data.title;
                        document.getElementById('first_name').value = data.first_name;
                        document.getElementById('middle_name').value = data.middle_name;
                        document.getElementById('last_name').value = data.last_name;
                        document.getElementById('email').value = data.email;
                        document.getElementById('phone').value = data.phone;
                        document.getElementById('additional_phones').value = data.additional_phones;
                        document.getElementById('address').value = data.address;
                        document.getElementById('birthday').value = data.birthday;
                        document.getElementById('gender').value = data.gender;
                        document.getElementById('role').value = data.role;
                        document.getElementById('occupation').value = data.occupation;
                        document.getElementById('institution').value = data.institution;
                        document.getElementById('father_name').value = data.father_name;
                        document.getElementById('father_status').value = data.father_status;
                        document.getElementById('mother_name').value = data.mother_name;
                        document.getElementById('mother_status').value = data.mother_status;
                        document.getElementById('marital_status').value = data.marital_status;
                        document.getElementById('spouse_name').value = data.spouse_name;
                        document.getElementById('spouse_contact').value = data.spouse_contact;
                        document.getElementById('children_number').value = data.children_number;
                        document.getElementById('accepted_jesus').value = data.accepted_jesus;
                        document.getElementById('accept_jesus_date').value = data.accept_jesus_date;
                        document.getElementById('baptized').value = data.baptized;
                        document.getElementById('baptized_date').value = data.baptized_date;
                        document.getElementById('group').value = data.group;
                        document.getElementById('emergency_contact').value = data.emergency_contact;
                        document.getElementById('emergency_number').value = data.emergency_number;
                        document.getElementById('date_of_membership').value = data.date_of_membership;
                        document.getElementById('tithe_number').value = data.tithe_number;
                    })
                    .catch(error => console.error('Error fetching member data:', error));

                // Show the modal
                document.getElementById('registerMemberModal').style.display = 'block';
            });
        });
    } else {
        console.error('No edit buttons found');
    }

    // Attach event listeners to Delete buttons
    const deleteButtons = document.querySelectorAll('.delete-btn');
    if (deleteButtons.length > 0) {
        deleteButtons.forEach(button => {
            console.log('Delete button found:', button);
            button.addEventListener('click', function() {
                console.log('Delete button clicked:', this);

                const memberId = this.getAttribute('data-id');
                if (confirm('Are you sure you want to delete this member?')) {
                    window.location.href = './assets/includes/delete_member.php?id=' + memberId;
                }
            });
        });
    } else {
        console.error('No delete buttons found');
    }

    // Close Modal
    const closeModal = document.querySelector('.close');
    if (closeModal) {
        closeModal.addEventListener('click', () => {
            console.log('Close button clicked');
            document.getElementById('registerMemberModal').style.display = 'none';
        });
    } else {
        console.error('Close button not found');
    }
});
</script>

