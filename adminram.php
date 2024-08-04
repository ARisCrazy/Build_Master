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

// Function to add RAM to the database
function addRAM($conn, $ram_id, $ram_full_name, $price) {
    $sql = "INSERT INTO ram (ram_id, ram_full_name, price) VALUES ('$ram_id', '$ram_full_name', '$price')";
    if ($conn->query($sql) === TRUE) {
        echo "RAM added successfully";
    } else {
        echo "Error adding RAM: " . $conn->error;
    }
}

// Function to delete RAM from the database
function deleteRAM($conn, $ram_id) {
    $sql = "DELETE FROM ram WHERE ram_id='$ram_id'";
    if ($conn->query($sql) === TRUE) {
        echo "RAM deleted successfully";
    } else {
        echo "Error deleting RAM: " . $conn->error;
    }
}

// Check if form is submitted for adding RAM
if (isset($_POST['add'])) {
    $ram_id = $_POST['ram_id'];
    $ram_full_name = $_POST['ram_full_name'];
    $price = $_POST['price'];
    addRAM($conn, $ram_id, $ram_full_name, $price);
}

// Check if form is submitted for deleting RAM
if (isset($_POST['delete'])) {
    $ram_id = $_POST['ram_id'];
    deleteRAM($conn, $ram_id);
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add/Delete RAM</title>
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
<?php include 'navigation.php' ?>
    <div class="container">
        <h2>Add RAM</h2>
        <form method="post" action="">
            <label for="ram_id">RAM ID:</label>
            <input type="text" id="ram_id" name="ram_id">
            <label for="ram_full_name">RAM Full Name:</label>
            <input type="text" id="ram_full_name" name="ram_full_name">
            <label for="price">Price:</label>
            <input type="text" id="price" name="price">
            <button type="submit" name="add">Add RAM</button>
        </form>

        <h2>Delete RAM</h2>
        <form method="post" action="">
            <label for="delete_ram_id">Enter RAM ID of RAM to delete:</label>
            <input type="text" id="delete_ram_id" name="ram_id">
            <button type="submit" name="delete">Delete RAM</button>
        </form>
    </div>
    <?php include 'footer.php' ?>
</body>
</html>
