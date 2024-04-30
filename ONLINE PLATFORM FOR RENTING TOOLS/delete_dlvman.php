<?php
require_once'config.php';
// Check deliveryman_id is set
if(isset($_REQUEST['deliveryman_id'])) {
    $deliveryman_id = $_REQUEST['deliveryman_id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $conn->prepare("DELETE FROM deliverymen WHERE deliveryman_id=?");
    $stmt->bind_param("i", $deliveryman_id);
    
    if ($stmt->execute()) {
        // Redirect to facultytable.php after successful deletion
        header('location: dlvman.php?msg=Data deleted successfully');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error deleting data: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "faculty_id is not set.";
}

$conn->close();
?>
