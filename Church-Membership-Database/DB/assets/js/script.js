// Update card values (this would be replaced with actual data fetching)
// Initialize the page
window.onload = function() {
    updateDashboardCards();
    updateBirthdayTables(); // Fetch and update birthday tables
    initializeModalEventListeners(); // Initialize modal listeners on page load
};

// Toggle the sidebar when the hamburger icon is clicked
document.querySelector('.hamburger').addEventListener('click', function () {
    document.querySelector('.sidebar').classList.toggle('active');
});

// Handle dropdown functionality
document.querySelectorAll('.dropdown > a').forEach(function(dropdownToggle) {
    dropdownToggle.addEventListener('click', function(event) {
        event.preventDefault();
        this.parentElement.classList.toggle('active');
    });
});

// Function to initialize modal event listeners
function initializeModalEventListeners() {
    // Open modal function
    function openModal(modalId) {
        document.getElementById(modalId).style.display = "block";
    }

    // Close modal function
    function closeModal(modalId) {
        document.getElementById(modalId).style.display = "none";
    }

    // Event listener for "Register Member" link
    document.querySelectorAll('.sidebar .dropdown-content a[href="#registerMemberModal"]').forEach(function(element) {
        element.addEventListener('click', function(event) {
            event.preventDefault();
            openModal("registerMemberModal");
        });
    });

    // Close modal when the close button is clicked
    document.querySelectorAll(".modal .close").forEach(function(closeButton) {
        closeButton.addEventListener('click', function() {
            closeModal(this.closest('.modal').id);
        });
    });

    // Close modal if clicked outside of it
    window.addEventListener('click', function(event) {
        if (event.target.classList.contains('modal')) {
            closeModal(event.target.id);
        }
    });
}

// Initialize the page
window.onload = function() {
    updateDashboardCards();
    updateBirthdayTables(); // Fetch and update birthday tables
    initializeModalEventListeners(); // Initialize modal listeners on page load
};

// Event listener for "Modify Member" link
document.getElementById('modifyMemberLink').addEventListener('click', function(event) {
    event.preventDefault();

    // Load the modify_member.php content into the dashboard
    fetch('modify_member.php')
        .then(response => response.text())
        .then(html => {
            document.querySelector('.content').innerHTML = html;
            initializeModalEventListeners(); // Re-initialize modal listeners after content load
        })
        .catch(error => console.error('Error loading modify member section:', error));
});

// Event listener for "View All Members" link
document.getElementById('viewAllMembersLink').addEventListener('click', function(event) {
    event.preventDefault();

    // Load the view_all_members.php content into the dashboard
    fetch('view_all_members.php')
        .then(response => response.text())
        .then(html => {
            document.querySelector('.content').innerHTML = html;
            initializeModalEventListeners(); // Re-initialize modal listeners after content load
        })
        .catch(error => console.error('Error loading view all members section:', error));
});


// Display success alert
function showSuccessAlert() {
    var alertBox = document.createElement('div');
    alertBox.className = 'success-alert';
    alertBox.textContent = "Member registered successfully!";
    document.body.appendChild(alertBox);
    alertBox.style.display = 'block';

    setTimeout(function() {
        alertBox.style.display = 'none';
        alertBox.remove();
    }, 3000);
}


// Edit member function
function editMember(id) {
    fetch('edit_member_form.php?id=' + id)
        .then(response => response.text())
        .then(html => {
            document.querySelector('.content').innerHTML = html;
            initializeModalEventListeners(); // Re-initialize modal listeners after content load
        })
        .catch(error => console.error('Error loading edit member form:', error));
}
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
        fetch('templates/get_member.php?id=' + id)
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
                // Handle image preview if needed
            });
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



// Delete member function
function deleteMember(id) {
    if (confirm('Are you sure you want to delete this member?')) {
        fetch('delete_member.php?id=' + id, { method: 'DELETE' })
            .then(response => {
                if (response.ok) {
                    alert('Member deleted successfully.');
                    location.reload();
                } else {
                    alert('Failed to delete member.');
                }
            })
            .catch(error => console.error('Error deleting member:', error));
    }
}

// Fetch birthday data and update tables
function updateBirthdayTables() {
    fetch('get_birthday_data.php')
        .then(response => response.json())
        .then(data => {
            // Today's Birthdays Table
            let todayTableBody = document.querySelector('.dashboard-tables .table-container:nth-child(1) tbody');
            todayTableBody.innerHTML = ''; // Clear existing data
            
            if (data.today.length > 0) {
                data.today.forEach(member => {
                    let row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${member.name}</td>
                        <td>${member.email}</td>
                        <td>${member.birthday}</td>
                    `;
                    todayTableBody.appendChild(row);
                });
            } else {
                todayTableBody.innerHTML = '<tr><td colspan="3">No data available</td></tr>';
            }

            // Weekly Birthdays Table
            let weeklyTableBody = document.querySelector('.dashboard-tables .table-container:nth-child(2) tbody');
            weeklyTableBody.innerHTML = ''; // Clear existing data

            if (data.weekly.length > 0) {
                data.weekly.forEach(member => {
                    let row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${member.name}</td>
                        <td>${member.birthday}</td>
                    `;
                    weeklyTableBody.appendChild(row);
                });
            } else {
                weeklyTableBody.innerHTML = '<tr><td colspan="2">No data available</td></tr>';
            }
        })
        .catch(error => console.error('Error fetching birthday data:', error));
}

// Update dashboard cards every 15 seconds 
setInterval(updateDashboardCards, 15000);
                    
// Update birthday tables every 30 minutes
setInterval(updateBirthdayTables, 1800000);