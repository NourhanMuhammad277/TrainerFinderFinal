function openEditModal(id, username, email) {
    document.getElementById('edit_id').value = id;
    document.getElementById('edit_username').value = username;
    document.getElementById('edit_email').value = email;
    $('#editUserModal').modal('show');
}

function confirmDelete() {
    return confirm('Are you sure you want to delete this user?');
}

function openEditModal(id, username, email, location, sport, day_time, state) {
    document.getElementById('edit_id').value = id;
    document.getElementById('edit_username').value = username;
    document.getElementById('edit_email').value = email;
    document.getElementById('edit_location').value = location;
    document.getElementById('edit_sport').value = sport;
    document.getElementById('edit_day_time').value = day_time;
    document.getElementById('edit_state').value = state;
    $('#editTrainerModal').modal('show');
}
