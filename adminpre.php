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

// Function to add prebuilt system to the database
function addPrebuilt($conn, $prdid, $prdname, $prddesc, $prdprice, $photo) {
    $sql = "INSERT INTO prebuilt (prdid, prdname, prddesc, prdprice, photo) VALUES ('$prdid', '$prdname', '$prddesc', '$prdprice', '$photo')";
    if ($conn->query($sql) === TRUE) {
        echo "Prebuilt system added successfully";
    } else {
        echo "Error adding prebuilt system: " . $conn->error;
    }
}

// Function to delete prebuilt system from the database
function deletePrebuilt($conn, $prdid) {
    $sql = "DELETE FROM prebuilt WHERE prdid='$prdid'";
    if ($conn->query($sql) === TRUE) {
        echo "Prebuilt system deleted successfully";
    } else {
        echo "Error deleting prebuilt system: " . $conn->error;
    }
}

// Check if form is submitted for adding prebuilt system
if (isset($_POST['add'])) {
    $prdid = $_POST['prdid'];
    $prdname = $_POST['prdname'];
    $prddesc = $_POST['prddesc'];
    $prdprice = $_POST['prdprice'];

    // Upload photo
    $target_dir = "prebuilt/";
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
            addPrebuilt($conn, $prdid, $prdname, $prddesc, $prdprice, $photo);
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

// Check if form is submitted for deleting prebuilt system
if (isset($_POST['delete'])) {
    $prdid = $_POST['prdid'];
    deletePrebuilt($conn, $prdid);
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add/Delete Prebuilt System</title>
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
        <h2>Add Prebuilt System</h2>
        <form method="post" action="" enctype="multipart/form-data">
            <label for="prdid">Prebuilt ID:</label>
            <input type="text" id="prdid" name="prdid">
            <label for="prdname">Prebuilt Name:</label>
            <input type="text" id="prdname" name="prdname">
            <label for="prddesc">Description:</label>
            <input type="text" id="prddesc" name="prddesc">
            <label for="prdprice">Price:</label>
            <input type="text" id="prdprice" name="prdprice">
            <label for="photo">Photo:</label>
            <input type="file" id="photo" name="photo">
            <button type="submit" name="add">Add Prebuilt</button>
        </form>

        <h2>Delete Prebuilt System</h2>
        <form method="post" action="">
            <label for="delete_prdid">Enter Prebuilt ID of system to delete:</label>
            <input type="text" id="delete_prdid" name="prdid">
            <button type="submit" name="delete">Delete Prebuilt</button>
        </form>
    </div>
    <?php include 'footer.php' ?>
</body>
</html>
