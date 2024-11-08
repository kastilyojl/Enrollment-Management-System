<?php
// Database Connection
// $host = "192.168.18.57";
$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "schedule";

// Connect to database
$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
