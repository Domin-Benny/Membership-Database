<?php
// Include database connection
include './assets/includes/db.php';

// Fetch members from the database based on search or filter
$search = isset($_GET['search']) ? $_GET['search'] : '';
$genderFilter = isset($_GET['gender']) ? $_GET['gender'] : '';

$query = "SELECT profile_image, CONCAT(first_name, ' ', middle_name, ' ', last_name) AS full_name, phone, gender FROM members WHERE 1=1";

// Add search condition
if ($search) {
    $query .= " AND (first_name LIKE :search OR middle_name LIKE :search OR last_name LIKE :search OR phone LIKE :search)";
}

// Add gender filter
if ($genderFilter) {
    $query .= " AND gender = :gender";
}

$stmt = $pdo->prepare($query);

// Bind parameters if search or filter is applied
if ($search) {
    $stmt->bindValue(':search', "%$search%");
}
if ($genderFilter) {
    $stmt->bindValue(':gender', $genderFilter);
}

$stmt->execute();
$members = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<style>
/* Style for the form */
.styled-form {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 20px;
    gap: 10px;
}

.styled-input, .styled-select {
    padding: 10px;
    font-size: 1rem;
    border-radius: 5px;
    border: 1px solid #ccc;
    outline: none;
    transition: all 0.3s ease;
}

/* Add focus styles for inputs */
.styled-input:focus, .styled-select:focus {
    border-color: #007bff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}

/* Style for the button */
.styled-button {
    background-color: #007bff;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 1rem;
    transition: background-color 0.3s ease;
}

.styled-button:hover {
    background-color: #0056b3;
}
</style>
<div class="view-members-container">
    <h2>View All Members</h2>
    
    <!-- Search and Filter Form -->
    <form id="search-filter-form" class="styled-form">
        <input type="text" name="search" id="search" placeholder="Search..." value="<?php echo htmlspecialchars($search); ?>" class="styled-input">
        
        <select name="gender" id="gender-filter" class="styled-select">
            <option value="">All Genders</option>
            <option value="Male" <?php echo $genderFilter === 'Male' ? 'selected' : ''; ?>>Male</option>
            <option value="Female" <?php echo $genderFilter === 'Female' ? 'selected' : ''; ?>>Female</option>
        </select>
        
        <button type="submit" class="styled-button">Search</button>
    </form>
    
    <!-- Table -->
    <table class="view-members-table">
        <thead>
            <tr>
                <th>Full Name</th>
                <th>Profile Image</th>
                <th>Contact</th>
                <th>Gender</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($members)): ?>
                <tr>
                    <td colspan="4">No members found.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($members as $member): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($member['full_name']); ?></td>
                        <td>
                            <img src="assets/includes/<?php echo $member['profile_image']; ?>" 
                                 alt="Profile Image" class="member-img">
                        </td>
                        <td><?php echo htmlspecialchars($member['phone']); ?></td>
                        <td><?php echo htmlspecialchars($member['gender']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>


<!-- JavaScript for AJAX functionality -->
<script>
document.getElementById('search-filter-form').addEventListener('submit', function(event) {
    event.preventDefault();

    const formData = new FormData(this);

    fetch('view_all_members.php?' + new URLSearchParams(formData), {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.text())
    .then(html => {
        document.querySelector('.view-members-container').innerHTML = html;
        // Reinitialize the form after new content is loaded
        initializeSearchAndFilter();
    })
    .catch(error => console.error('Error:', error));
});

function initializeSearchAndFilter() {
    document.getElementById('search-filter-form').addEventListener('submit', function(event) {
        event.preventDefault();
    
        const formData = new FormData(this);
    
        fetch('view_all_members.php?' + new URLSearchParams(formData), {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.text())
        .then(html => {
            document.querySelector('.view-members-container').innerHTML = html;
            initializeSearchAndFilter(); // Ensure it still works after new content loads
        })
        .catch(error => console.error('Error:', error));
    });
}

// Initialize when page loads
initializeSearchAndFilter();
</script>
