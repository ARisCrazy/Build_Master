<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wp_project";
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve user data from database
$email = $_SESSION['email'];
$sql = "SELECT * FROM user WHERE email = '$email'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $email = $row['email'];
    // You can retrieve more user data here if needed
} else {
    echo "User not found.";
}

// Close database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="pro.css"> <!-- Assuming you have a CSS file -->
</head>
<body>
    <div class="container">
        <h1>Welcome, <?php echo $_SESSION['email']; ?>!</h1>
        <div class="profile-info">
            <p><strong>Email:</strong> <?php echo $_SESSION['email']; ?></p>
            <p><strong>Email:</strong> <?php echo $email; ?></p>
            <!-- Add more profile information here if needed -->
        </div>
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>
