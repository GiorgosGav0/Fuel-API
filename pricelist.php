<?php
header("Content-Type: application/json");
require "db.php";

$station = $_GET["station"] ?? null;

if (!$station) {
    echo json_encode([
        "status" => "error",
        "message" => "Missing station id"
    ]);
    exit;
}

$sql = "SELECT * FROM pricedata WHERE gasStationID = $station";
$result = $conn->query($sql);

$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode([
    "status" => "success",
    "station" => $station,
    "count" => count($data),
    "data" => $data
]);
?>