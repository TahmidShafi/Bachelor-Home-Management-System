<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bachelor Home - Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="login-container">
        <h2>System Login</h2>

        <form id="loginForm" style="text-align: center;">
            <input type="text" id="username" placeholder="Username" required>
            <input type="password" id="password" placeholder="Password" required>

            <button type="submit" class="btn-login">Login</button>
        </form>

        <div style="text-align: center; margin-top: 20px;">
            <a href="register.php" style="text-decoration: none; color: #007bff; font-weight: bold;">New Resident?
                Register Here</a>
        </div>

        <div id="message" style="margin-top: 10px; text-align: center; font-weight: bold;"></div>
    </div>

    <script src="script.js"></script>
</body>

</html>