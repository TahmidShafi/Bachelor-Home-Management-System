<?php
session_start(); // Start a session to remember the logged-in user
include 'config.php'; // Connect to the database

header('Content-Type: application/json');

$json = file_get_contents('php://input');
$data = json_decode($json, true); // Convert JSON to PHP array

$username = isset($data['username']) ? $conn->real_escape_string($data['username']) : '';
$password = isset($data['password']) ? $conn->real_escape_string($data['password']) : '';

$sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc(); 

    $_SESSION['username'] = $row['username'];
    $_SESSION['role'] = $row['role'];

    $redirectPage = "index.php"; 
    if ($row['role'] == 'admin') {
        $redirectPage = "dashboard_admin.php";
    } elseif ($row['role'] == 'supervisor') {
        $redirectPage = "dashboard_supervisor.php";
    } elseif ($row['role'] == 'resident') {
        $redirectPage = "dashboard_resident.php";
    }

    echo json_encode([
        "status" => "success",
        "redirectUrl" => $redirectPage,
        "role" => $row['role']
    ]);

} else {

    echo json_encode(["status" => "error", "message" => "Invalid Username or Password"]);
}

$conn->close(); 
?>