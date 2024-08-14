document.addEventListener('DOMContentLoaded', function() {
    fetch('profile.php')
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                document.getElementById('username').textContent = data.user.username;
                document.getElementById('email').textContent = data.user.email;
                document.getElementById('phone').textContent = data.user.phone;
            } else {
                console.error('Error fetching user data:', data.message);
            }
        })
        .catch(error => console.error('Error:', error));
});