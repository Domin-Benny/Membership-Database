<!-- Registration Form Modal -->
<div id="registerMemberModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Register New Member</h2>
        <form id="registerForm" method="POST" action="./assets/includes/register_member.php" enctype="multipart/form-data">
            <!-- Title -->
            <label for="title">Title:</label>
            <select id="title" name="title" required>
                <option value="Mr.">Mr.</option>
                <option value="Mrs.">Mrs.</option>
                <option value="Miss">Miss</option>
                <option value="Dr.">Dr.</option>
                <option value="Prof.">Prof.</option>
                <option value="Rev.">Rev.</option>
                <!-- Add more as needed -->
            </select>

            <!-- First Name -->
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" required>

            <!-- Last Name -->
            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" required>

            <!-- Email -->
            <label for="email">Email:</label>
            <input type="email" id="email" name="email">

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
            <div id="institutionField" style="display: none;">
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
            </select>

            <!-- Spouse Name -->
            <div id="spouseField" style="display: none;">
                <label for="spouse_name">Spouse Name:</label>
                <input type="text" id="spouse_name" name="spouse_name">
            </div>

            <!-- Number of Children -->
            <label for="children_number">Number of Children:</label>
            <input type="number" id="children_number" name="children_number" min="0">

            <!-- Accept Jesus Christ as Saviour -->
            <label for="accepted_jesus">Accepted Jesus Christ as Personal Saviour and Lord?</label>
            <select id="accepted_jesus" name="accepted_jesus" required>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
            <div id="acceptJesusDateField" style="display: none;">
                <label for="accept_jesus_date">Date:</label>
                <input type="date" id="accept_jesus_date" name="accept_jesus_date">
            </div>

            <!-- Baptized -->
            <label for="baptized">Baptized?</label>
            <select id="baptized" name="baptized" required>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
            <div id="baptismDateField" style="display: none;">
                <label for="baptism_date">Date:</label>
                <input type="date" id="baptism_date" name="baptism_date">
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
            <label for="membership_date">Date of Membership:</label>
            <input type="date" id="membership_date" name="membership_date" required>

            <!-- Tithe Number -->
            <label for="tithe_number">Tithe Number:</label>
            <input type="text" id="tithe_number" name="tithe_number">

            <input type="submit" value="Register">
        </form>
    </div>
</div>
