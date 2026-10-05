<?php
header("Content-Type: application/json");
require "db.php";

$sql1 = "SELECT COUNT(*) AS totalStations FROM gasstations";
$res1 = $conn->query($sql1);
$totalStations = $res1->fetch_assoc()["totalStations"];

$sql2 = "SELECT 
            MIN(fuelPrice) AS minPrice,
            MAX(fuelPrice) AS maxPrice,
            ROUND(AVG(fuelPrice), 3) AS avgPrice
         FROM pricedata";

$res2 = $conn->query($sql2);
$prices = $res2->fetch_assoc();

echo json_encode([
    "status" => "success",
    "totalStations" => (int)$totalStations,
    "minPrice" => (float)$prices["minPrice"],
    "maxPrice" => (float)$prices["maxPrice"],
    "avgPrice" => (float)$prices["avgPrice"]
]);
?>