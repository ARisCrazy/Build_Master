<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images/favicon-16x16.png">
    <title>Admin Login</title>
    <style>
        /* Container style */
        .container {
            width: 50%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc; /* Border style */
            border-radius: 10px; /* Rounded corners */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Shadow effect */
        }

        /* Form style */
        form {
            display: flex;
            flex-direction: column;
        }

        /* Form input style */
        input[type="text"],
        input[type="password"] {
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        /* Submit button style */
        button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>

</head>
<body>
    <?php include 'navigation.php' ?>
    <?php include 'connect_database.php' ?>

    <div class="container">
        <h1>Login to BuildMaster<br> as Admin</h1>
        <br><br>
        <form action="adminloginHandle.php" method="post">
            <label for="loginUsernameAdmin">Username</label>
            <input type="text" id="loginUsernameAdmin" name="loginUsernameAdmin" required>
            <label for="loginPassAdmin">Password</label>
            <input type="password" id="loginPassAdmin" name="loginPassAdmin" required>
            <button type="submit">Log in</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <?php include 'footer.php' ?>
</body>
</html>
