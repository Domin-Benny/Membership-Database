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
    
    // Title
    echo '<label for="title">Title:</label>';
    echo '<select name="title" id="title" required>';
    echo '<option value="">Select Title</option>';
    echo '<option value="Mr"'.($member['title'] == 'Mr' ? ' selected' : '').'>Mr</option>';
    echo '<option value="Mrs"'.($member['title'] == 'Mrs' ? ' selected' : '').'>Mrs</option>';
    echo '<option value="Ms"'.($member['title'] == 'Ms' ? ' selected' : '').'>Ms</option>';
    echo '<option value="Dr"'.($member['title'] == 'Dr' ? ' selected' : '').'>Dr</option>';
    echo '<option value="Rev"'.($member['title'] == 'Rev' ? ' selected' : '').'>Rev</option>';
    echo '<option value="Prof"'.($member['title'] == 'Prof' ? ' selected' : '').'>Prof</option>';
    echo '</select>';
    
    // First Name
    echo '<label for="first_name">First Name:</label>';
    echo '<input type="text" id="first_name" name="first_name" value="'.htmlspecialchars($member['first_name']).'" required>';
    
    // Middle Name
    echo '<label for="middle_name">Middle Name:</label>';
    echo '<input type="text" id="middle_name" name="middle_name" value="'.htmlspecialchars($member['middle_name']).'">';
    
    // Last Name
    echo '<label for="last_name">Last Name:</label>';
    echo '<input type="text" id="last_name" name="last_name" value="'.htmlspecialchars($member['last_name']).'" required>';
    
    // Email
    echo '<label for="email">Email:</label>';
    echo '<input type="email" id="email" name="email" value="'.htmlspecialchars($member['email']).'">';
    
    // Phone
    echo '<label for="phone">Phone:</label>';
    echo '<input type="text" id="phone" name="phone" value="'.htmlspecialchars($member['phone']).'" required>';
    
    // Additional Phones
    $additionalPhones = explode(',', $member['additional_phones']);
    echo '<label for="additional_phones">Additional Phone Numbers</label>';
    foreach ($additionalPhones as $index => $phone) {
        echo '<input type="text" name="additional_phones[]" value="'.htmlspecialchars($phone).'" placeholder="Additional Phone '.($index+1).'">';
    }
    
    // Address
    echo '<label for="address">Address:</label>';
    echo '<input type="text" id="address" name="address" value="'.htmlspecialchars($member['address']).'" required>';
    
    // Birthday
    echo '<label for="birthday">Birthday:</label>';
    echo '<input type="date" id="birthday" name="birthday" value="'.htmlspecialchars($member['birthday']).'" required>';
    
    // Gender
    echo '<label for="gender">Gender:</label>';
    echo '<select name="gender" id="gender" required>';
    echo '<option value="">Select Gender</option>';
    echo '<option value="male"'.($member['gender'] == 'male' ? ' selected' : '').'>Male</option>';
    echo '<option value="female"'.($member['gender'] == 'female' ? ' selected' : '').'>Female</option>';
    echo '<option value="other"'.($member['gender'] == 'other' ? ' selected' : '').'>Other</option>';
    echo '</select>';
    
    // Institution
    echo '<label for="institution">Institution:</label>';
    echo '<input type="text" id="institution" name="institution" value="'.htmlspecialchars($member['institution']).'">';
    
    // Father's Name
    echo '<label for="father_name">Father\'s Name:</label>';
    echo '<input type="text" id="father_name" name="father_name" value="'.htmlspecialchars($member['father_name']).'">';
    
    // Father's Status
    echo '<label for="father_status">Father\'s Status:</label>';
    echo '<select name="father_status" id="father_status">';
    echo '<option value="alive"'.($member['father_status'] == 'alive' ? ' selected' : '').'>Alive</option>';
    echo '<option value="deceased"'.($member['father_status'] == 'deceased' ? ' selected' : '').'>Deceased</option>';
    echo '</select>';
    
    // Mother's Name
    echo '<label for="mother_name">Mother\'s Name:</label>';
    echo '<input type="text" id="mother_name" name="mother_name" value="'.htmlspecialchars($member['mother_name']).'">';
    
    // Mother's Status
    echo '<label for="mother_status">Mother\'s Status:</label>';
    echo '<select name="mother_status" id="mother_status">';
    echo '<option value="alive"'.($member['mother_status'] == 'alive' ? ' selected' : '').'>Alive</option>';
    echo '<option value="deceased"'.($member['mother_status'] == 'deceased' ? ' selected' : '').'>Deceased</option>';
    echo '</select>';
    
    // Accepted Jesus
    echo '<label for="accepted_jesus">Accepted Jesus:</label>';
    echo '<select name="accepted_jesus" id="accepted_jesus">';
    echo '<option value="yes"'.($member['accepted_jesus'] == 'yes' ? ' selected' : '').'>Yes</option>';
    echo '<option value="no"'.($member['accepted_jesus'] == 'no' ? ' selected' : '').'>No</option>';
    echo '</select>';
    
    // Date of Acceptance
    echo '<label for="accepted_jesus_date">Date of Acceptance:</label>';
    echo '<input type="date" id="accepted_jesus_date" name="accepted_jesus_date" value="'.htmlspecialchars($member['accepted_jesus_date']).'">';
    
    // Baptism Date
    echo '<label for="baptism_date">Baptism Date:</label>';
    echo '<input type="date" id="baptism_date" name="baptism_date" value="'.htmlspecialchars($member['baptism_date']).'">';
    
    // Date of Membership
    echo '<label for="date_of_membership">Date of Membership:</label>';
    echo '<input type="date" id="date_of_membership" name="date_of_membership" value="'.htmlspecialchars($member['date_of_membership']).'">';
    
    // Tithe Number
    echo '<label for="tithe_number">Tithe Number:</label>';
    echo '<input type="text" id="tithe_number" name="tithe_number" value="'.htmlspecialchars($member['tithe_number']).'">';
    
    // Role
    echo '<label for="role">Role:</label>';
    echo '<input type="text" id="role" name="role" value="'.htmlspecialchars($member['role']).'" required>';
    
    // Profile Image
    echo '<label for="image">Profile Image:</label>';
    echo '<input type="file" id="image" name="image">';
    
    echo '<input type="submit" value="Save">';
    echo '</form>';
} else {
    echo '<p>Member not found.</p>';
}
?>
