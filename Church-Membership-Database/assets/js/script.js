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

document.addEventListener("DOMContentLoaded", function() {
    var showRegisterAdminModalBtn = document.getElementById("showRegisterAdminModalBtn");
    var registerAdminModal = document.getElementById("registerAdminModal");
    var closeModal = document.querySelector(".admin-modal .admin-close");

    // Hide the modal by default
    registerAdminModal.style.display = "none";

    // Show the modal
    showRegisterAdminModalBtn.onclick = function() {
        registerAdminModal.style.display = "block";
        setTimeout(function() {
            registerAdminModal.classList.add("show");
        }, 10); // Delay for animation
    };

    // Close the modal
    closeModal.onclick = function() {
        registerAdminModal.classList.remove("show");
        setTimeout(function() {
            registerAdminModal.style.display = "none";
        }, 500); // Delay for animation
    };

    // Close the modal if clicking outside
    window.onclick = function(event) {
        if (event.target == registerAdminModal) {
            closeModal.onclick();
        }
    };
});

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



// Initialize the page
window.onload = function() {
    updateDashboardCards();
    updateBirthdayTables(); // Fetch and update birthday tables
    initializeModalEventListeners(); // Initialize modal listeners on page load
};

// Function to load the view_all_members.php content into the content area
function loadViewAllMembers(searchParams = '') {
    fetch('view_all_members.php' + (searchParams ? '?' + searchParams : ''))
        .then(response => response.text())
        .then(html => {
            document.querySelector('.content').innerHTML = html;
            initializeSearchFilter(); // Initialize search and filter functionality
        })
        .catch(error => console.error('Error loading view all members section:', error));
}

// Initialize search and filter form
function initializeSearchFilter() {
    const form = document.getElementById('search-filter-form');

    if (form) {
        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission

            // Capture the form data
            const formData = new FormData(this);
            const searchParams = new URLSearchParams(formData).toString();

            // Load the filtered results back into the content area
            loadViewAllMembers(searchParams);
        });
    }
}

// Event listener for "View All Members" link in the sidebar
document.getElementById('viewAllMembersLink').addEventListener('click', function(event) {
    event.preventDefault();
    loadViewAllMembers();
});

// Event listener for "View All Members" link in the dashboard card
document.getElementById('viewAllMembersCardLink').addEventListener('click', function(event) {
    event.preventDefault();
    loadViewAllMembers();
});


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

document.getElementById('search-filter-form').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const formData = new FormData(this);
    const queryParams = new URLSearchParams(formData).toString();
    
    fetch('view_all_members.php?' + queryParams, {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.text())
    .then(html => {
        document.querySelector('.content').innerHTML = html;
    })
    .catch(error => console.error('Fetch error:', error));
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
    fetch('fetch_birthdays.php')
        .then(response => response.json())
        .then(data => {
            // Update Today's Birthdays Table
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

            // Update Weekly Birthdays Table
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

// Update birthday tables every 30 minutes
setInterval(updateBirthdayTables, 1800000);
