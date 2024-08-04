<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy Page</title>

    <?php include 'navigation.php'?>

    <style>
/* Container */
.container {
  max-width: 1440px;
  width: 100%;
  margin: 0 auto;
  padding: 0 2rem;
  box-sizing: border-box;
}

/* Products Section */
.products {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 2rem;
  margin-top: 2rem;
}

.product {
  background-color: #fff;
  border-radius: 5px;
  padding: 1rem;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  transition: all 0.3s ease-in-out;
}

.product:hover {
  transform: translateY(-5px);
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
}

.product img {
  max-width: 100%;
  height: auto;
  border-radius: 5px;
  margin-bottom: 1rem;
}

.product h3 {
  font-size: 1.2rem;
  margin-top: 1rem;
  font-weight: 600;
  color: #333;
}

.product p {
  margin-top: 0.5rem;
  color: #555;
}

.product button {
  margin-top: 1rem;
  padding: 0.5rem 1rem;
  background-color: #2c3e50;
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: all 0.3s ease-in-out;
}

.product button:hover {
  background-color: #34495e;
}
    </style>
</head>
<body>
    <div class="container">
        <div class="products">
            <?php
           
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "wp_project";

            $conn = mysqli_connect($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: ". $conn->connect_error);
            }

            
            $sql = "SELECT * FROM items";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='product'>";
                    echo "<img src='". $row['photo']. "' alt='". $row['item_name']. "'>";
                    echo "<h3>". $row['item_name']. "</h3>";
                    echo "<p>". $row['description']. "</p>";
                    echo "<p>Price: ₹". $row['price']. "</p>";
                    echo "<form action='add_to_cart.php' method='post'>";
                    echo "<input type='hidden' name='item_id' value='". $row['item_id']. "'>";
                    echo "<input type='hidden' name='item_name' value='". $row['item_name']. "'>";
                    echo "<input type='hidden' name='item_price' value='". $row['price']. "'>";
                    echo "<input type='number' name='quantity' min='1' value='1'>";
                    echo "<button type='submit' name='add_to_cart'>Add to Cart</button>";
                    echo "</form>";
                    echo "</div>";
                }
            } else {
                echo "No items available";
            }

            $conn->close();
           ?>
        </div>
    </div>

    <?php include 'footer.php'?>

    <script>
       
        document.querySelectorAll('input[name="quantity"]').forEach((input) => {
            input.addEventListener('input', () => {
                const itemPrice = parseFloat(input.parentElement.querySelector('input[name="item_price"]').value);
                const quantity = parseInt(input.value);
                const totalPrice = itemPrice * quantity;
                input.parentElement.querySelector('button').dataset.total = totalPrice.toFixed(2);
            });
        });
    </script>
</body>
</html>