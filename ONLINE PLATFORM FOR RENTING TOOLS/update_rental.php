<?php
require_once'config.php';
// Check if rental_id is set
if(isset($_REQUEST['rental_id'])) {
    $rental_id = $_REQUEST['rental_id'];
    
    // Prepare and execute SELECT statement to retrieve rental details
    $stmt = $conn->prepare("SELECT * FROM rentals WHERE rental_id = ?");
    $stmt->bind_param("i", $rental_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $tool_id = $row['tool_id'];
        $user_id = $row['user_id'];
        $user_name = $row['user_name'];
        $tool_name = $row['tool_name'];
        $rental_start = $row['rental_start'];
        $rental_end = $row['rental_end'];
        $total_price = $row['total_price'];
        $rental_status = $row['rental_status'];
    } else {
        echo "Rental not found.";
    }
}

?>

<html>
<body>
    <form method="POST">
        <label for="tool_id">Tool ID:</label>
        <input type="number" name="tool_id" value="<?php echo isset($tool_id) ? $tool_id : ''; ?>">
        <br><br>

        <label for="user_id">User ID:</label>
        <input type="number" name="user_id" value="<?php echo isset($user_id) ? $user_id : ''; ?>">
        <br><br>
        
        <label for="user_name">User Name:</label>
        <input type="text" name="user_name" value="<?php echo isset($user_name) ? $user_name : ''; ?>">
        <br><br>
        
        <label for="tool_name">Tool Name:</label>
        <input type="text" name="tool_name" value="<?php echo isset($tool_name) ? $tool_name : ''; ?>">
        <br><br>
        
        <label for="rental_start">Rental Start:</label>
        <input type="date" name="rental_start" value="<?php echo isset($rental_start) ? $rental_start : ''; ?>">
        <br><br>
        
        <label for="rental_end">Rental End:</label>
        <input type="date" name="rental_end" value="<?php echo isset($rental_end) ? $rental_end : ''; ?>">
        <br><br>
        
        <label for="total_price">Total Price:</label>
        <input type="number" name="total_price" value="<?php echo isset($total_price) ? $total_price : ''; ?>">
        <br><br>
        
        <label for="rental_status">Rental Status:</label>
        <input type="text" name="rental_status" value="<?php echo isset($rental_status) ? $rental_status : ''; ?>">
        <br><br>
       
        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $tool_id = $_POST['tool_id'];
    $user_id = $_POST['user_id'];    
    $user_name = $_POST['user_name'];
    $tool_name = $_POST['tool_name'];
    $rental_start = $_POST['rental_start'];
    $rental_end = $_POST['rental_end'];
    $total_price = $_POST['total_price'];
    $rental_status = $_POST['rental_status'];
    
    // Update the table in the database
    $stmt = $conn->prepare("UPDATE rentals SET tool_id=?, user_id=?, user_name=?, tool_name=?, rental_start=?, rental_end=?, total_price=?, rental_status=? WHERE rental_id=?");
    $stmt->bind_param("iissdidsi", $tool_id, $user_id, $user_name, $tool_name, $rental_start, $rental_end, $total_price, $rental_status, $rental_id);
    
    if ($stmt->execute()) {
        // Redirect to rental_table.php after successful update
        header('Location: rental.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating rental: " . $stmt->error;
    }
}
?>
