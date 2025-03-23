<?php
$host = "localhost";
$user = "root";  // Default user for XAMPP
$pass = "";      // Leave blank for XAMPP
$dbname = "auth_system";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
