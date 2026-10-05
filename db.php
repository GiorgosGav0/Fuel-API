<?php
$conn = new mysqli("localhost", "root", "", "fuelgr");

if ($conn->connect_error) {
    die("DB connection failed");
}
?>