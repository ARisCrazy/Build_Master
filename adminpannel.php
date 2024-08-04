<?php if (session_status() === PHP_SESSION_NONE) {
    session_start();
} ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        /* .navbar {
            background-color: #333;
            color: #fff;
            padding: 15px;
        }

        .navbar a {
            color: #fff;
            text-decoration: none;
            margin-right: 20px;
        } */

        .container {
            max-width: 900px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .box {
            width: calc(33.33% - 20px);
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 5px;
            margin-bottom: 20px;
            box-sizing: border-box;
        }

        .box img {
            display: block;
            margin: 0 auto 10px;
            max-width: 100%;
            height: auto;
        }

        .box button {
            display: block;
            margin: 0 auto;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .box button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <!-- <div class="navbar">
        <a href="#">Profile</a>
        <a href="#">Logout</a>
    </div> -->
    <?php include 'adminNav.php'?>

    <div class="container">
        <div class="box">
            <img src="profile.jpg" alt="Image 1">
            <a href="adminUserlist.php"><button>User List</button><br>
            <a href="adminUserlist.php"><button>User List</button>
        </div>
        <div class="box">
            <img src="profile.jpg" alt="Image 2">
            <a href="admincooler.php"><button>Cooler</button><br>
            <a href="adminCoolerList.php"><button>Cooler List</button>
        </div>
        <div class="box">
            <img src="profile.jpg" alt="Image 3">
            <a href="admingpu.php"><button>GPU</button><br>
            <a href="admingpuList.php"><button>GPU List</button>
        </div>
        <div class="box">
            <img src="profile.jpg" alt="Image 1">
            <a href="adminhdd.php"><button>HDD</button><br>
            <a href="adminhddList.php"><button>HDD List</button>
        </div>
        <div class="box">
            <img src="profile.jpg" alt="Image 2">
            <a href="adminMb.php"><button>Motherboard</button><br>
            <a href="adminMbList.php"><button>Motherboard List</button>
        </div>
        <div class="box">
            <img src="profile.jpg" alt="Image 3">
            <a href="adminpsu.php"><button>PSU</button><br>
            <a href="adminpsuList.php"><button>PSU List</button>
        </div>
        <div class="box">
            <img src="profile.jpg" alt="Image 3">
            <a href="admincpu.php"><button>CPU</button><br>
            <a href="admincpuList.php"><button>CPU List</button>
        </div>
        <div class="box">
            <img src="profile.jpg" alt="Image 3">
            <a href="adminram.php"><button>RAM</button><br>
            <a href="adminramList.php"><button>RAM List</button>
        </div>
        <div class="box">
            <img src="profile.jpg" alt="Image 3">
            <a href="adminssd.php"><button>SSD</button><br>
            <a href="adminssdList.php"><button>SSD List</button>
        </div>
        <div class="box">
            <img src="profile.jpg" alt="Image 3">
            <a href="admincabinet.php"><button>Cabinet</button><br>
            <a href="admincabinetList.php"><button>Cabinet List</button>
        </div>
        <div class="box">
            <img src="profile.jpg" alt="Image 3">
            <a href="adminitems.php"><button>Item</button><br>
            <a href="adminitemsList.php"><button>Item List</button>
        </div>
        <div class="box">
            <img src="profile.jpg" alt="Image 3">
            <a href="adminpre.php"><button>Pre-Built</button><br>
            <a href="adminpreList.php"><button>Pre-Built List</button>
        </div>
    </div>
</body>
<?php include 'footer.php'?>
</html>
