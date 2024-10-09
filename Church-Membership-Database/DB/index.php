<?php
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
    <title>ARC Church Admin Dashboard</title>
    <link rel="stylesheet" href="./assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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
            <a href="#" id="viewAllMembersLink">See All People</a>
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

    <label for="profile_image">Profile Image:</label>
    <input type="file" id="profile_image" name="profile_image" accept="image/*">

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

    </div>
    


    <script src="./assets/js/script.js"></script>
</body>
</html>
