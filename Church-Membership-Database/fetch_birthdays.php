<?php
header('Content-Type: application/json');

// Include database connection
include './assets/includes/db.php';

// Helper function to get upcoming birthdays
function getUpcomingBirthdays($conn, $startDate, $endDate) {
    $sql = "SELECT first_name, last_name, email, birthday 
            FROM members 
            WHERE DATE_FORMAT(birthday, '%m-%d') BETWEEN DATE_FORMAT(?) AND DATE_FORMAT(?)
            ORDER BY DATE_FORMAT(birthday, '%m-%d')";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $startDate, $endDate);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $birthdays = [];
    
    while ($row = $result->fetch_assoc()) {
        $birthdays[] = [
            'name' => $row['first_name'] . ' ' . $row['last_name'],
            'email' => $row['email'],
            'birthday' => $row['birthday']
        ];
    }

    $stmt->close();
    return $birthdays;
}

// Get today's date and the next week's date
$today = date('m-d');
$endOfWeek = date('m-d', strtotime('+1 week'));

// Define the start and end of the week range
$startOfWeek = date('m-d', strtotime('tomorrow'));
$endOfWeek = date('m-d', strtotime('next Sunday'));

// Get today's birthdays
$todayBirthdays = getUpcomingBirthdays($conn, $today, $today);

// Get weekly birthdays (from tomorrow until the end of the week)
$weeklyBirthdays = getUpcomingBirthdays($conn, $startOfWeek, $endOfWeek);

// Prepare JSON response
$response = [
    'today' => $todayBirthdays,
    'weekly' => $weeklyBirthdays
];

echo json_encode($response);

$conn->close();
?>
