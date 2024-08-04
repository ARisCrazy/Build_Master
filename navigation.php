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
            <a href="custom_rigs.php">CUSTOM RIG</a>
            <a href="prebuilt.php">Pre-Built</a>
            <a href="buy.php">COMPONENTS</a>
            <a href="tutorial.php">TUTORIAL</a>
            <a href="adminlogin.php">admin-login</a>
            <div class="dropdown">
              <button class="dropdown-toggle">More ▼</button>
              <ul class="dropdown-menu">
                <li><a href="prdcart.php">CART</a></li>
                <li><a href="about_us.php">ABOUT US</a></li>
                <li><a href="contact.php">CONTACT</a></li>
                <li><a href="logout.php">Logout</a></li>
                
                </ul>
              </div>
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