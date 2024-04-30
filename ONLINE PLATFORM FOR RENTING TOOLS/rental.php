<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Form</title>
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
<section>
    <h1><u>Rental Form</u></h1>
    <!-- Rental Form -->
    <form method="post">
        <label for="user_id">User ID:</label>
        <input type="number" id="user_id" name="user_id"><br><br>
        <label for="user_name">User Name:</label>
        <input type="text" id="user_name" name="user_name" required><br><br>
        <label for="tool_id">Tool ID:</label>
        <input type="number" id="tool_id" name="tool_id"><br><br>
        <label for="tool_name">Tool Name:</label>
        <input type="text" id="tool_name" name="tool_name" required><br><br>
        <label for="rental_start">Rental Start:</label>
        <input type="date" id="rental_start" name="rental_start" required><br><br>
        <label for="rental_end">Rental End:</label>
        <input type="date" id="rental_end" name="rental_end" required><br><br>
        <label for="total_price">Total Price:</label>
        <input type="number" id="total_price" name="total_price" required><br><br>
        <label for="rental_status">Rental Status:</label>
        <select id="rental_status" name="rental_status">
            <option value="active">Active</option>
            <option value="completed">Completed</option>
            <option value="cancelled">Cancelled</option>
        </select><br><br>
        <input type="submit" name="add" value="Insert"><br><br>
    </form>
    <?php
   require_once'config.php';
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $stmt = $conn->prepare("INSERT INTO rentals(user_id, user_name, tool_id, tool_name, rental_start, rental_end, total_price, rental_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isississ", $user_id, $user_name, $tool_id, $tool_name, $rental_start, $rental_end, $total_price, $rental_status);

        // Set parameters
        $user_id = $_POST['user_id'];
        $user_name = $_POST['user_name'];
        $tool_id = $_POST['tool_id'];
        $tool_name = $_POST['tool_name'];
        $rental_start = $_POST['rental_start'];
        $rental_end = $_POST['rental_end'];
        $total_price = $_POST['total_price'];
        $rental_status = $_POST['rental_status'];

        // Execute the statement
        if ($stmt->execute()) {
            echo "Rental was successful!";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }
    // Retrieving and displaying rental information
    $sql = "SELECT * FROM rentals";
    $result = $conn->query($sql);
    ?>
    <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail information Of rentals</title>
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
    <button>search</button></form><h2>Table of rentals</h2></center>
    <table border="5">
        <tr>
    <!-- Displaying rental information in a table -->
    <h2>Rental Information</h2>
    <table border="1">
        <tr>
            <th>Rental ID</th>
            <th>User ID</th>
            <th>User Name</th>
            <th>Tool ID</th>
            <th>Tool Name</th>
            <th>Rental Start</th>
            <th>Rental End</th>
            <th>Total Price</th>
            <th>Rental Status</th>
        </tr>
        <?php
        // Check if there are any rentals
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                $rid = $row['rental_id']; // rental ID
                echo "<tr>
                    <td>" . $row['rental_id'] . "</td>
                    <td>" . $row['user_id'] . "</td>
                    <td>" . $row['user_name'] . "</td>
                    <td>" . $row['tool_id'] . "</td>
                    <td>" . $row['tool_name'] . "</td>
                    <td>" . $row['rental_start'] . "</td>
                    <td>" . $row['rental_end'] . "</td>
                    <td>" . $row['total_price'] . "</td>
                    <td>" . $row['rental_status'] . "</td>
                 <td><a style='padding:4px' href='delete_rental.php?rental_id=$rid'>Delete</a></td> 
                    <td><a style='padding:4px' href='update_rental.php?rental_id=$rid'>Update</a></td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='10'>No data found</td></tr>";
        }
        // Close the database connection
        $conn->close();
        ?>
    </table>
</section>
<footer>
    <center> 
        <b><h2>UR CBE BIT &copy; 2024 &reg;, Designed by: @Audile Uwase</h2></b>
    </center>
</footer>
</body>
</html>
