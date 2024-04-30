<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" type="text/css" href="style.css">

    <style>
        /* Global styles for links */
        a {
            padding: 10px;
            color: white;
            background-color: pink;
            text-decoration: none;
            margin-right: 15px;
        }

        a:visited {
            color: purple;
        }

        a:link {
            color: brown;
        }

        a:hover {
            background-color: white;
        }

        a:active {
            background-color: red;
        }

        /* Styles for search button and input */
        button.btn {
            margin-left: 15px;
            margin-top: 4px;
            background-color: blue;
            border: none;
        }

        input.form-control {
            width: 200px; /* Adjust width as needed */
            padding: 8px;
        }

        /* Styles for table */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
</header>
<section>
    <h1><u>deliverymen Form</u></h1>
    <form method="post">
         <label for="deliveryman_id">deliveryman_id:</label>
        <input type="number" id="deliveryman_id" name="deliveryman_id"><br><br>
        <label for="deliveryman_name">deliveryman_name:</label>
        <input type="text" id="deliveryman_name" name="deliveryman_name" required><br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        <label for="phone_number">phone_number:</label>
        <input type="text" id="phone_number" name="phone_number" required><br><br>
        <label for="created_at">created_at:</label>
        <input type="datetime-local" id="created_at" name="created_at"><br><br>
        
        <input type="submit" name="add" value="Insert"><br><br>
    </form>
<?php
require_once'config.php';
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $conn->prepare("INSERT INTO deliverymen(deliveryman_id, deliveryman_name, email, phone_number, created_at) VALUES (?, ?, ?, ?, ?)"); 
    $stmt->bind_param("sssss", $deliveryman_id, $deliveryman_name , $email, $phone_number, $created_at);

    // Set parameters
    $deliveryman_id = $_POST['deliveryman_id']; // Corrected variable name
    $deliveryman_name = $_POST['deliveryman_name'];    
    $email = $_POST['email']; // Corrected variable name
    $phone_number = $_POST['phone_number'];
    $created_at = $_POST['created_at']; 
    // Execute the statement
    if ($stmt->execute()) {
        echo "New record has been added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// SQL query to fetch data from the deliverymen table
$sql = "SELECT * FROM deliverymen";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail information Of deliverymen</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <center><form action="search_events" method="GET"><input type="text" name="query" placeholder="search here">
    <button>search</button></form><h2>Table of Deliverymen</h2></center>
    <table border="5">
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>phone_number</th>
            <th>Created_at</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
        // Check if there are any deliveryman
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                $did = $row['deliveryman_id']; // Corrected variable name
                echo "<tr>
                     <td>" . $row['deliveryman_id'] . "</td>
                    <td>" . $row['deliveryman_name'] . "</td>
                    <td>" . $row['email'] . "</td>
                    <td>" . $row['phone_number'] . "</td>
                    <td>" . $row['created_at'] . "</td>
                    
                      <td><a style='padding:4px' href='delete_dlvman.php?deliveryman_id=$did'>Delete</a></td> 
                    <td><a style='padding:4px' href='update_dlvman.php?deliveryman_id=$did'>Update</a></td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No data found</td></tr>";
        }
        // Close the database connection
        $conn->close();
        ?>
    </table>
</body>
</html>
