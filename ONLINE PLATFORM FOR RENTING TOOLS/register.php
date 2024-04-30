<?php
$connection= new mysqli("localhost","root","","online_platform_for_renting_tools");
if ($connection->connect_error) {
    die("connection failed:".$connection->connect_error);
}

// Handling POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieving form data
    $fname  = $_POST['fname'];
    $lname = $_POST['lname'];
    $Phone = $_POST['Phone'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $created_at = $_POST['created_at'];
    // Preparing SQL query
    $sql = "INSERT INTO users (fname, lname, Phone, gender, dob, email, password, created_at ) 
    VALUES ('$fname','$lname','$Phone','$gender','$dob','$email','$password','$created_at')";

    // Executing SQL query
    if ($connection->query($sql) === TRUE) {
        // Redirecting to login page on successful registration
        header("Location: login.html");
        exit();
    } else {
        // Displaying error message if query execution fails
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
}

// Closing database connection
$connection->close();
?>
