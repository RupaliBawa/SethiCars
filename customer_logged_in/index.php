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
      <a href="index.php" class="active">Home</a>
      <a href="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/sethicars/index.php';?>" style="float: right;">Log Out</a>
    </div>


    <!-- MAIN (Center website) -->
    <div class="main">
      <h2>Book a car now!</h2>
      <hr>

    <?php
        $con = mysqli_connect('localhost', 'root', '','sethicars');
        if($con) {
          $sql = "SELECT * FROM vehicles where booked=0"; //show the cars which arent booked
          $result = mysqli_query($con, $sql);
          $count = 1; //this variable helps to create grid

          if($result) {

            while($row = mysqli_fetch_array($result)) {
              $id = $row["vehicleId"];
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
                    <p>Number: $number<br>Seating Capacity: $capacity<br>Rent: $rent<br></p>
                    <p><form method='POST' action='index.php'>
                      <button type='submit' value='$id' class='rentbutton' name='rentbutton' style='background-color: black; opacity: 95%; color: white;margin: 5% auto;padding:5%'>Rent</button></p>
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
          }
        }
        mysqli_close($con);



        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          // Something posted
          if (isset($_POST['rentbutton'])) {
            // if user tries to click on rent button
            $_SESSION['Vehicle_Id'] = $_POST['rentbutton'];
            echo("<script>location.href = 'bookcar.php';</script>");
          }
        }
    ?>

    <div id="id01" class="modal">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      <form class="modal-content" action="index.php" method="post">
        <div class="container">
          <h1>Rent your car</h1>
          <p>Please fill in this form to create an account.</p>
          <hr>
          <label for="days"><b>Number of Days</b></label>
          <input type="number" placeholder="Enter the number of days you need to rent the car" name="days" required><br>

          <label for="date"><b>Start Date</b></label>
          <input type="date" placeholder="Enter the date when you need the car" name="date" required><br>

          <div class="clearfix">
            <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
            <button type="submit" class="signupbtn">Book Car</button>
          </div>
        </div>
      </form>
    </div>



    <div class="footer">
      <p>Sethi Cars © Copyright 2021</p>
    </div>

  </body>
</html>
