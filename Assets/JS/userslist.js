function openEditModal(id, username, email) {
    document.getElementById('edit_id').value = id;
    document.getElementById('edit_username').value = username;
    document.getElementById('edit_email').value = email;
    $('#editUserModal').modal('show');
}

function confirmDelete() {
    return confirm('Are you sure you want to delete this user?');
}
