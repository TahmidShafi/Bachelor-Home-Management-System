
document.getElementById('loginForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    const messageDiv = document.getElementById('message');

    if (!username || !password) {
        messageDiv.style.color = 'red';
        messageDiv.innerText = "Please fill in all fields.";
        return;
    }

    const formData = {
        username: username,
        password: password
    };

    fetch('login.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(formData)
    })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                messageDiv.style.color = 'green';
                messageDiv.innerText = "Login Successful! Redirecting...";

                setTimeout(() => {
                    window.location.href = data.redirectUrl;
                }, 1000);
            } else {
                messageDiv.style.color = 'red';
                messageDiv.innerText = data.message;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            messageDiv.innerText = "An error occurred. Please try again.";
        });
});