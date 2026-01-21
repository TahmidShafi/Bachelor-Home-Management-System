<?php
function register_user($conn, $username, $password, $phone, $emergency_contact, $nid, $occupation, $role = 'resident')
{

    $username = htmlspecialchars(strip_tags($username));
    $phone = htmlspecialchars(strip_tags($phone));
    $emergency_contact = htmlspecialchars(strip_tags($emergency_contact));
    $nid = htmlspecialchars(strip_tags($nid));
    $occupation = htmlspecialchars(strip_tags($occupation));

    $status = ($role === 'admin') ? 'approved' : 'pending';

    $sql = "INSERT INTO users (username, password, role, phone, emergency_contact, nid, occupation, status) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssss", $username, $password, $role, $phone, $emergency_contact, $nid, $occupation, $status);

    if ($stmt->execute()) {
        return true;
    }
    return false;
}

function user_exists($conn, $username)
{
    $sql = "SELECT id FROM users WHERE username = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    return $stmt->num_rows > 0;
}


function authenticate_user($conn, $username, $password)
{
    $sql = "SELECT id, username, password, role, status FROM users WHERE username = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Plain text comparison (Legacy method)
        if ($user['password'] === $password) {
            return $user; // Return user array on success
        }
    }
    return false;
}
?>