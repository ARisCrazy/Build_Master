<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
	<link rel="stylesheet" href="./styles/signup.css">
	<style>
		


#signup-main {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
    border-radius: 8px;
    background-color: #ffffff; 
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); 
}


form {
    margin-top: 20px;
}

label {
    display: block;
    margin-bottom: 5px;
}

input[type="text"],
input[type="password"] {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

input[type="submit"] {
    width: 100%;
    padding: 10px;
    border: none;
    border-radius: 5px;
    background-color: #007bff; 
    color: #fff;
    cursor: pointer;
    transition: background-color 0.3s;
}

input[type="submit"]:hover {
    background-color: #0056b3; 
}

a {
    color: #007bff; 
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

	</style>
</head>
<body>
    <?php include 'navigation.php' ?>
    <div id="signup-main">
		<h1>SIGNUP</h1>
		<?php
			if(isset($_SESSION['error_message']))
			{
				echo("Error description: " .$_SESSION['error_message'] );	
			}
			if(!empty($_SESSION['email_error']))
			{
				echo $_SESSION['email_error'];
			}
				
			if(!empty($_SESSION['password_error']))
			{
				echo "<br>".$_SESSION['password_error'];
			}		
			if(!empty($_SESSION['pass_length_error']))
			{
				echo "<br>".$_SESSION['pass_length_error'];
			}		
           
		?>
		<form method="post" action='signup_process.php'>
			

			<label for="user_name">Email</label>
			<input id="text" type="text" name="user_name"><br><br>
			<label for="password">Password</label>
			<input id="text" type="password" name="password"><br><br>

			<label for="confirm-password">Confirm Password*</label>
			<input id="text" type="password" name="confirm-password"><br><br>

			<input id="button" type="submit" name='submit' value="Register"><br><br>

			<!-- <a href="login.php">Click to Login</a><br><br> -->
		</form>
	</div>
    <?php include 'footer.php' ?>
</body>
</html>

