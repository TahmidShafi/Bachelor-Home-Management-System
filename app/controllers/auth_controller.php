<?php
require_once '../app/config/database.php';
require_once '../app/models/user_model.php';

// Determine the action to perform (default is 'login')
$action = isset($_GET['action']) ? $_GET['action'] : 'login';

switch ($action) {
    case 'login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Process Login Form Submission    
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Attempt to authenticate the user
            $user = authenticate_user($conn, $username, $password);

            if ($user) {
                session_start();
                // Check if the user account is approved by an Admin
                if ($user['status'] !== 'approved') {
                    $error = "Account pending approval.";
                    require_once '../app/views/auth/login.php';
                    break;
                }

                // Set session variables for the logged-in user
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['user_id'] = $user['id'];

                // Redirect based on user role
                if ($user['role'] == 'admin')
                    header("Location: index.php?controller=admin&action=dashboard");
                elseif ($user['role'] == 'supervisor')
                    header("Location: index.php?controller=supervisor&action=dashboard");
                else
                    header("Location: index.php?controller=resident&action=dashboard");
                exit();
            } else {
                // Authentication failed
                $error = "Invalid Username or Password";
                require_once '../app/views/auth/login.php';
            }
        } else {
            // Display Login Form
            require_once '../app/views/auth/login.php';
        }
        break;

    case 'register':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Process Registration Form Submission
            $username = $_POST['username'];
            $password = $_POST['password'];
            $phone = $_POST['phone'];
            $emergency_contact = $_POST['emergency_contact'];
            $nid = $_POST['nid'];
            $occupation = $_POST['occupation'];

            // Check if functionality is enabled (Legacy check, assuming true for now)
            if (defined('data_reset_button_safe_code') || true) {
                // Check if username already exists
                if (user_exists($conn, $username)) {
                    $error = "Username already exists.";
                    require_once '../app/views/auth/register.php';
                } else {
                    // Attempt to register the new user
                    if (register_user($conn, $username, $password, $phone, $emergency_contact, $nid, $occupation)) {
                        // Registration successful, redirect to login with success message
                        header("Location: index.php?controller=auth&action=login&msg=registered");
                        exit();
                    } else {
                        $error = "Registration Failed.";
                        require_once '../app/views/auth/register.php';
                    }
                }
            }
        } else {
            // Display Registration Form
            require_once '../app/views/auth/register.php';
        }
        break;

    case 'logout':
        session_start();
        session_destroy(); // session data destroy
        header("Location: index.php?controller=auth&action=login");
        break;

    default:
        // invalid action 
        echo "404 - Action not found";
        break;
}
?>