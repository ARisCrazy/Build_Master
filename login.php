<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./styles/login.css">
    <style>
        #login-main {
            width: 300px;
            margin: 50px auto;
            padding: 20px;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        #login-main h1 {
            text-align: center;
        }

        #login-main form {
            text-align: center;
        }

        #login-main label {
            display: block;
            margin-bottom: 10px;
        }

        #login-main input[type="text"],
        #login-main input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        #login-main input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }

        #login-main input[type="submit"]:hover {
            background-color: #0056b3;
        }

        #login-main a {
            text-decoration: none;
            color: #007bff;
        }

        #login-main a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <?php include 'navigation.php' ?>

    <div id="login-main">
        <h1>LOGIN</h1>
        <?php
        if(isset($_REQUEST['message'])) {
            if($_GET['message'] == '1') {
                echo '<h1>INVALID CREDENTIALS</h1>';
            }
        }
        ?>
        
        <form method="post" action="login_process.php">
            <label for="username">Email</label>
            <input type="text" name="username"><br><br>
            <label for="password">Password</label>
            <input type="password" name="password"><br><br>

            <input type="submit" name='submit' value="Login"><br><br>

            <a href="signup.php">New to BuildMaster? Register</a><br><br>
        </form>
    </div>

    <?php include 'footer.php' ?>
</body>
</html>
