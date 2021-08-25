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
    <a href="login.php">Log In/Sign Up</a>
    <a href="agencyregisteration.php" class="active" style="float: right;">Agency? Register here</a>
  </div>

  <div class="register">
    <form class="modal-content" action="agencyregisteration.php" method="post">
      <div class="container">
        <h1>Register your agency with us</h1>
        <p>If you have already created your account, <a href="login.php">click here</a> to login</p>
        <hr>
        <label for="name"><b>Agency Name</b></label>
        <input type="text" placeholder="Enter your agencies's name" name="name" required><br>

        <label for="username"><b>Username</b></label>
        <input type="text" placeholder="Enter username" name="username" required><br>

        <label for="email"><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="email" required><br>

        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="psw" required><br>

        <label for="psw-repeat"><b>Repeat Password</b></label>
        <input type="password" placeholder="Repeat Password" name="psw-repeat" required><br>

        <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p><br>

        <button type="submit" class="signupbtn">Sign Up</button>
      </div>
    </form>
  </div>

  <div class="footer">
    <p>Sethi Cars © Copyright 2021</p>
  </div>

  <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Something posted 
      $con = mysqli_connect('localhost', 'root', '','sethicars');

      if($con) {
        // user trying to sign up
        $name = $_POST['name'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['psw'];
        $isCustomer = False;  //specifying that user is registering is infact a is a customer
        //insert command
        $sql = " INSERT INTO users (name, username, email, password, customer) VALUES ('$name','$username','$email', '$password', '$isCustomer') ";

        if(mysqli_query($con, $sql))       {
          echo "<script> alert('Signed up successfully! Proceed to login');</script>";
          echo("<script>location.href = 'login.php';</script>"); //user will be redirected to login
        } else {
          echo "<script> alert('Sorry! Failed to login/register you')</script>";
        }
        mysqli_close($con);
      }
  }
   ?>

</body>
</html>
