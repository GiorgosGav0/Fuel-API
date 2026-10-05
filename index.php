<?php

$format = $_GET['format'] ?? 'json';

$conn = new mysqli("localhost", "root", "", "fuelgr");

if ($conn->connect_error) {
    die(json_encode([
        "status" => "error",
        "message" => "DB connection failed"
    ]));
}

$sql = "SELECT * FROM gasstations";
$result = $conn->query($sql);

$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

if ($format == "xml") {
    header("Content-Type: application/xml; charset=UTF-8");

    $xml = new SimpleXMLElement('<stations/>');

    foreach ($data as $row) {
        $station = $xml->addChild('station');

        foreach ($row as $key => $value) {
            $station->addChild(
                $key,
                htmlspecialchars($value ?? '')
            );
        }
    }

    echo $xml->asXML();
    exit;
}

header("Content-Type: application/json; charset=UTF-8");

echo json_encode([
    "status" => "success",
    "count" => count($data),
    "data" => $data
], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

?>