<?php


include 'config.php';

// Setup JSON output
error_reporting(0);
header('Content-Type: application/json');

// 1. Fetch notices older than 24 hours
$sql = "SELECT * FROM notices WHERE created_at <= NOW() - INTERVAL 24 HOUR ORDER BY created_at DESC";
$result = $conn->query($sql);

$notices = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $notices[] = $row;
    }
}

// 2. Return data
echo json_encode(["status" => "success", "data" => $notices]);

$conn->close();
?>