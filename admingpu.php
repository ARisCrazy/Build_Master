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

// Function to add GPU to the database
function addGPU($conn, $gpu_id, $gpu_full_name, $price) {
    $sql = "INSERT INTO gpu (gpu_id, gpu_full_name, price) VALUES ('$gpu_id', '$gpu_full_name', '$price')";
    if ($conn->query($sql) === TRUE) {
        echo "GPU added successfully";
    } else {
        echo "Error adding GPU: " . $conn->error;
    }
}

// Function to delete GPU from the database
function deleteGPU($conn, $gpu_id) {
    $sql = "DELETE FROM gpu WHERE gpu_id='$gpu_id'";
    if ($conn->query($sql) === TRUE) {
        echo "GPU deleted successfully";
    } else {
        echo "Error deleting GPU: " . $conn->error;
    }
}

// Check if form is submitted for adding GPU
if (isset($_POST['add'])) {
    $gpu_id = $_POST['gpu_id'];
    $gpu_full_name = $_POST['gpu_full_name'];
    $price = $_POST['price'];
    addGPU($conn, $gpu_id, $gpu_full_name, $price);
}

// Check if form is submitted for deleting GPU
if (isset($_POST['delete'])) {
    $gpu_id = $_POST['gpu_id'];
    deleteGPU($conn, $gpu_id);
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add/Delete GPU</title>
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
        <h2>Add GPU</h2>
        <form method="post" action="">
            <label for="gpu_id">GPU ID:</label>
            <input type="text" id="gpu_id" name="gpu_id">
            <label for="gpu_full_name">GPU Full Name:</label>
            <input type="text" id="gpu_full_name" name="gpu_full_name">
            <label for="price">Price:</label>
            <input type="text" id="price" name="price">
            <button type="submit" name="add">Add GPU</button>
        </form>

        <h2>Delete GPU</h2>
        <form method="post" action="">
            <label for="delete_gpu_id">Enter GPU ID of GPU to delete:</label>
            <input type="text" id="delete_gpu_id" name="gpu_id">
            <button type="submit" name="delete">Delete GPU</button>
        </form>
    </div>
    <?php include 'footer.php' ?>
</body>
</html>
