<?php

header("Content-Type: application/json");

$conn = new mysqli("localhost", "root", "", "fuelgr");

if ($conn->connect_error) {
    die(json_encode([
        "status" => "error",
        "message" => "DB connection failed"
    ]));
}

$gasStationID = $_GET['gasStationID'] ?? null;

if (!$gasStationID) {
    echo json_encode([
        "status" => "error",
        "message" => "Missing gasStationID"
    ]);
    exit;
}

$sql = "
SELECT 
    o.orderID,
    o.username,
    o.quantity,
    o.when,
    p.fuelName,
    p.fuelPrice,
    p.gasStationID
FROM orders o
JOIN pricedata p ON o.productID = p.productID
WHERE p.gasStationID = '$gasStationID'
";

$result = $conn->query($sql);

$orders = [];

while ($row = $result->fetch_assoc()) {
    $orders[] = $row;
}

echo json_encode([
    "status" => "success",
    "count" => count($orders),
    "data" => $orders
]);

?>