<?php
    if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<?php //check if already logged in
        if(!isset($_SESSION['customer']) || empty($_SESSION['customer']) )
        {
            header('location:adminlogin.php');
        }
?>
<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wp_project";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to add SSD to the database
function addSSD($conn, $ssd_id, $ssd_full_name, $price) {
    $sql = "INSERT INTO ssd (ssd_id, ssd_full_name, price) VALUES ('$ssd_id', '$ssd_full_name', '$price')";
    if ($conn->query($sql) === TRUE) {
        echo "SSD added successfully";
    } else {
        echo "Error adding SSD: " . $conn->error;
    }
}

// Function to delete SSD from the database
function deleteSSD($conn, $ssd_id) {
    $sql = "DELETE FROM ssd WHERE ssd_id='$ssd_id'";
    if ($conn->query($sql) === TRUE) {
        echo "SSD deleted successfully";
    } else {
        echo "Error deleting SSD: " . $conn->error;
    }
}

// Check if form is submitted for adding SSD
if (isset($_POST['add'])) {
    $ssd_id = $_POST['ssd_id'];
    $ssd_full_name = $_POST['ssd_full_name'];
    $price = $_POST['price'];
    addSSD($conn, $ssd_id, $ssd_full_name, $price);
}

// Check if form is submitted for deleting SSD
if (isset($_POST['delete'])) {
    $ssd_id = $_POST['ssd_id'];
    deleteSSD($conn, $ssd_id);
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add/Delete SSD</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<?php include 'adminNav.php' ?>
    <div class="container">
        <h2>Add SSD</h2>
        <form method="post" action="">
            <label for="ssd_id">SSD ID:</label>
            <input type="text" id="ssd_id" name="ssd_id">
            <label for="ssd_full_name">SSD Full Name:</label>
            <input type="text" id="ssd_full_name" name="ssd_full_name">
            <label for="price">Price:</label>
            <input type="text" id="price" name="price">
            <button type="submit" name="add">Add SSD</button>
        </form>

        <h2>Delete SSD</h2>
        <form method="post" action="">
            <label for="delete_ssd_id">Enter SSD ID of SSD to delete:</label>
            <input type="text" id="delete_ssd_id" name="ssd_id">
            <button type="submit" name="delete">Delete SSD</button>
        </form>
    </div>
    <?php include 'footer.php' ?>
</body>
</html>
