function openEditModal(id, username, email) {
    document.getElementById('edit_id').value = id;
    document.getElementById('edit_username').value = username;
    document.getElementById('edit_email').value = email;
    $('#editUserModal').modal('show');
}

function confirmDelete() {
    return confirm('Are you sure you want to delete this user?');
}
// scripts.js
function openEditModal(id, user_id, certificate, location, sport, day_time, state) {
    document.getElementById('edit_id').value = id;
    document.getElementById('edit_user_id').value = user_id;
    document.getElementById('edit_certificate').value = certificate;
    document.getElementById('edit_location').value = location;
    document.getElementById('edit_sport').value = sport;
    document.getElementById('edit_day_time').value = day_time;
    document.getElementById('edit_state').value = state;
    $('#editTrainerModal').modal('show');
}

// Ajax form submission for updating trainer details
$('#editTrainerForm').submit(function (e) {
    e.preventDefault();  // Prevent default form submission

    var formData = $(this).serialize(); // Collect form data

    $.ajax({
        url: 'trainerslist.php',
        type: 'POST',
        data: formData,
        success: function (response) {
            alert(response.message);
            if (response.success) {
                location.reload(); // Reload the page after successful update
            }
        },
        error: function () {
            alert('Error updating trainer.');
        }
    });
});
