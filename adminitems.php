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

// Function to add item to the database
function addItem($conn, $item_id, $item_name, $category, $description, $price, $photo) {
    $sql = "INSERT INTO items (item_id, item_name, category, description, price, photo) VALUES ('$item_id', '$item_name', '$category', '$description', '$price', '$photo')";
    if ($conn->query($sql) === TRUE) {
        echo "Item added successfully";
    } else {
        echo "Error adding item: " . $conn->error;
    }
}

// Function to delete item from the database
function deleteItem($conn, $item_id) {
    $sql = "DELETE FROM items WHERE item_id='$item_id'";
    if ($conn->query($sql) === TRUE) {
        echo "Item deleted successfully";
    } else {
        echo "Error deleting item: " . $conn->error;
    }
}

// Check if form is submitted for adding item
if (isset($_POST['add'])) {
    $item_id = $_POST['item_id'];
    $item_name = $_POST['item_name'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Upload photo
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["photo"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check file size
    if ($_FILES["photo"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["photo"]["name"])). " has been uploaded.";
            $photo = $target_file;
            addItem($conn, $item_id, $item_name, $category, $description, $price, $photo);
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

// Check if form is submitted for deleting item
if (isset($_POST['delete'])) {
    $item_id = $_POST['item_id'];
    deleteItem($conn, $item_id);
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add/Delete Item</title>
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

        input[type="file"] {
            margin-bottom: 15px;
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
        <h2>Add Item</h2>
        <form method="post" action="" enctype="multipart/form-data">
            <label for="item_id">Item ID:</label>
            <input type="text" id="item_id" name="item_id">
            <label for="item_name">Item Name:</label>
            <input type="text" id="item_name" name="item_name">
            <label for="category">Category:</label>
            <input type="text" id="category" name="category">
            <label for="description">Description:</label>
            <input type="text" id="description" name="description">
            <label for="price">Price:</label>
            <input type="text" id="price" name="price">
            <label for="photo">Photo:</label>
            <input type="file" id="photo" name="photo">
            <button type="submit" name="add">Add Item</button>
        </form>

        <h2>Delete Item</h2>
        <form method="post" action="">
            <label for="delete_item_id">Enter Item ID of Item to delete:</label>
            <input type="text" id="delete_item_id" name="item_id">
            <button type="submit" name="delete">Delete Item</button>
        </form>
    </div>
    <?php include 'footer.php' ?>
</body>
</html>
