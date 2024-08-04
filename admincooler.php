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

// Function to add CPU cooler to the database
function addCPUCooler($conn, $cooler_id, $cooler_full_name, $price) {
    $sql = "INSERT INTO cpu_cooler (cooler_id, cooler_full_name, price) VALUES ('$cooler_id', '$cooler_full_name', '$price')";
    if ($conn->query($sql) === TRUE) {
        echo "CPU cooler added successfully";
    } else {
        echo "Error adding CPU cooler: " . $conn->error;
    }
}

// Function to delete CPU cooler from the database
function deleteCPUCooler($conn, $cooler_id) {
    $sql = "DELETE FROM cpu_cooler WHERE cooler_id='$cooler_id'";
    if ($conn->query($sql) === TRUE) {
        echo "CPU cooler deleted successfully";
    } else {
        echo "Error deleting CPU cooler: " . $conn->error;
    }
}

// Check if form is submitted for adding CPU cooler
if (isset($_POST['add'])) {
    $cooler_id = $_POST['cooler_id'];
    $cooler_full_name = $_POST['cooler_full_name'];
    $price = $_POST['price'];
    addCPUCooler($conn, $cooler_id, $cooler_full_name, $price);
}

// Check if form is submitted for deleting CPU cooler
if (isset($_POST['delete'])) {
    $cooler_id = $_POST['cooler_id'];
    deleteCPUCooler($conn, $cooler_id);
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add/Delete CPU Cooler</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            margin-top: 0;
            color: #333;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #666;
        }
        input[type="text"], button {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<?php include 'adminNav.php' ?>
    <div class="container">
        <h2>Add CPU Cooler</h2>
        <br><br>
        <form method="post" action="">
            <label for="cooler_id">Cooler ID:</label>
            <input type="text" id="cooler_id" name="cooler_id">
            <label for="cooler_full_name">Cooler Full Name:</label>
            <input type="text" id="cooler_full_name" name="cooler_full_name">
            <label for="price">Price:</label>
            <input type="text" id="price" name="price">
            <button type="submit" name="add">Add CPU Cooler</button>
        </form>
        <br><br>

        <h2>Delete CPU Cooler</h2>
        <br>
        <form method="post" action="">
            <label for="delete_cooler_id">Enter Cooler ID of CPU cooler to delete:</label>
            <input type="text" id="delete_cooler_id" name="cooler_id">
            <button type="submit" name="delete">Delete CPU Cooler</button>
        </form>
    </div>
    <?php include 'footer.php' ?>
</body>
</html>

