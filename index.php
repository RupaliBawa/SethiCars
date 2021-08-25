<?php
  if(isset($_SESSION)) {
  // remove all session variables
  session_unset();

  // destroy the session
  session_destroy();
  }
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
</head>
<body>

  <div class="header" id="header">
    <h1>Sethi Car Rental</h1>
    <p>Rent cars for holidays, weddings or work trips at affordable price</p>
  </div>

  <div class="navbar">
    <a href="index.php" class="active">Home</a>
    <a href="login.php">Log In/Sign Up</a>
    <a href="AgencyRegisteration.php" style="float: right;">Agency? Register here</a>
  </div>


  <!-- MAIN (Center website) -->
  <div class="main">
    <h2>Book a car now!</h2>
    <hr>

    <?php
      $con = mysqli_connect('localhost', 'root', '','sethicars');
      $sql = "SELECT * FROM vehicles where booked=0";
      $result = mysqli_query($con, $sql);
      $count = 1; //this variable helps to create grid

      while($row = mysqli_fetch_array($result)) {
        $model = $row["model"];
        $number = $row["number"];
        $capacity = $row["capacity"];
        $rent = $row["rent"];
        $url = $row["image"];

        //<!-- Portfolio Gallery Grid -->"
        if($count==1) {
          echo "<div class='row'>";
        }
        echo  "<div class='column'><div class='content'>
              <img src='$url' style='width:260px; height:190px;'>
              <h3>$model</h3>
              <p>Number: $number<br>Seating Capacity: $capacity<br>Rent: $rent<br>
              <form method='POST' action='login.php'>
                <button type='submit' class='rentbutton' style='background-color: black; opacity: 95%; color: white;margin: 5% auto;padding:5%'>Rent</button></p>
              </form>
        </div></div>";

        $count += 1;
        if($count>4) {
          echo "</div>";
          $count = 1;
        }
      }

      if($count<=4) {
        echo "</div>";
      }
      mysqli_close($con);

    ?>

    <script type="text/javascript">
      document.getElementById("rentbutton").onclick = function () {
          location.href = "login.php";
      };
    </script>

  <div class="footer">
    <p>Sethi Cars © Copyright 2021</p>
  </div>

</body>
</html>
