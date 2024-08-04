<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <?php include 'navigation.php' ?>
    <style>
        /* Your CSS styles here */
    </style>
</head>
<body>
    <div class="container">
        <h1>Payment</h1>
        <p>Please enter your payment details to complete the purchase.</p>
        <form action="process_payment.php" method="post">
            <label for="card_number">Card Number:</label>
            <input type="text" id="card_number" name="card_number" required>
            <label for="expiry_date">Expiry Date:</label>
            <input type="text" id="expiry_date" name="expiry_date" placeholder="MM/YY" required>
            <label for="cvv">CVV:</label>
            <input type="text" id="cvv" name="cvv" required>
            <button type="submit" name="pay">Pay Now</button>
        </form>
    </div>
    <?php include 'footer.php' ?>
</body>
</html>
