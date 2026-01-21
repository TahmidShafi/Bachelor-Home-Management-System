<?php

session_start();
include 'config.php'; // Connect to database

// Setup JSON environment
// We turn off display_errors to make sure only our JSON reply reaches the browser.
error_reporting(0);
ini_set('display_errors', 0);
header('Content-Type: application/json');

// 2. Read the data sent from the browser
$json = file_get_contents('php://input');
$data = json_decode($json, true);

// Check if data is valid JSON
if ($data === null) {
    echo json_encode(["status" => "error", "message" => "Invalid JSON input"]);
    exit();
}

// 3. Extract and Clean Data (Prevent SQL Injection)
// Using real_escape_string for every input field
$username = isset($data['username']) ? $conn->real_escape_string($data['username']) : '';
$password = isset($data['password']) ? $conn->real_escape_string($data['password']) : '';
$phone = isset($data['phone']) ? $conn->real_escape_string($data['phone']) : '';
$emergency_contact = isset($data['emergency_contact']) ? $conn->real_escape_string($data['emergency_contact']) : '';
$nid = isset($data['nid']) ? $conn->real_escape_string($data['nid']) : '';
$occupation = isset($data['occupation']) ? $conn->real_escape_string($data['occupation']) : '';

// 4. Basic Validation
if (empty($username) || empty($password)) {
    echo json_encode(["status" => "error", "message" => "Username and Password are required"]);
    exit();
}

// 5. Check if Username is already taken
$checkSql = "SELECT * FROM users WHERE username = '$username'";
$result = $conn->query($checkSql);

if ($result && $result->num_rows > 0) {
    echo json_encode(["status" => "error", "message" => "Username already taken!"]);
} else {
    // 6. Create the New User (Default role is 'resident')
    $insertSql = "INSERT INTO users (username, password, role, phone, emergency_contact, nid, occupation) 
                  VALUES ('$username', '$password', 'resident', '$phone', '$emergency_contact', '$nid', '$occupation')";

    if ($conn->query($insertSql) === TRUE) {
        echo json_encode(["status" => "success", "message" => "Registration Successful! Please Login."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Database Error: " . $conn->error]);
    }
}

$conn->close();
?>