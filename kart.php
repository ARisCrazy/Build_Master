<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <?php include 'navigation.php' ?>
    <style>
        
    </style>
</head>
<body>
    <div class="container">
        <h1>Cart</h1>
        <br>
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
                        echo "<tr><td colspan='5'>
            <form action='payment.php' method='post'>
                <button type='submit' name='checkout'>Buy</button>
            </form>
          </td></tr>";
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
