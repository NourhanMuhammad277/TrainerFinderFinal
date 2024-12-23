document.getElementById('signupForm').addEventListener('submit', function(event) {
    let valid = true;
    const username = document.getElementById('username').value.trim();
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value.trim();
    const confirmPassword = document.getElementById('confirmPassword').value.trim();

    if (username === '') {
        valid = false;
        alert('Username is required.');
    }
    if (email === '') {
        valid = false;
        alert('Email is required.');
    }
    if (password === '') {
        valid = false;
        alert('Password is required.');
    }
    if (password !== confirmPassword) {
        valid = false;
        alert('Passwords do not match.');
    }

    if (!valid) {
        event.preventDefault();
    }
});
