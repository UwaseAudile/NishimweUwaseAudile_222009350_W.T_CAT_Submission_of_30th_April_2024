
<?php
require_once'config.php';
// Initialize ID variable
$id = null;

// Check if ID is set and form is submitted
if (isset($_GET['updateID']) && isset($_POST['submit'])) {
     $id = $_POST['id'];
     $tool_name = $_POST['tool_name'];
   $description = $_POST['description'];
    $price_per_day = $_POST['price_per_day'];
    $available = $_POST['available'];
    $owner_id = $_POST['owner_id'];
    $created_at = $_POST['created_at'];

    // Prepare and execute the UPDATE statement
    $stmt = $conn->prepare("UPDATE tools SET tool_name=?, description=?, price_per_day=?, available=?, owner_id=?, created_at=? WHERE ID=?");
$stmt->bind_param("ssssss", $tool_name, $description, $price_per_day, $available, $owner_id, $created_at);


    if ($stmt->execute()) {
        header('Location: tools.php?msg=Record updated successfully');
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
}

// Fetch existing data for the selected ID
if (isset($_GET['updateID'])) {
    $id = $_GET['updateID'];
    $sql_select = "SELECT * FROM tools WHERE ID=$id";
    $result = $conn->query($sql_select);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No record found for ID: $id";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Head content here -->
</head>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tools</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css">
    <style>
        /* Add your CSS styles here */
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .btn-secondary {
            background-color: #ccc;
            color: #000;
        }

        .btn-secondary:hover {
            background-color: #999;
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }
        }

    </style>
</head>
<body>
    <div class="container">
        <?php
        if (isset($_GET['msg'])) {
            $msg = $_GET['msg'];
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">' . $msg . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
        ?>
        <h2>Update Tools Record</h2>
        <form method="POST" action="">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <label for="tool_name">Tool Name:</label>
            <input type="text" id="tool_name" name="tool_name"value="<?php echo $row['tool_name']; ?>" required>
          </div>
          <div class="form-group">
            <label for="description">description:</label>
            <textarea id="description" name="description"value="<?php echo $row['description']; ?>" required></textarea>
          </div>
          <div class="form-group">
            <label for="price_per_day">price_per_day:</label>
            <input type="price_per_day" id="price_per_day" name="price_per_day"value="<?php echo $row['price_per_day']; ?>" required>
          </div>
          
          <div class="form-group">
            <label for="available">available:</label>
            <input type="available" id="available" name="available"value="<?php echo $row['available']; ?>" required>
          </div>
          <div class="form-group">
            <label for="owner_id">owner_id:</label>
            <input type="owner_id" id="owner_id" name="owner_id"value="<?php echo $row['owner_id']; ?>" required>
          </div>
          <div class="form-group">
            <label for="created_at">created_at:</label>
            <input type="created_at" id="created_at" name="created_at"value="<?php echo $row['created_at']; ?>" required>
          </div>
            <div class="form-group">
                <input type="submit" name="submit" value="Update" class="btn btn-primary">
                <a href="tools.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>
">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <!-- Rest of the form -->
        </form>
    </div>
</body>
</html>
