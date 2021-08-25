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
  <link rel="stylesheet" href="css/carsgrid.css">
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
    <a href="bookcar.php" class="active">Book Car</a>
    <a href="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/sethicars/index.php';?>" style="float: right;">Log Out</a>
  </div>

  <div class="main">
    <form class="modal-content" action="bookcar.php" method="post">
      <div class="container">
        <h1>Rent your car</h1>
        <p>Please fill in this form to create an account.</p>
        <hr>
        <label for="days"><b>Number of Days</b></label><br>
        <input type="number" placeholder="Enter the number of days you need to rent the car" name="days" required><br>

        <label for="date"><b>Start Date</b></label><br>
        <input type="date" placeholder="Enter the date when you need the car" name="date" required><br>

        <div class="clearfix">
          <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
          <button type="submit" name="BookCarButton" class="signupbtn">Book Car</button>
        </div>
      </div>
    </form>
  </div>

  <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Something posted
      if (isset($_POST['BookCarButton']) && isset($_POST['days']) && isset($_POST['date'])) {
        // if user tries to click on rent button
        $con = mysqli_connect('localhost', 'root', '','sethicars');
        if($con) {
          $days = $_POST['days'];
          $date = $_POST['date'];
          $v_id = $_SESSION['Vehicle_Id'];
          $u_id = $_SESSION['Customer_Id'];

          $sql = " INSERT INTO requests (days, date, vehicle_id, user_id) VALUES ('$days','$date','$v_id', '$u_id') ";
          $result = mysqli_query($con, $sql);

          if($result or $sql)
            {
               echo "<script> alert('Requested your booking successfully!');</script>";
               echo("<script>location.href = 'index.php';</script>");
            } else {
              echo "<script> alert('Sorry! Failed to request your car')</script>";
            }
            mysqli_close($con);
        }
      }
    }
  ?>

  <div class="footer">
    <p>Sethi Cars © Copyright 2021</p>
  </div>

</body>
</html>
