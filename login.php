<?php
  // Start the session
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Sethi Car Rental | Rent cars for holidays, weddings or work trips</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="logo.png" type="image/png" sizes="16x16">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/signup.css">
  </head>

  <body>
    <div class="header" id="header">
      <h1>Sethi Car Rental</h1>
      <p>Rent cars for holidays, weddings or work trips at affordable price</p>
    </div>

    <div class="navbar">
      <a href="index.php">Home</a>
      <a href="login.php" class="active">Log In/Sign Up</a>
      <a href="agencyregisteration.php" style="float: right;">Agency? Register here</a>
    </div>

    <div class="login">
      <form action="login.php" method="post">
        <label for="uname"><b>Username</b></label>
        <input type="text" placeholder="Enter Username/Agency username" name="uname" required><br>

        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="psw" required><br>

        <button type="submit" name="login">Login</button><br>
        <p>New User? <a href="#" onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Register here</a>. New Agency? <a href="agencyregisteration.php">Register here</a>.</p>
      </form>
    </div>

    <div id="id01" class="modal">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      <form class="modal-content" action="login.php" method="post">
        <div class="container">
          <h1>Sign Up</h1>
          <p>Please fill in this form to create an account.</p>
          <hr>
          <label for="name"><b>Name</b></label>
          <input type="text" placeholder="Enter your name" name="name" required><br>

          <label for="username"><b>Username</b></label>
          <input type="text" placeholder="Enter username" name="username" required><br>

          <label for="email"><b>Email</b></label>
          <input type="text" placeholder="Enter Email" name="email" required><br>

          <label for="psw"><b>Password</b></label>
          <input type="password" placeholder="Enter Password" name="psw" required><br>

          <label for="psw-repeat"><b>Repeat Password</b></label>
          <input type="password" placeholder="Repeat Password" name="psw-repeat" required><br>

          <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p><br>

          <div class="clearfix">
            <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
            <button type="submit" class="signupbtn">Sign Up</button>
          </div>
        </div>
      </form>
    </div>

    <div class="footer">
      <p>Sethi Cars © Copyright 2021</p>
    </div>

    <script>
      // Get the modal
      var modal = document.getElementById('id01');

      // When the user clicks anywhere outside of the modal, close it
      window.onclick = function(event) {
        if (event.target == modal) {
          modal.style.display = "none";
        }
      }
    </script>

    <?php
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Something posted
        $con = mysqli_connect('localhost', 'root', '','sethicars');

        if (isset($_POST['login'])) {
            // if user tries to login
            $username = $_POST['uname'];
            $password = $_POST['psw'];

            $sql = "SELECT userid, name, customer FROM users WHERE username = '$username' and password = '$password'";
            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $count = mysqli_num_rows($result);

            if($count == 1) {
              $name = $row["name"];
              $isCustomer = $row["customer"];  //boolean
              $userid = $row["userid"];

              if($isCustomer) {
                $_SESSION['Customer_Id'] = $userid;
                mysqli_close($con);
                header("Location: customer_logged_in/index.php");
                exit();
              } else {
                $_SESSION['Agency_Id'] = $userid;
                mysqli_close($con);
                header("Location: agency_logged_in/index.php");
                exit();
              }
            }
            else {
              //echo "<script> alert('Sorry! Failed to login')</script>";
            }
        } else {
            // user trying to sign up
            if( isset($_POST['name']) && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['psw'])) {
              $name = $_POST['name'];
              $username = $_POST['username'];
              $email = $_POST['email'];
              $password = $_POST['psw'];
              $isCustomer = True;  //specifying that user is registering is infact a is a customer
              //insert command
              $sql = " INSERT INTO users (name, username, email, password, customer) VALUES ('$name','$username','$email', '$password', '$isCustomer') ";

              if(mysqli_query($con, $sql))
              {
      	         //echo "<script> alert('Signed up successfully! Proceed to login');</script>";
              } else {
                //echo "<script> alert('Sorry! Failed to register you')</script>";
              }
              mysqli_close($con);
            }
        }
    }
     ?>

   </body>
</html>
