<?php

session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit;
}
// Include database connection
include './assets/includes/db.php';

// Fetch total members
$stmt = $pdo->query("SELECT COUNT(*) FROM members");
$totalMembers = $stmt->fetchColumn();

// Fetch total groups
$stmt = $pdo->query("SELECT COUNT(*) FROM groups");
$totalGroups = $stmt->fetchColumn();

// Fetch total events
$stmt = $pdo->query("SELECT COUNT(*) FROM events");
$totalEvents = $stmt->fetchColumn();

// Fetch total notifications
// Assuming you have a notifications table
$stmt = $pdo->query("SELECT COUNT(*) FROM notifications");
$totalNotifications = $stmt->fetchColumn();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ARC ADMINISTRATION</title>
    <link rel="stylesheet" href="./assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="icon" href="/assets/imgs/GOOD LOGO ADONA I2.png" type="image/x-icon">
    <link rel="shortcut icon" href="/assets/imgs/GOOD LOGO ADONA I2.png" type="image/x-icon">

</head>
<body>
    <div class="dashboard-container">
        <?php include './assets/templates/sidebar.php'; ?>
        <div class="main-content">
            <?php include './assets/templates/header.php'; ?>
            <div class="content">
                <!-- Overview Cards and other content -->
                <!-- Your card content here -->
                 <!-- Content Area -->
           
                <!-- Overview Cards and other content will go here -->
                <div class="dashboard-cards">
    <!-- Card: Total Members -->
    <div class="card green">
        <div class="card-icon">
            <i class="fas fa-users"></i>
        </div>
        <div class="card-info">
            <h3><?php echo $totalMembers; ?></h3>
            <p>People</p>
            <a href="" id="viewAllMembersCardLink">See All People</a>
        </div>
    </div>

    <!-- Card: Total Groups -->
    <div class="card red">
        <div class="card-icon">
            <i class="fas fa-user-friends"></i>
        </div>
        <div class="card-info">
            <h3><?php echo $totalGroups; ?></h3>
            <p>Groups</p>
            <a href="groups.php">More Info</a>
        </div>
    </div>

    <!-- Card: Total Events -->
    <div class="card orange">
        <div class="card-icon">
            <i class="fas fa-calendar-check"></i>
        </div>
        <div class="card-info">
            <h3><?php echo $totalEvents; ?></h3>
            <p>Events</p>
            <a href="events.php">More Info</a>
        </div>
    </div>

    <!-- Card: Notifications -->
    <div class="card yellow">
        <div class="card-icon">
            <i class="fas fa-bell"></i>
        </div>
        <div class="card-info">
            <h3><?php echo $totalNotifications; ?></h3>
            <p>Notifications</p>
            <a href="notifications.php">More Info</a>
        </div>
    </div>
</div>

<div class="dashboard-tables">
    <!-- Today's Birthdays -->
    <div class="table-container">
        <h3>Today's Birthdays</h3>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Birthday</th>
                </tr>
            </thead>
            <tbody>
                <!-- Dynamic content goes here -->
                <tr>
                    <td colspan="3">No data available</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Weekly Birthdays -->
    <div class="table-container">
        <h3>Weekly Birthdays</h3>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Birthday</th>
                </tr>
            </thead>
            <tbody>
                <!-- Dynamic content goes here -->
                <tr>
                    <td colspan="2">No data available</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

            </div>
        </div>
       <!-- Registration Form Modal -->
<div id="registerMemberModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Register New Member</h2>
        <form id="registerForm" method="POST" action="./assets/includes/register_member.php" enctype="multipart/form-data">
            <!-- Title -->
            <label for="title">Title:</label>
            <select id="title" name="title">
                <option value="Mr.">Mr.</option>
                <option value="Mrs.">Mrs.</option>
                <option value="Miss">Miss</option>
                <option value="Dr.">Dr.</option>
                <option value="Prof.">Prof.</option>
                <option value="Rev.">Rev.</option>
                <option value="Sir">Sir</option>
                <option value="Madam">Madam</option>

                <!-- Add more as needed -->
            </select>

            <!-- First Name -->
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name">
            
            <!-- Middle Name -->
            <label for="middle_name">Middle Name</label>
            <input type="text" id="middle_name" name="middle_name">

            <!-- Last Name -->
            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name">

            
            <!-- email -->
            <label for="email">Email:</label>
            <input type="email" id="email" name="email">

            <!-- Primary Phone -->
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone">

            <!-- Additional Phone Numbers -->
            <label for="additional_phones">Additional Phone Numbers:</label>
            <textarea id="additional_phones" name="additional_phones" placeholder="Separate multiple contacts with commas"></textarea>

            <!-- Address -->
            <label for="address">Address:</label>
            <textarea id="address" name="address"></textarea>

            <!-- Birthday -->
            <label for="birthday">Birthday:</label>
            <input type="date" id="birthday" name="birthday">

            <!-- Gender -->
            <label for="gender">Gender:</label>
            <select id="gender" name="gender">
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
            <input type="text" id="occupation" name="occupation">
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
                <option value="Divorced">Divorced</optin>
                <option value="Widowed">Widowed</option>
            </select>

            <!-- Spouse Name -->
            <div id="spouseField" >
                <label for="spouse_name">Spouse Name:</label>
                <input type="text" id="spouse_name" name="spouse_name">
            </div>

            <!-- Spouse Contact -->
            <label for="spouse_contact" >Spouse Contact:</label>
            <input type="text" id="spouse_contact" name="spouse_contact">

            <!-- Number of Children -->
            <label for="children_number">Number of Children:</label>
            <input type="number" id="children_number" name="children_number" min="0">

            <!-- Accept Jesus Christ as Saviour -->
            <label for="accepted_jesus">Accepted Jesus Christ as Personal Saviour and Lord?</label>
            <select id="accepted_jesus" name="accepted_jesus">
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
            <div id="acceptJesusDateField">
                <label for="accept_jesus_date">Date:</label>
                <input type="date" id="accept_jesus_date" name="accept_jesus_date">
            </div>

            <!-- Baptized -->
            <label for="baptized">Baptized?</label>
            <select id="baptized" name="baptized">
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
            <div id="baptismDateField" >
                <label for="baptized_date">Date:</label>
                <input type="date" id="baptized_date" name="baptized_date">
            </div>

            <!-- Group or Ministry -->
            <label for="group">Group or Ministry:</label>
            <input type="text" id="group" name="group">

            <!-- Emergency Contact -->
            <label for="emergency_contact">Emergency Contact (Name & Relationship):</label>
            <input type="text" id="emergency_contact" name="emergency_contact">
            <label for="emergency_number">Emergency Contact Number:</label>
            <input type="text" id="emergency_number" name="emergency_number">

            <!-- Date of Membership -->
            <label for="membership_date">Date of Membership:</label>
            <input type="date" id="date_of_membership" name="date_of_membership">

            <!-- Tithe Number -->
            <label for="tithe_number">Tithe Number:</label>
            <input type="text" id="tithe_number" name="tithe_number">

            <input type="submit" value="Register">
        </form>
        
<!-- Assuming this is inside your HTML -->
<?php if (!empty($errors)): ?>
    <div class="error-container">
        <?php foreach ($errors as $error): ?>
            <p><?= htmlspecialchars($error); ?></p>
        <?php endforeach; ?>
    </div>
<?php endif; ?>


    </div>
</div>


<!-- Add Admin Modal -->
<div id="registerAdminModal" class="admin-modal" style="display: none;">
    <div class="admin-modal-content">
        <span class="admin-close">&times;</span>
        <h2>Admin Registration</h2>
        <form method="POST" action="register.php">
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="Register">
        </form>
    </div>
</div>



<!-- Add/Edit Member Modal -->
<div id="memberModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2 id="modalTitle">Add New Member</h2>
        <form id="memberForm" method="POST" action="save_member.php" enctype="multipart/form-data">
            <input type="hidden" id="memberId" name="member_id">
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" required>

            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email">

            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone">

            <label for="address">Address:</label>
            <textarea id="address" name="address"></textarea>

            <label for="birthday">Birthday:</label>
            <input type="date" id="birthday" name="birthday">

            <label for="role">Role:</label>
            <input type="text" id="role" name="role">

            <label for="image">Profile Image:</label>
            <input type="file" id="image" name="image">

            <input type="submit" value="Save">
        </form>
    </div>
</div>

    </div>
    

    <script>
        
    document.getElementById("adminProfileImage").addEventListener("click", function() {
        var dropdown = document.getElementById("adminDropdown");
        dropdown.style.display = (dropdown.style.display === "block") ? "none" : "block";
    });

    // Optional: Close the dropdown if clicking outside of it
    window.onclick = function(event) {
        if (!event.target.matches('#adminProfileImage')) {
            var dropdown = document.getElementById("adminDropdown");
            if (dropdown.style.display === "block") {
                dropdown.style.display = "none";
            }
        }
    }
    </script>
    <script src="./assets/js/script.js"></script>
</body>
</html>
