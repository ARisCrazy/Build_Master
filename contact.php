<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact us</title>
    <link rel="stylesheet" href="styles/contact_us.css" />
    <link rel="icon" type="image/png" href="images/favicon-16x16.png">
    <style>
      /* contact_us.css */

/* Style for the feedback form container */
.form {
  background-color: #ffffff;
  border-radius: 8px;
  padding: 20px;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
  max-width: 300px;
  margin: 20px auto 0;
}

/* Additional styling for form elements */
.form input[type="text"],
.form button {
  width: calc(100% - 20px);
  padding: 10px;
  margin-bottom: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

/* Styling for the submit button */
.form button {
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s;
}

.form button:hover {
  background-color: #0056b3;
}


    </style>
  </head>
  <body>
    <!-- header -->
    <?php include 'navigation.php' ;
      
    ?>

    <!-- main content -->
    <div class="flex-container">
      <div class="contact">
        <h2 style='color:white;margin-bottom:30px;'>Contact Us</h2>
        <p>
        <b>Address: </b><br>
        S.No. 41/12/13 A Part, Konark Virtue, Mundhawa, Pune, Maharashtra, 411036,
        India</p>
        <br>
        <p>
          <b>Email: </b><a href="#email">info@buildmaster.in</a>
        </p>
        <br />
        <p> 
          <b>Office Timings:</b> From 9AM in morning to around 5:30 in evening, MON-SAT.<br>
          SUNDAY CLOSED.
        </p>
        <br />
        <b>Contact Us</b>
        <br>
        <br>
        <p>
          <b>Phone Number:</b> +91 89430 78101 (From 9AM - 5:30PM) MON-SAT.
        </p>
        <br>
        <p>
          <b>Bank Details: </b><br />
          BANK NAME: AYUSHIII BANK<br />
          ACCOUNT NUMBER: 00690069006900<br />
          ACCOUNT HOLDER NAME: AYUSHI dhandhewali<br />
          ACCOUNT TYPE: CURRENT <br />
          IFSC CODE: SCAM0690786<br />
          BRANCH: MUNDHAWA
        </p>
      </div>
      <div class="form">
        <h2 style='color:white;margin-bottom:30px;'>Feedback</h2>
        <label for="first_name"><b>Name</b></label>
        <input
          type="text"
          placeholder="Enter First Name"
          name="first_name"
          id="first_name"
          required
        /><br />
        <label for="phone"><b>Phone Number</b></label>
        <input
          type="text"
          placeholder="Enter Phone Number"
          name="phone"
          id="phone"
          required
        /><br />
        <label for="email"><b>Email</b></label>
        <input
          type="text"
          placeholder="Enter Email"
          name="email"
          id="email"
          required
        /><br />
        <button type="button">Submit</button>
        <p style='margin: 30px 0;'>
          
        </p>
      </div>
    </div>

    <!-- main content end -->

    <!-- footer -->
    <?php include 'footer.php' ?>
    
    </div>
  </body>
</html>
