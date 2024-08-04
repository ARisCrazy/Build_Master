<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wp_project";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
}

// Get the item ID from the URL parameter
$itemId = $_GET['id'];

// Delete the item from the cart_items table
$sql = "DELETE FROM cart_items WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $itemId);
$stmt->execute();

$conn->close();

// Redirect back to the cart page
header("Location: kart.php");
exit();
?>
