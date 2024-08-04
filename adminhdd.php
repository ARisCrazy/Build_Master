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

// Function to add HDD to the database
function addHDD($conn, $hdd_id, $hdd_full_name, $price) {
    $sql = "INSERT INTO hdd (hdd_id, hdd_full_name, price) VALUES ('$hdd_id', '$hdd_full_name', '$price')";
    if ($conn->query($sql) === TRUE) {
        echo "HDD added successfully";
    } else {
        echo "Error adding HDD: " . $conn->error;
    }
}

// Function to delete HDD from the database
function deleteHDD($conn, $hdd_id) {
    $sql = "DELETE FROM hdd WHERE hdd_id='$hdd_id'";
    if ($conn->query($sql) === TRUE) {
        echo "HDD deleted successfully";
    } else {
        echo "Error deleting HDD: " . $conn->error;
    }
}

// Check if form is submitted for adding HDD
if (isset($_POST['add'])) {
    $hdd_id = $_POST['hdd_id'];
    $hdd_full_name = $_POST['hdd_full_name'];
    $price = $_POST['price'];
    addHDD($conn, $hdd_id, $hdd_full_name, $price);
}

// Check if form is submitted for deleting HDD
if (isset($_POST['delete'])) {
    $hdd_id = $_POST['hdd_id'];
    deleteHDD($conn, $hdd_id);
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add/Delete HDD</title>
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
        <h2>Add HDD</h2>
        <form method="post" action="">
            <label for="hdd_id">HDD ID:</label>
            <input type="text" id="hdd_id" name="hdd_id">
            <label for="hdd_full_name">HDD Full Name:</label>
            <input type="text" id="hdd_full_name" name="hdd_full_name">
            <label for="price">Price:</label>
            <input type="text" id="price" name="price">
            <button type="submit" name="add">Add HDD</button>
        </form>

        <h2>Delete HDD</h2>
        <form method="post" action="">
            <label for="delete_hdd_id">Enter HDD ID of HDD to delete:</label>
            <input type="text" id="delete_hdd_id" name="hdd_id">
            <button type="submit" name="delete">Delete HDD</button>
        </form>
    </div>
    <?php include 'footer.php' ?>
</body>
</html>
