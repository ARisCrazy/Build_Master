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

// Function to add cabinet to the database
function addCabinet($conn, $cabinet_id, $model_name, $full_name, $price) {
    $sql = "INSERT INTO cabinet (cabinet_id, model_name, full_name, price) VALUES ('$cabinet_id', '$model_name', '$full_name', '$price')";
    if ($conn->query($sql) === TRUE) {
        echo "Cabinet added successfully";
    } else {
        echo "Error adding cabinet: " . $conn->error;
    }
}

// Function to delete cabinet from the database
function deleteCabinet($conn, $cabinet_id) {
    $sql = "DELETE FROM cabinet WHERE cabinet_id='$cabinet_id'";
    if ($conn->query($sql) === TRUE) {
        echo "Cabinet deleted successfully";
    } else {
        echo "Error deleting cabinet: " . $conn->error;
    }
}

// Check if form is submitted for adding cabinet
if (isset($_POST['add'])) {
    $cabinet_id = $_POST['cabinet_id'];
    $model_name = $_POST['model_name'];
    $full_name = $_POST['full_name'];
    $price = $_POST['price'];
    addCabinet($conn, $cabinet_id, $model_name, $full_name, $price);
}

// Check if form is submitted for deleting cabinet
if (isset($_POST['delete'])) {
    $cabinet_id = $_POST['cabinet_id'];
    deleteCabinet($conn, $cabinet_id);
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add/Delete Cabinet</title>
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
        <h2>Add Cabinet</h2>
        <form method="post" action="">
            <label for="cabinet_id">Cabinet ID:</label>
            <input type="text" id="cabinet_id" name="cabinet_id">
            <label for="model_name">Model Name:</label>
            <input type="text" id="model_name" name="model_name">
            <label for="full_name">Full Name:</label>
            <input type="text" id="full_name" name="full_name">
            <label for="price">Price:</label>
            <input type="text" id="price" name="price">
            <button type="submit" name="add">Add Cabinet</button>
        </form>

        <h2>Delete Cabinet</h2>
        <form method="post" action="">
            <label for="delete_cabinet_id">Enter Cabinet ID of Cabinet to delete:</label>
            <input type="text" id="delete_cabinet_id" name="cabinet_id">
            <button type="submit" name="delete">Delete Cabinet</button>
        </form>
    </div>
    <?php include 'footer.php' ?>
</body>
</html>
