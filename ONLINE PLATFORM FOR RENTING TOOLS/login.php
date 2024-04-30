<?php
session_start(); // Starting the session

$connection = new mysqli("localhost", "root", "", "online_platform_for_renting_tools");
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $connection->query($sql);

    if ($result !== false) {
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if ($password == $row['password']) {
                $_SESSION['id'] = $row['user_id']; // Set the user_id session variable
                header("Location: home.html");
                exit();
            } else {
                echo "Invalid email or password.";
            }
        } else {
            echo "User not found.";
        }
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
}

$connection->close();
?>
