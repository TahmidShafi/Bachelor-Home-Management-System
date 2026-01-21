<?php
session_start();
include 'config.php';

// 1. Security Check: Only Admin can post notices
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo json_encode(["status" => "error", "message" => "Unauthorized Access"]);
    exit();
}

// 2. Setup JSON Response
error_reporting(0);
header('Content-Type: application/json');

// 3. Get Data from Request Body
$json = file_get_contents('php://input');
$data = json_decode($json, true);

$title = isset($data['title']) ? $conn->real_escape_string($data['title']) : '';
$message = isset($data['message']) ? $conn->real_escape_string($data['message']) : '';

// 4. Insert Notice into Database
$sql = "INSERT INTO notices (title, message) VALUES ('$title', '$message')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["status" => "success", "message" => "Notice Published Successfully!"]);
} else {
    echo json_encode(["status" => "error", "message" => "Database Error: " . $conn->error]);
}

$conn->close();
?>