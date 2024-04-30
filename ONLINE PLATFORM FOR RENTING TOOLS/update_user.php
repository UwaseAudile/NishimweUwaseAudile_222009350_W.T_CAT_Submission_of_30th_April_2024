<?php
// Connection details
require_once'config.php';

// Check if user_id is set
if(isset($_REQUEST['user_id'])) {
    $user_id = $_REQUEST['user_id'];
    
    // Prepare and execute SELECT statement to retrieve user details
    $stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $fname = $row['fname'];
        $lname = $row['lname'];
        $phone = $row['phone'];
        $gender = $row['gender'];
        $dob = $row['dob'];
        $email = $row['email'];
        $password = $row['password'];
    } else {
        echo "User not found.";
    }
}

?>

<html>
<body>
    <form method="POST">
        <label for="fname">First Name:</label>
        <input type="text" name="fname" value="<?php echo isset($fname) ? $fname : ''; ?>">
        <br><br>

        <label for="lname">Last Name:</label>
        <input type="text" name="lname" value="<?php echo isset($lname) ? $lname : ''; ?>">
        <br><br>
        
        <label for="phone">Phone:</label>
        <input type="text" name="phone" value="<?php echo isset($phone) ? $phone : ''; ?>">
        <br><br>
        
        <label for="gender">Gender:</label>
        <input type="text" name="gender" value="<?php echo isset($gender) ? $gender : ''; ?>">
        <br><br>
        
        <label for="dob">Date of Birth:</label>
        <input type="text" name="dob" value="<?php echo isset($dob) ? $dob : ''; ?>">
        <br><br>
        
        <label for="email">Email:</label>
        <input type="text" name="email" value="<?php echo isset($email) ? $email : ''; ?>">
        <br><br>
        
        <label for="password">Password:</label>
        <input type="password" name="password" value="<?php echo isset($password) ? $password : ''; ?>">
        <br><br>
       
        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];    
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Update the table in the database
    $stmt = $conn->prepare("UPDATE users SET fname=?, lname=?, phone=?, gender=?, dob=?, email=?, password=? WHERE user_id=?");
    $stmt->bind_param("sssssssi", $fname, $lname, $phone, $gender, $dob, $email, $password, $user_id);
    
    if ($stmt->execute()) {
        // Redirect to user_table.php after successful update
        header('Location: user.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating user: " . $stmt->error;
    }
}
?>
