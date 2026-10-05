<?php

header("Content-Type: application/json");

$conn = new mysqli("localhost", "root", "", "fuelgr");

if ($conn->connect_error) {
    die(json_encode([
        "status" => "error",
        "message" => "DB connection failed"
    ]));
}

$data = json_decode(file_get_contents("php://input"), true);

$orderID = $data['orderID'] ?? null;

if (!$orderID) {
    echo json_encode([
        "status" => "error",
        "message" => "Missing orderID"
    ]);
    exit;
}

$sql = "
UPDATE orders
SET executed = 1
WHERE orderID = '$orderID'
";

if ($conn->query($sql)) {
    echo json_encode([
        "status" => "success",
        "message" => "Order executed"
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => $conn->error
    ]);
}

?>