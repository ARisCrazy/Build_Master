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

// Function to add processor to the database
function addProcessor($conn, $cpu_id, $cpu_full_name, $price) {
    $sql = "INSERT INTO processor (cpu_id, cpu_full_name, price) VALUES ('$cpu_id', '$cpu_full_name', '$price')";
    if ($conn->query($sql) === TRUE) {
        echo "Processor added successfully";
    } else {
        echo "Error adding processor: " . $conn->error;
    }
}

// Function to delete processor from the database
function deleteProcessor($conn, $cpu_id) {
    $sql = "DELETE FROM processor WHERE cpu_id='$cpu_id'";
    if ($conn->query($sql) === TRUE) {
        echo "Processor deleted successfully";
    } else {
        echo "Error deleting processor: " . $conn->error;
    }
}

// Check if form is submitted for adding processor
if (isset($_POST['add'])) {
    $cpu_id = $_POST['cpu_id'];
    $cpu_full_name = $_POST['cpu_full_name'];
    $price = $_POST['price'];
    addProcessor($conn, $cpu_id, $cpu_full_name, $price);
}

// Check if form is submitted for deleting processor
if (isset($_POST['delete'])) {
    $cpu_id = $_POST['cpu_id'];
    deleteProcessor($conn, $cpu_id);
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add/Delete Processor</title>
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
        <h2>Add Processor</h2>
        <form method="post" action="">
            <label for="cpu_id">Processor ID:</label>
            <input type="text" id="cpu_id" name="cpu_id">
            <label for="cpu_full_name">Processor Full Name:</label>
            <input type="text" id="cpu_full_name" name="cpu_full_name">
            <label for="price">Price:</label>
            <input type="text" id="price" name="price">
            <button type="submit" name="add">Add Processor</button>
        </form>

        <h2>Delete Processor</h2>
        <form method="post" action="">
            <label for="delete_cpu_id">Enter Processor ID of Processor to delete:</label>
            <input type="text" id="delete_cpu_id" name="cpu_id">
            <button type="submit" name="delete">Delete Processor</button>
        </form>
    </div>
    <?php include 'footer.php' ?>
</body>
</html>
