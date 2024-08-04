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

// Get item details from the form
$itemName = $_POST['item_name'];
$itemPrice = $_POST['item_price'];
$quantity = $_POST['quantity'];
$total = $itemPrice * $quantity;

// Insert the item into the cart_items table
$sql = "INSERT INTO cart_items (item_name, item_price, quantity, total) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssdi", $itemName, $itemPrice, $quantity, $total);
$stmt->execute();

$conn->close();

// Redirect back to the cart page
header("Location: kart.php");
exit();
?>
