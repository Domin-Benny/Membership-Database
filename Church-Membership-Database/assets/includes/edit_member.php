<?php
include './db.php'; // Ensure this file contains the correct database connection setup

$data = $_POST; // Assuming the form method is POST
$memberId = $data['id'] ?? null;
$title = $data['title'] ?? '';
$firstName = $data['first_name'] ?? '';
$middleName = $data['middle_name'] ?? '';
$lastName = $data['last_name'] ?? '';
$email = $data['email'] ?? '';
$phone = $data['phone'] ?? '';
$additionalPhones = $data['additional_phones'] ?? '';
$address = $data['address'] ?? '';
$birthday = $data['birthday'] ?? '';
$gender = $data['gender'] ?? '';
$role = $data['role'] ?? '';
$occupation = $data['occupation'] ?? '';
$institution = $data['institution'] ?? '';
$fatherName = $data['father_name'] ?? '';
$fatherStatus = $data['father_status'] ?? '';
$motherName = $data['mother_name'] ?? '';
$motherStatus = $data['mother_status'] ?? '';
$maritalStatus = $data['marital_status'] ?? '';
$spouseName = $data['spouse_name'] ?? '';
$spouseContact = $data['spouse_contact'] ?? '';
$childrenNumber = $data['children_number'] ?? '';
$acceptedJesus = $data['accepted_jesus'] ?? '';
$acceptJesusDate = $data['accept_jesus_date'] ?? '';
$baptized = $data['baptized'] ?? '';
$baptizedDate = $data['baptized_date'] ?? '';
$group = $data['group'] ?? '';
$emergencyContact = $data['emergency_contact'] ?? '';
$emergencyNumber = $data['emergency_number'] ?? '';
$membershipDate = $data['date_of_membership'] ?? '';
$titheNumber = $data['tithe_number'] ?? '';

// Handling the file upload
if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
    $fileTmpPath = $_FILES['profile_image']['tmp_name'];
    $fileName = $_FILES['profile_image']['name'];
    $fileSize = $_FILES['profile_image']['size'];
    $fileType = $_FILES['profile_image']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));
    
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    
    if (in_array($fileExtension, $allowedExtensions)) {
        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
        $uploadFileDir = './uploads/';
        $dest_path = $uploadFileDir . $newFileName;
        
        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            $profileImage = $newFileName;
        } else {
            $profileImage = null;
            echo json_encode(['success' => false, 'error' => 'Failed to move uploaded file']);
            exit;
        }
    } else {
        $profileImage = null;
        echo json_encode(['success' => false, 'error' => 'Invalid file extension']);
        exit;
    }
} else {
    $profileImage = null;
}

// Update member information
$query = "UPDATE members SET title = :title, first_name = :first_name, middle_name = :middle_name, last_name = :last_name, email = :email, phone = :phone, additional_phones = :additional_phones, address = :address, birthday = :birthday, gender = :gender, role = :role, profile_image = :profile_image, occupation = :occupation, institution = :institution, father_name = :father_name, father_status = :father_status, mother_name = :mother_name, mother_status = :mother_status, marital_status = :marital_status, spouse_name = :spouse_name, spouse_contact = :spouse_contact, children_number = :children_number, accepted_jesus = :accepted_jesus, accept_jesus_date = :accept_jesus_date, baptized = :baptized, baptized_date = :baptized_date, `group` = :group, emergency_contact = :emergency_contact, emergency_number = :emergency_number, membership_date = :membership_date, tithe_number = :tithe_number WHERE id = :id";

$stmt = $pdo->prepare($query);

$params = [
    ':id' => $memberId,
    ':title' => $title,
    ':first_name' => $firstName,
    ':middle_name' => $middleName,
    ':last_name' => $lastName,
    ':email' => $email,
    ':phone' => $phone,
    ':additional_phones' => $additionalPhones,
    ':address' => $address,
    ':birthday' => $birthday,
    ':gender' => $gender,
    ':role' => $role,
    ':profile_image' => $profileImage,
    ':occupation' => $occupation,
    ':institution' => $institution,
    ':father_name' => $fatherName,
    ':father_status' => $fatherStatus,
    ':mother_name' => $motherName,
    ':mother_status' => $motherStatus,
    ':marital_status' => $maritalStatus,
    ':spouse_name' => $spouseName,
    ':spouse_contact' => $spouseContact,
    ':children_number' => $childrenNumber,
    ':accepted_jesus' => $acceptedJesus,
    ':accept_jesus_date' => $acceptJesusDate,
    ':baptized' => $baptized,
    ':baptized_date' => $baptizedDate,
    ':group' => $group,
    ':emergency_contact' => $emergencyContact,
    ':emergency_number' => $emergencyNumber,
    ':membership_date' => $membershipDate,
    ':tithe_number' => $titheNumber
];

if ($stmt->execute($params)) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'Failed to update member']);
}
?>
