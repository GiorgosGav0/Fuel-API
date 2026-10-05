<?php
header("Content-Type: application/json");
require "db.php";

$orderID = $_GET["orderID"] ?? null;

if (!$orderID) {
    echo json_encode([
        "status" => "error",
        "message" => "Missing orderID"
    ]);
    exit;
}

$sql = "DELETE FROM orders WHERE orderID = '$orderID'";

if ($conn->query($sql)) {
    echo json_encode([
        "status" => "success",
        "message" => "Order deleted"
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => $conn->error
    ]);
}
?>