<?php if (session_status() === PHP_SESSION_NONE) {
    session_start();
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        <?php include 'styles/navigation.css' ?>
        
    </style>

    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:ital,wght@0,300;0,500;1,300&display=swap" rel="stylesheet">
<link rel="icon" type="image/png" href="images/favicon-16x16.png">
</head>
<body>
    
    <header class="header">
          <div class="hamburger-menu" onclick="menu_open()">
            <img src="images/hamb-menu.png" alt="" style="width: 32px" />
          </div>
    
          <div class="logo">
            <a href="home.php"><img src="images/logiya.jpg" alt="" /></a>
          </div>
    
          <navigation class="links" id="navigation_links">
            <a href="adminpannel.php">Home</a>
            <a href="adminlogout.php">Logout</a>
            </navigation>
    
          <div class="kart">  
            <a class="active" href="myaccount.php" >
                <img src="images/user.png" alt="" style="width: 32px"/>
                
            </a>
            
            <a class="active" href="cart.php"
              ><img src="images/cart.png" alt="" style="width: 32px"/>
            </a>
          </div>
    </header>
    
    <script>
        <?php include 'script/navigation.js' ?>
    </script>
</body>
</html>