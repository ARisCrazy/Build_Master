<?php
session_start();

// Check if checkout button is clicked and form fields are submitted
if (isset($_POST['checkout']) && isset($_POST['address']) && isset($_POST['payment'])) {
    // Perform checkout process
    // For demonstration purposes, let's just display a message
    echo "<h2>Thank you for your purchase!</h2>";
    echo "<p>Your order has been successfully processed.</p>";
    echo "<p>Total amount charged: $" . calculateTotal() . "</p>";
    echo "<p>Shipping Address: " . $_POST['address'] . "</p>";
    echo "<p>Payment Method: " . $_POST['payment'] . "</p>";

    // Clear the cart after checkout
    unset($_SESSION['cart']);
}

// Function to calculate total price of items in cart
function calculateTotal() {
    $total = 0;
    foreach ($_SESSION['cart'] as $item) {
        $total += $item['prdprice'] * $item['quantity'];
    }
    return $total;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <?php include 'navigation.php'?>
    <style>
        
        /* CSS styles for checkout page */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        

        .container {
            width: 400px;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
            flex: 1;
            margin: 20px auto;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        p {
            margin-bottom: 10px;
            color: #555;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            display: block;
            margin: 0 auto;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

    </style>
</head>
<body>
    <div class="container">
        <?php
        // Check if the cart is empty
        if (empty($_SESSION['cart'])) {
            echo "<h2>Cart is empty</h2>";
            echo "<p>Please add items to your cart before proceeding to checkout.</p>";
        } else {
            ?>
            <form action="checkout.php" method="POST">
                <label for="address">Shipping Address:</label>
                <input type="text" id="address" name="address" required>

                <label for="payment">Payment Method:</label>
                <select id="payment" name="payment" required>
                    <option value="credit_card">Credit Card</option>
                    <option value="debit_card">Debit Card</option>
                    <option value="paypal">PayPal</option>
                    <option value="cash_on_delivery">Cash on Delivery</option>
                </select>

                <input type="submit" name="checkout" value="Checkout">
            </form>
            <?php
        }
        ?>
    </div>
<?php include 'footer.php'?>
</body>
</html>