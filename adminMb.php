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

// Function to add motherboard to the database
function addMotherboard($conn, $mb_id, $mb_full_name, $price) {
    $sql = "INSERT INTO motherboard (mb_id, mb_full_name, price) VALUES ('$mb_id', '$mb_full_name', '$price')";
    if ($conn->query($sql) === TRUE) {
        echo "Motherboard added successfully";
    } else {
        echo "Error adding motherboard: " . $conn->error;
    }
}

// Function to delete motherboard from the database
function deleteMotherboard($conn, $mb_id) {
    $sql = "DELETE FROM motherboard WHERE mb_id='$mb_id'";
    if ($conn->query($sql) === TRUE) {
        echo "Motherboard deleted successfully";
    } else {
        echo "Error deleting motherboard: " . $conn->error;
    }
}

// Check if form is submitted for adding motherboard
if (isset($_POST['add'])) {
    $mb_id = $_POST['mb_id'];
    $mb_full_name = $_POST['mb_full_name'];
    $price = $_POST['price'];
    addMotherboard($conn, $mb_id, $mb_full_name, $price);
}

// Check if form is submitted for deleting motherboard
if (isset($_POST['delete'])) {
    $mb_id = $_POST['mb_id'];
    deleteMotherboard($conn, $mb_id);
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add/Delete Motherboard</title>
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
        <h2>Add Motherboard</h2>
        <form method="post" action="">
            <label for="mb_id">Motherboard ID:</label>
            <input type="text" id="mb_id" name="mb_id">
            <label for="mb_full_name">Motherboard Full Name:</label>
            <input type="text" id="mb_full_name" name="mb_full_name">
            <label for="price">Price:</label>
            <input type="text" id="price" name="price">
            <button type="submit" name="add">Add Motherboard</button>
        </form>

        <h2>Delete Motherboard</h2>
        <form method="post" action="">
            <label for="delete_mb_id">Enter Motherboard ID of Motherboard to delete:</label>
            <input type="text" id="delete_mb_id" name="mb_id">
            <button type="submit" name="delete">Delete Motherboard</button>
        </form>
    </div>
    <?php include 'footer.php' ?>
</body>
</html>
