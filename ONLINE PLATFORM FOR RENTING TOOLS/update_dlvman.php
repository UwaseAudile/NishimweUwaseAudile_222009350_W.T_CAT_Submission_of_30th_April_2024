<?php
require_once'config.php';
// Check if deliveryman_id is set
    if(isset($_REQUEST['deliveryman_id'])) {
    $deliveryman_id = $_REQUEST['deliveryman_id'];
    
    // Prepare and execute SELECT statement to retrieve deliverymen details
    $stmt = $conn->prepare("SELECT * FROM deliverymen WHERE deliveryman_id = ?");
    $stmt->bind_param("i", $deliveryman_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['deliveryman_id'];
        $z = $row['deliveryman_name'];
        $y = $row['email'];
        $z = $row['phone_number'];
        $u = $row['created_at'];
       

    } else {
        echo "delivery man not found.";
    }
}

?>

<html>
<body>
    <form method="POST">
        <label for="deliveryman_id">deliveryman_id:</label>
        <input type="number" name="deliveryman_id" value="<?php echo isset($x) ? $x : ''; ?>">
        <br><br>

        <label for="deliveryman_name">deliveryman_name:</label>
        <input type="text" name="deliveryman_name" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>
        
        <label for="email">email:</label>
        <input type="text" name="email" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>
        <label for="phone_number">phone_number:</label>
        <input type="text" name="phone_number" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>
        <label for="created_at">created_at:</label>
        <input type="text" name="created_at" value="<?php echo isset($u) ? $u : ''; ?>">
        <br><br>
        
       
        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $deliveryman_id = $_POST['deliveryman_id'];
    $deliveryman_name = $_POST['deliveryman_name'];    
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $created_at = $_POST['created_at']; 
    
    // Update the table in the database
    $stmt = $conn->prepare("UPDATE deliverymen SET deliveryman_name=?, email=?, phone_number=?, created_at WHERE deliveryman_id=?");
    $stmt->bind_param("sssss", $deliveryman_name, $email, $phone_number, $created_at);
    
    if ($stmt->execute()) {
        // Redirect to dlvman.php after successful update
        header('Location: dlvman.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating deliverymen: " . $stmt->error;
    }
}
?>
