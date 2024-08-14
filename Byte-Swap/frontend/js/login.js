document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('loginForm');
    form.addEventListener('submit', async (event) => {
        event.preventDefault();

        const username = document.getElementById('username').value;
        const email = document.getElementById('email').value;
        const phone = document.getElementById('phone').value;
        const password = document.getElementById('password').value;

        try {
            const response = await fetch('../../backend/users/login.php', { 
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    username: username,
                    email: email,
                    phone: phone,
                    password: password
                })
            });

            const result = await response.json();

            if (result.status === 'success') {
                // Handle successful login (e.g., redirect or show a message)
                window.location.href = 'marketplace.html'; 
            } else {
                // Show error message
                document.getElementById('message').textContent = result.message;
            }
        } catch (error) {
            console.error('Error:', error);
            document.getElementById('message').textContent = 'An error occurred. Please try again.';
        }
    });
});