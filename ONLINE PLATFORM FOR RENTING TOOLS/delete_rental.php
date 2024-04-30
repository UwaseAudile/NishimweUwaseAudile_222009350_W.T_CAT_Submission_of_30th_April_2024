<?php
require_once'config.php';
// Check if rental_id is set
if(isset($_REQUEST['rental_id'])) {
    $rental_id = $_REQUEST['rental_id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $conn->prepare("DELETE FROM rentals WHERE rental_id=?");
    $stmt->bind_param("i", $rental_id);
    
    if ($stmt->execute()) {
        // Redirect to rental_table.php after successful deletion
        header('location: rental.php?msg=Data deleted successfully');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error deleting data: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "rental_id is not set.";
}

$conn->close();
?>
