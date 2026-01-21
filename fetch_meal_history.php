<?php
session_start();
include 'config.php';

// 1. Security Check
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'supervisor') {
    echo json_encode(["status" => "error", "message" => "Unauthorized Access"]);
    exit();
}

header('Content-Type: application/json');

// 2. Get Target User
$target_user = isset($_GET['user']) ? $conn->real_escape_string($_GET['user']) : '';

if (empty($target_user)) {
    echo json_encode([]);
    exit();
}

// 3. Fetch Data
$sql = "SELECT * FROM meals WHERE resident_name = '$target_user' ORDER BY date DESC LIMIT 30";
$result = $conn->query($sql);

$data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

echo json_encode($data);

$conn->close();
?>