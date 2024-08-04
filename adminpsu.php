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

// Function to add power supply to the database
function addPowerSupply($conn, $ps_id, $ps_full_name, $price) {
    $sql = "INSERT INTO power_supply (ps_id, ps_full_name, price) VALUES ('$ps_id', '$ps_full_name', '$price')";
    if ($conn->query($sql) === TRUE) {
        echo "Power supply added successfully";
    } else {
        echo "Error adding power supply: " . $conn->error;
    }
}

// Function to delete power supply from the database
function deletePowerSupply($conn, $ps_id) {
    $sql = "DELETE FROM power_supply WHERE ps_id='$ps_id'";
    if ($conn->query($sql) === TRUE) {
        echo "Power supply deleted successfully";
    } else {
        echo "Error deleting power supply: " . $conn->error;
    }
}

// Check if form is submitted for adding power supply
if (isset($_POST['add'])) {
    $ps_id = $_POST['ps_id'];
    $ps_full_name = $_POST['ps_full_name'];
    $price = $_POST['price'];
    addPowerSupply($conn, $ps_id, $ps_full_name, $price);
}

// Check if form is submitted for deleting power supply
if (isset($_POST['delete'])) {
    $ps_id = $_POST['ps_id'];
    deletePowerSupply($conn, $ps_id);
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add/Delete Power Supply</title>
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
        <h2>Add Power Supply</h2>
        <form method="post" action="">
            <label for="ps_id">Power Supply ID:</label>
            <input type="text" id="ps_id" name="ps_id">
            <label for="ps_full_name">Power Supply Full Name:</label>
            <input type="text" id="ps_full_name" name="ps_full_name">
            <label for="price">Price:</label>
            <input type="text" id="price" name="price">
            <button type="submit" name="add">Add Power Supply</button>
        </form>

        <h2>Delete Power Supply</h2>
        <form method="post" action="">
            <label for="delete_ps_id">Enter Power Supply ID of Power Supply to delete:</label>
            <input type="text" id="delete_ps_id" name="ps_id">
            <button type="submit" name="delete">Delete Power Supply</button>
        </form>
    </div>
    <?php include 'footer.php' ?>
</body>
</html>
