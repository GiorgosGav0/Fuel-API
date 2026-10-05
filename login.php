<?php
header("Content-Type: application/json");
require "db.php";

$username = $_GET["username"] ?? null;
$password = $_GET["password"] ?? null;

if (!$username || !$password) {
    echo json_encode([
        "status" => "error",
        "message" => "Missing username or password"
    ]);
    exit;
}

$sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo json_encode([
        "status" => "success",
        "message" => "Login successful",
        "user" => $username
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Invalid credentials"
    ]);
}
?>