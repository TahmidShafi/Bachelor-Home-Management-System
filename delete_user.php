<?php


session_start();
include 'config.php';

// 1. Security Check: Only Admin can delete users
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo json_encode(["status" => "error", "message" => "Unauthorized Access"]);
    exit();
}

// 2. Setup JSON Response
error_reporting(0);
header('Content-Type: application/json');

// 3. Get ID from Request
$json = file_get_contents('php://input');
$data = json_decode($json, true);
$user_id = isset($data['id']) ? $conn->real_escape_string($data['id']) : '';

// 4. Delete from Database
$sql = "DELETE FROM users WHERE id = '$user_id'";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["status" => "success", "message" => "User deleted successfully!"]);
} else {
    echo json_encode(["status" => "error", "message" => "Database Error: " . $conn->error]);
}

$conn->close();
?>