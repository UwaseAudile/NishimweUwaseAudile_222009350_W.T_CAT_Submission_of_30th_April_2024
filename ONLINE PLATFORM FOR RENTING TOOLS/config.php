<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "online_platform_for_renting_tools";

// Create connection
$conn = new mysqli( $servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
