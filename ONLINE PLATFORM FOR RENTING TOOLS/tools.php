<?php
require_once'config.php';
// Insert data if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind the parameters
    $stmt = $conn->prepare("INSERT INTO tools (tool_name,description,price_per_day,available,owner_id,created_at) VALUES (?,?,?,?,?,?)");

    // Check if the statement was prepared successfu */
    $tool_name = $_POST['tool_name'];
   $description = $_POST['description'];
    $price_per_day = $_POST['price_per_day'];
    $available = $_POST['available'];
    $owner_id = $_POST['owner_id'];
    $created_at = $_POST['created_at'];
    if ($stmt === false) {
        die("Error in preparing statement: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("ssssss", $tool_name, $description, $price_per_day, $available, $owner_id, $created_at);

    // Set parameters and execute
   

    if ($stmt->execute()) {
        echo "New record has been added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

// Selecting data from the database
$sql_select = "SELECT * FROM tools";

// Check if search form is submitted
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['search'])) {
    $search = $_GET['search'];
    // Add search condition to SQL query
    $sql_select .= " WHERE tool_name LIKE '%$search%' OR description LIKE '%$search%' OR price_per_day LIKE '%$search%' OR available LIKE '%$search%' OR owner_id LIKE '%$search%' OR created_at LIKE '%$search%'";
}

$result = $conn->query($sql_select);
?>