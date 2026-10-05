<?php
header("Content-Type: application/json");
require "db.php";

$productID = $_GET["productID"] ?? null;
$fuelPrice = $_GET["fuelPrice"] ?? null;

if (!$productID || !$fuelPrice) {
    echo json_encode([
        "status" => "error",
        "message" => "Missing productID or fuelPrice"
    ]);
    exit;
}

$sql = "UPDATE pricedata 
        SET fuelPrice = '$fuelPrice'
        WHERE productID = '$productID'";

if ($conn->query($sql)) {
    echo json_encode([
        "status" => "success",
        "message" => "Price updated"
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => $conn->error
    ]);
}
?>