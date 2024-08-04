<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== "TRUE") {
    // Redirect the user to the login page if not logged in
    header("Location: login.php");
    exit();
}

// Database connection details
$servername = "localhost"; // Change this if your database is hosted elsewhere
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$dbname = "wp_project"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if user_id is set in the session
if (!isset($_SESSION['user_id'])) {
    echo "User ID not found in session.";
    exit();
}

// Prepare SQL query to fetch user details based on user_id
$user_id = $_SESSION['user_id']; // Get user_id from session
$sql = "SELECT * FROM user_data WHERE user_id = '$user_id'";

// Execute the query
$result = $conn->query($sql);

// Initialize variables to store user details
$email = "";
$firstname = "";
$mobileNumber = "";

// Check if there are any rows returned
if ($result->num_rows > 0) {
    // Fetch user details
    $row = $result->fetch_assoc();
    $email = $row["user_id"];
    $firstname = $row["firstname"];
    $mobileNumber = $row["mobile-number"];
} else {
    echo "No user found"; // Displayed if no user with the given user_id is found in the database
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
</head>
<body>
    <h2>User Profile</h2>
    <form action="#" method="post">
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" value="<?php echo $email; ?>"><br><br>
        
        <label for="firstname">First Name:</label><br>
        <input type="text" id="firstname" name="firstname" value="<?php echo $firstname; ?>"><br><br>
        
        <label for="mobileNumber">Mobile Number:</label><br>
        <input type="text" id="mobileNumber" name="mobileNumber" value="<?php echo $mobileNumber; ?>"><br><br>
        
        <!-- Add other form fields as needed -->
        
        <input type="submit" value="Update Profile">
    </form>
</body>
</html>
