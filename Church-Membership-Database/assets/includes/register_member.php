<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include database connection
include 'db.php';

$errors = []; // Array to hold errors

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $title = $_POST['title'];
    $firstName = $_POST['first_name'];
    $middleName = $_POST['middle_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $additionalPhone = isset($_POST['additional_phones']) ? $_POST['additional_phones'] : '';
    $address = $_POST['address'];
    $birthday = $_POST['birthday'];
    $gender = $_POST['gender'];
    $institution = $_POST['institution'];
    $occupation = $_POST['occupation'];
    $fatherName = $_POST['father_name'];
    $fatherStatus = $_POST['father_status'];
    $motherName = $_POST['mother_name'];
    $motherStatus = $_POST['mother_status'];
    $acceptedJesus = $_POST['accepted_jesus'];
    $acceptedJesusDate = isset($_POST['accepted_jesus_date']) ? $_POST['accepted_jesus_date'] : NULL;
    $baptized = $_POST['baptized'];
    $baptizedDate = isset($_POST['baptized_date']) ? $_POST['baptized_date'] : NULL;
    $dateOfMembership = $_POST['date_of_membership'];
    $titheNumber = $_POST['tithe_number'];
    $role = $_POST['role'];
    $maritalStatus = $_POST['marital_status'];
    $numChildren = isset($_POST['children_number']) ? $_POST['children_number'] : NULL;
    $spouseName = $_POST['spouse_name'];
    $spouseContact = $_POST['spouse_contact'];
    $groupOrMinistry = $_POST['group'];
    $emergencyContact = $_POST['emergency_contact'];
    $emergencyNumber = $_POST['emergency_number'];

    // Check for duplicate email, phone, or tithe number
    $stmt = $pdo->prepare("SELECT * FROM members WHERE email = ? OR phone = ? OR tithe_number = ?");
    $stmt->execute([$email, $phone, $titheNumber]);
    $existingMember = $stmt->fetch();

    if ($existingMember) {
        if ($existingMember['email'] == $email) {
            $errors['email'] = "This email address is already registered.";
        }
        if ($existingMember['phone'] == $phone) {
            $errors['phone'] = "This phone number is already registered.";
        }
        if ($existingMember['tithe_number'] == $titheNumber) {
            $errors['tithe_number'] = "This tithe number is already registered.";
        }
    }

    // Handle file upload
    $uploadFile = null;
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/'; // Relative path for web access
        $uploadFile = $uploadDir . basename($_FILES['profile_image']['name']);
        
        // Check if the directory exists
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true); // Create the directory if it doesn't exist
        }

        if (!move_uploaded_file($_FILES['profile_image']['tmp_name'], __DIR__ . '/' . $uploadFile)) {
            $errors['profile_image'] = "File upload failed.";
        }
    }

    // If there are no errors, insert the data into the database

        try {
            // Insert data into the database
            $stmt = $pdo->prepare("INSERT INTO members (title, first_name, middle_name, last_name, email, phone, additional_phone, address, birthday, gender, institution, occupation, father_name, father_status, mother_name, mother_status, marital_status, num_children, spouse_name, spouse_contact, accepted_jesus, accepted_jesus_date, baptized, baptized_date, date_of_membership, tithe_number, role, profile_image, group_or_ministry, emergency_contact, emergency_number) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$title, $firstName, $middleName, $lastName, $email, $phone, $additionalPhone, $address, $birthday, $gender, $institution, $occupation, $fatherName, $fatherStatus, $motherName, $motherStatus, $maritalStatus, $numChildren, $spouseName, $spouseContact, $acceptedJesus, $acceptedJesusDate, $baptized, $baptizedDate, $dateOfMembership, $titheNumber, $role, $uploadFile, $groupOrMinistry, $emergencyContact, $emergencyNumber]);
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
            exit;
        }
    
      // Redirect to the dashboard after successful insertion
            header('Location: /dashboard.php');
            exit;
}

?>

