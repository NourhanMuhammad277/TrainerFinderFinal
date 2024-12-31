<?php
include_once '../db.php';
include_once '../Controllers/ProfileController.php';
session_start();
$profileController = new ProfileController($_SESSION['user_id']);
$user = $profileController->getUserData();

include_once './components/head.php';
?>

<script>
    function validateEditProfileForm(event) {
        event.preventDefault(); // Prevent form submission

        const username = document.getElementById('editUsername').value.trim();
        const email = document.getElementById('editEmail').value.trim();
        let isValid = true;

        // Clear previous errors
        const errorElements = document.querySelectorAll('.error');
        errorElements.forEach(el => el.textContent = '');

        // Validate username
        if (username === '') {
            isValid = false;
            alert('Username cannot be empty.');
        }

        // Validate email
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            isValid = false;
            alert('Please enter a valid email address.');
        }

        if (isValid) {
            document.getElementById('editProfileForm').submit();
        }
    }

    function validateForm(event) {
        event.preventDefault();
        let isValid = true;

        // Clear previous error messages
        document.querySelectorAll('.error').forEach(el => el.textContent = '');

        const dayTimeSelections = Array.from(document.getElementById('dayTime').selectedOptions);
        const certificate = document.getElementById('certificate').files.length;

        // Validate day and time selections
        if (dayTimeSelections.length === 0) {
            document.getElementById('dayTimeError').textContent = 'At least one day and time must be selected';
            isValid = false;
        }

        // Validate certificate upload
        if (certificate === 0) {
            document.getElementById('certificateError').textContent = 'Certificate is required';
            isValid = false;
        }

        if (isValid) {
            document.getElementById('applyForm').submit();
        }
    }
</script>
<link rel="stylesheet" href="../Assets/CSS/Profile.css">

<body>
    <?php include_once './components/nav.php'; ?>
    <div class="container mt-5">
        <h2 class="text-center mb-4">User Profile</h2>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Profile Information</h5>
                <p class="card-text"><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
                <p class="card-text"><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                <button class="btn btn-success" data-toggle="modal" data-target="#applyModal">Apply as a Trainer</button>
                <button class="btn btn-success" data-toggle="modal" data-target="#editProfileModal">Edit Profile</button>
                <a href="/TrainerFinderFinal/Views/Trainers/index.php">
                    <button class="btn btn-success">Find Trainers</button>
                </a>
            </div>
        </div>
    </div>

    <div class="modal fade" id="applyModal" tabindex="-1" role="dialog" aria-labelledby="applyModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="applyModalLabel">Trainer Application</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <form id="applyForm" action="submitapplication.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="location">Location</label>
                            <select class="form-control" id="location" name="location">
                                <option value="" disabled selected>Select your location</option>
                                <option value="New Cairo">New Cairo</option>
                                <option value="Nasr City">Nasr City</option>
                                <option value="Sheraton">Sheraton</option>
                                <option value="Korba">Korba</option>
                                <option value="Manial">Manial</option>
                                <option value="6th of October">6th of October</option>
                                <option value="Dokki">Dokki</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="sport">Sport</label>
                            <select class="form-control" id="sport" name="sport">
                                <option value="" disabled selected>Select your sport</option>
                                <option value="Squash">Squash</option>
                                <option value="Padel">Padel</option>
                                <option value="Basketball">Basketball</option>
                                <option value="Tennis">Tennis</option>
                                <option value="Football">Football</option>
                                <option value="Boxing">Boxing</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="dayTime">Available Days and Times</label>
                            <select multiple class="form-control multi-select" id="dayTime" name="dayTime[]">
                                <option value="Monday 02:00 PM">Monday 02:00 PM</option>
                                <option value="Monday 05:00 PM">Monday 05:00 PM</option>
                                <option value="Tuesday 11:00 AM">Tuesday 11:00 AM</option>
                                <option value="Wednesday 03:00 PM">Wednesday 03:00 PM</option>
                                <option value="Friday 10:00 AM">Friday 10:00 AM</option>
                            </select>
                            <span id="dayTimeError" class="error"></span>
                        </div>
                        <div class="form-group">
                            <label for="certificate">Upload Certificate</label>
                            <input type="file" class="form-control" id="certificate" name="certificate" accept=".pdf">
                            <span class="error" id="certificateError"></span>
                        </div>
                        <button type="submit" class="btn btn-success">Submit Application</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="applyModalLabel">Edit Profile</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <form id="editProfileForm" action="editprofile.php" method="POST" onsubmit="validateEditProfileForm(event)">
                        <div class="form-group">
                            <label for="editUsername">Username</label>
                            <input type="text" class="form-control" id="editUsername" name="username" value="<?php echo htmlspecialchars($user['username']); ?>">
                        </div>
                        <div class="form-group">
                            <label for="editEmail">Email</label>
                            <input type="email" class="form-control" id="editEmail" name="email" value="<?php echo htmlspecialchars($user['email']); ?>">
                        </div>
                        <button type="submit" class="btn btn-success">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>