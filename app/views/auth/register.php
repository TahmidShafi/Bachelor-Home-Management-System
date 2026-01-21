<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resident Registration</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="login-container">
        <h2>New Resident Registration (MVC)</h2>

        <?php if (isset($error))
            echo "<p style='color:red; text-align:center;'>$error</p>"; ?>

        <form action="index.php?controller=auth&action=register" method="POST" style="text-align: center;">
            <input type="text" name="username" placeholder="Choose a Username" required>
            <input type="password" name="password" placeholder="Choose a Password" required>
            <input type="text" name="phone" placeholder="Phone Number" required>
            <input type="text" name="emergency_contact" placeholder="Emergency Contact (Name & Phone)" required>
            <input type="text" name="nid" placeholder="NID Number" required>
            <input type="text" name="occupation" placeholder="Occupation" required>

            <button type="submit" class="btn-login">Register</button>
        </form>

        <div style="text-align: center; margin-top: 20px;">
            <a href="index.php?controller=auth&action=login"
                style="text-decoration: none; color: #007bff; font-weight: bold;">Back to Login</a>
        </div>
    </div>

</body>

</html>