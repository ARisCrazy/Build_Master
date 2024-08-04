<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>

    <?php
    // Start the session
    session_start();

    // Function to check if the user is logged in
    function is_user_logged_in() {
        return isset($_SESSION['customer']);
    }

    // Check if the user is logged in
    if (!is_user_logged_in()) {
        // Redirect the user to the login page if they are not logged in
        header("Location: login.php");
        exit;
    }
    
    ?>

    <?php include 'navigation.php' ?>

    <style>
        /*...*/
    </style>
</head>
<body>
    <div class="container">
        <h1>Cart</h1>
        <table>
            <thead>
                <tr>
                    <th>Item Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Database connection
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "wp_project";

                $conn = mysqli_connect($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: ". $conn->connect_error);
                }
                $itemId = $_POST['item_id'];
                $itemName = $_POST['item_name'];
                $itemPrice = $_POST['item_price'];
                $quantity = $_POST['quantity'];
                
                // Calculate the total price
                $total = $itemPrice * $quantity;
                
                // Insert the item into the cart_items table
                $sql = "INSERT INTO cart_items (item_name, item_price, quantity, total) VALUES (?,?,?,?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssdi", $itemName, $itemPrice, $quantity, $total);
                $stmt->execute();
                // Fetch cart items from the database
                $sql = "SELECT * FROM cart_items";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['item_name'] . "</td>";
                        echo "<td>₹" . $row['item_price'] . "</td>";
                        echo "<td>" . $row['quantity'] . "</td>";
                        echo "<td>₹" . $row['total'] . "</td>";
                        echo "<td><a href='remove_from_cart.php?id=" . $row['id'] . "'>Remove</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No items in cart</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <?php include 'footer.php' ?>
</body>
</html>