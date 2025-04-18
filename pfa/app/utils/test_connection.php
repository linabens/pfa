<?php
require_once __DIR__ . '/../config/database.php';

$database = new Database();
$conn = $database->getConnection();

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT 1";
if ($conn->query($sql) === TRUE) {
    echo "Connection and query test successful.";
} else {
    echo "Error executing test query: " . $conn->error;
}

$conn->close();
?> 