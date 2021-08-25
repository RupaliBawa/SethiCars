<?php
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
    <link rel="stylesheet" href="css/viewbookedcars.css">
  </head>
<body>

  <div class="header" id="header">
    <h1>Sethi Car Rental</h1>
    <p>Rent cars for holidays, weddings or work trips at affordable price</p>
  </div>

  <div class="navbar">
    <a href="index.php">Home</a>
    <a href="addnewcar.php">Add New Car</a>
    <a href="viewbookedcars.php">View Booked Cars</a>
    <a href="approverequests.php"  class='active'>Approve Requests</a>
    <a href="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/sethicars/index.php';?>" style="float: right;">Log Out</a>
  </div>


  <?php
    echo "<div class='main'><table id='bookedcars'>
      <tr><th>Vehicle Model</th><th>No. of Days</th><th>Date</th><th>Approval</th></tr>";
    $con = mysqli_connect('localhost', 'root', '','sethicars');
    if(! $con) {
      echo "<tr><td>No data to display</td></tr>";
    } else {
      $owner = $_SESSION['Agency_Id'];
      //implementing join because we need data from two tables
      $sql = "SELECT vehicles.vehicleId, vehicles.model, requests.requestId, requests.days, requests.date from requests, vehicles where requests.vehicle_id=vehicles.vehicleId and vehicles.owner_id=$owner";

      if(mysqli_query($con, $sql)) {

        $result = mysqli_query($con, $sql);
        while($row = mysqli_fetch_array($result)) {
          $model = $row['model'];
          $days = $row['days'];
          $date = $row['date'];
          $vehicleId = $row['vehicleId'];

          echo "<tr><td>$model</td><td>$days</td><td>$date</td>
            <td><p><form method='POST' action='ApproveRequests.php'>
            <button type='submit' value='$vehicleId' class='approvebtn' name='approvebtn'
            style='background-color: black; opacity: 85%; color: white; width:60%;margin: 1% auto 1% auto;padding:4%'>Approve</button></p>
            </form></td><tr>";
        }
        mysqli_close($con);
      } else { //if no data to show
        echo "<tr><td>No Requests!</td><td></td><td></td><td></td></tr>";
      }
    }
    echo "</table></div>";


    //to approve the request
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Something posted
      $con = mysqli_connect('localhost', 'root', '','sethicars');
      //to clean the id
      $vid = $_POST['approvebtn'];
      //we need to get user(booker), days and date for the updation of vehicles' record
      $sql0 = "SELECT user_id, days, date from requests where vehicle_id=$vid";
      $result = mysqli_query($con,$sql0);
      $row = mysqli_fetch_array($result);

      if($row) {
        $booker= $row['user_id'];
        $start_date = $row['date'];
        $days = $row['days'];

        $date=date_create($start_date);
        $interval = date_interval_create_from_date_string($days.' days');
        $end_date = date_format( date_add($date, $interval), "d-m-Y");
        echo $end_date;

        $sql1 = "UPDATE vehicles set booked=1, booker_id=$booker, startDate=$start_date, endDate=$end_date where vehicleId='$vid' ";
        $sql2 = "DELETE FROM requests WHERE vehicle_id='$vid'";
        if (mysqli_query($con, $sql1) && mysqli_query($con, $sql2))    {
          header('Location: .');
        } else {  echo "<script> alert('Sorry! Failed to approve the request!')</script>";}
      } else {  echo "<script> alert('Sorry! Failed to approve the request')</script>";}
      mysqli_close($con);
    }
  ?>

    <div class="footer">
      <p>Sethi Cars © Copyright 2021</p>
    </div>

  </body>
</html>
