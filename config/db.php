<?php
$host = "localhost";
$username = "root";
$password = "";  // Usually empty in XAMPP
$database = "per_fragrances";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");
?>