 <!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Search Website</title>
</head>
<body><center>
<table border="1">
    <tr>
         <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>phone_number</th>
            <th>Created_at</th>
    </tr>
<?php

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["query"])) {

    $search_query = $_GET["query"];
}
require_once'config.php';
    
    $sql = "SELECT * FROM deliverymen WHERE deliveryman_name LIKE '%$search_query%'";

   
    $result = $conn->query($sql);

   
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<p><strong>welcome:</strong> " . $row["deliveryman_name"] . "</p>";
            echo "<hr>";
            echo "<tr>";
            echo "<td>".$row["deliveryman_id"]."</td>";
            echo "<td>".$row["deliveryman_name"]."</td>";
            echo "<td>".$row["email"]."</td>";
            echo "<td>".$row["phone_number"]."</td>";
            echo "<td>".$row["created_at"]."</td>";
             
            echo "</tr>";
           
        }
    } else {
        echo "No results found.";
    }

    // Close connection
    $conn->close();
}
?>
</table></center>/<br>
<center><button style="width: 100px;height: 40px; background-color: violet; color: white;"><a href="dlvman.php">back</a></button></center>
</body>
</html>
