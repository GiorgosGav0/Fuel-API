<?php
header("Content-Type: application/json");
require "db.php";

$username = $_GET["username"] ?? null;

if (!$username) {
    echo json_encode([
        "status" => "error",
        "message" => "Missing username"
    ]);
    exit;
}

$sql = "SELECT * FROM orders WHERE username = '$username'";
$result = $conn->query($sql);

$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode([
    "status" => "success",
    "count" => count($data),
    "data" => $data
]);
?>