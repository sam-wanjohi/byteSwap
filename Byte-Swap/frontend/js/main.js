document.addEventListener('DOMContentLoaded', function () {
    const registerForm = document.querySelector('#registerForm');
    if (registerForm) {
        registerForm.addEventListener('submit', function (event) {
            event.preventDefault();
            const formData = new FormData(registerForm);
            fetch('/register', {
                method: 'POST',
                body: JSON.stringify({
                    username: formData.get('username'),
                    email: formData.get('email'),
                    phone: formData.get('phone'),
                    password: formData.get('password'),
                }),
                headers: {
                    'Content-Type': 'application/json',
                },
            })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    if (data.message === 'Registered successfully') {
                        window.location.href = 'login.html';
                    }
                })