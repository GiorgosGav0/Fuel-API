<?php
header("Content-Type: application/json");

$conn = new mysqli("localhost", "root", "", "fuelgr");

$sql = "SELECT * FROM gasstations";
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