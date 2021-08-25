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
  <a href="viewbookedcars.php" class='active'>View Booked Cars</a>
  <a href="approverequests.php">Approve Requests</a>
  <a href="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/sethicars/index.php';?>" style="float: right;">Log Out</a>
</div>

<?php
  echo "<div class='main'><table id='bookedcars'>
    <tr><th>Vehicle Model</th><th>Booked By</th></tr>";
  $con = mysqli_connect('localhost', 'root', '','sethicars');
  if(! $con) {
    echo "<tr><td>No data to display</td></tr>";
  } else {
    $owner = $_SESSION["Agency_Id"];
    //implementing join because we need data from two tables
    $sql = "SELECT vehicles.model, users.name FROM vehicles INNER JOIN users on vehicles.booker_id=users.userId where owner_id=$owner";
    $result = mysqli_query($con, $sql);

    if(mysqli_num_rows($result)<1) {
      echo "<tr><td>No bookings!</td><td></td></tr>";
    } else {
      while($row = mysqli_fetch_array($result)) {
        $model = $row['model'];
        $booker = $row['name'];

        echo "<tr><td>$model</td><td>$booker</td></tr>";
      }
      mysqli_close($con);
    }
  }
  echo "</table></div>";
?>

<div class="footer">
  <p>Sethi Cars © Copyright 2021</p>
</div>

</body>
</html>
