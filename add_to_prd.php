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

$itemName = $_POST['prdname'];
$itemPrice = $_POST['prdprice'];
$quantity = $_POST['quantity'];
$total = $itemPrice * $quantity;

$sql = "INSERT INTO cart_items (item_name, item_price, quantity, total) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssdi", $itemName, $itemPrice, $quantity, $total);
$stmt->execute();

$conn->close();

// Redirect back to the cart page
header("Location: kart.php");
exit();
?>