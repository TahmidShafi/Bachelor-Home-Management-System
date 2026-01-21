<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bachelor Home - Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="login-container">
        <h2>System Login (MVC)</h2>

        <?php if (isset($error))
            echo "<p style='color:red; text-align:center;'>$error</p>"; ?>
        <?php if (isset($_GET['msg']) && $_GET['msg'] == 'registered')
            echo "<p style='color:green; text-align:center;'>Registration Successful! Please Login.</p>"; ?>

        <form action="index.php?controller=auth&action=login" method="POST" style="text-align: center;">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>

            <button type="submit" class="btn-login">Login</button>
        </form>

        <div style="text-align: center; margin-top: 20px;">
            <a href="index.php?controller=auth&action=register"
                style="text-decoration: none; color: #007bff; font-weight: bold;">New Resident? Register Here</a>
        </div>
    </div>

</body>

</html>