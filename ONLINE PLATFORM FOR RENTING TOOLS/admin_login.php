<?php
// Assuming your database connection details
$servername = "localhost";
$username = "root";
$password = "";
$database = "online_platform_for_renting_tools";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetching values from the form
$admin_name = $_POST['admin_name'];
$password = $_POST['password'];

// Query to check if admin credentials are valid
$sql = "SELECT * FROM admins WHERE admin_name = '$admin_name' AND password = '$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Admin login successful
    session_start();
    $_SESSION['admin_name'] = $admin_name;
    header("Location: admin.html"); // Redirect to admin dashboard
    exit();
} else {
    // Admin login failed
    echo "Invalid admin credentials. Please try again.";
}

$conn->close();
?>
