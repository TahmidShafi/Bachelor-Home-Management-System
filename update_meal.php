<?php
session_start();
include 'config.php';
include 'period_utils.php';

// Security Check: Residents or Supervisors allowed
if (!isset($_SESSION['role']) || ($_SESSION['role'] !== 'resident' && $_SESSION['role'] !== 'supervisor')) {
    echo json_encode(["status" => "error", "message" => "Unauthorized Access"]);
    exit();
}

error_reporting(0);
header('Content-Type: application/json');

$json = file_get_contents('php://input');
$data = json_decode($json, true);

$resident = $_SESSION['username'];

// Allow Supervisor to update on behalf of others
if ($_SESSION['role'] === 'supervisor' && isset($data['target_user']) && !empty($data['target_user'])) {
    $resident = $conn->real_escape_string($data['target_user']);
}
$date = isset($data['date']) ? $conn->real_escape_string($data['date']) : '';
$original_date = isset($data['original_date']) ? $conn->real_escape_string($data['original_date']) : '';

// Retrieve meal counts as integers
$lunch = isset($data['lunch']) ? (int) $data['lunch'] : 0;
$dinner = isset($data['dinner']) ? (int) $data['dinner'] : 0;

// Special Handling for Date Changes
// If the user changed the date of an existing meal entry, we must delete the old one
// because the Primary/Unique key often involves the date.
if (!empty($original_date) && $original_date !== $date) {
    $del_sql = "DELETE FROM meals WHERE resident_name='$resident' AND date='$original_date'";
    $conn->query($del_sql);
}

$period_id = get_active_period_id($conn);
if (!$period_id) {
    echo json_encode(["status" => "error", "message" => "No active period found!"]);
    exit();
}

// Use UPSERT (Insert ... ON DUPLICATE KEY UPDATE)
// If a record exists for this User + Date, it updates it. If not, it creates it.
$sql = "INSERT INTO meals (date, resident_name, lunch, dinner, period_id) 
        VALUES ('$date', '$resident', '$lunch', '$dinner', '$period_id')
        ON DUPLICATE KEY UPDATE lunch='$lunch', dinner='$dinner', period_id='$period_id'";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["status" => "success", "message" => "Meal preference updated!"]);
} else {
    echo json_encode(["status" => "error", "message" => "Database Error: " . $conn->error]);
}

$conn->close();
?>