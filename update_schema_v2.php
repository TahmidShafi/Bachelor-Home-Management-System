<?php
include 'config.php';

$alters = [
    "ALTER TABLE users ADD COLUMN phone VARCHAR(20) DEFAULT NULL",
    "ALTER TABLE users ADD COLUMN emergency_contact VARCHAR(20) DEFAULT NULL",
    "ALTER TABLE users ADD COLUMN nid VARCHAR(50) DEFAULT NULL",
    "ALTER TABLE users ADD COLUMN occupation VARCHAR(100) DEFAULT NULL"
];

foreach ($alters as $sql) {
    if ($conn->query($sql) === TRUE) {
        echo "Column added successfully: $sql \n";
    } else {
        echo "Error altering table: " . $conn->error . "\n";
    }
}

$conn->close();
?>