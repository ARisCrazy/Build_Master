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

// Query to fetch the number of customers who have bought products
$sql = "SELECT COUNT(DISTINCT userid) AS num_customers FROM product_details";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $num_customers = $row['num_customers'];

    echo "<h2>Total Number of Customers: $num_customers</h2>";

    // Query to fetch the distinct userids for generating invoices
    $sql_invoices = "SELECT DISTINCT userid FROM product_details";
    $result_invoices = $conn->query($sql_invoices);

    if ($result_invoices->num_rows > 0) {
        while ($row_invoice = $result_invoices->fetch_assoc()) {
            $userid = $row_invoice['userid'];
            echo "<div>";
            echo "<p>Customer ID: $userid</p>";
            echo "<form method='post' action='generate_invoice.php'>";
            echo "<input type='hidden' name='userid' value='$userid'>";
            echo "<button type='submit'>Generate Invoice</button>";
            echo "</form>";
            echo "</div>";
        }
    } else {
        echo "No customers found.";
    }
} else {
    echo "No customers found.";
}

// Close the database connection
$conn->close();
?>
