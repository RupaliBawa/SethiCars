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
  <link rel="stylesheet" href="css/signup.css">
</head>
<body>

  <div class="header" id="header">
    <h1>Sethi Car Rental</h1>
    <p>Rent cars for holidays, weddings or work trips at affordable price</p>
  </div>

  <div class="navbar">
    <a href="index.php">Home</a>
    <a href="addnewcar.php" class="active">Add New Car</a>
    <a href="viewbookedcars.php">View Booked Cars</a>
    <a href="approverequests.php">Approve Requests</a>
    <a href="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/sethicars/index.php';?>" style="float: right;">Log Out</a>
  </div>

  <div class="register">
    <form class="modal-content" action="addnewcar.php" method="post">
      <div class="container">
        <h2>Add new car</h2>
        <hr>
        <label for="VehicleModel"><b>Vehicle Model</b></label>
        <input type="text" placeholder="Enter your vehicle's model" name="VehicleModel" required><br>

        <label for="VehicleNumber"><b>Vehicle Number</b></label>
        <input type="text" placeholder="Enter your vehicle's number" name="VehicleNumber" required><br>

        <label for="capacity"><b>Seating Capacity</b></label>
        <input type="number" placeholder="Enter your vehicle's seating capacity" name="capacity" required><br>

        <label for="rent"><b>Rent per day</b></label>
        <input type="number" placeholder="Enter rent per day" name="rent" required><br>

        <label for="file"><b>Upload Image</b></label>
        <input type="text" placeholder="Enter the url of the image of your vehicle" name="image" required><br>

        <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p><br>

        <button type="submit" name="addnewcar" class="signupbtn">Submit</button>
      </div>
    </form>
  </div>

  <div class="footer">
  <p>Sethi Cars © Copyright 2021</p>
</div>

  <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Something posted
    $con = mysqli_connect('localhost', 'root', '','sethicars');

    // agency trying to add new car
    $model = $_POST['VehicleModel'];
    $number = $_POST['VehicleNumber'];
    $capacity = $_POST['capacity'];
    $rent = $_POST['rent'];
    $imageURL = $_POST['image'];
    $owner = $_SESSION['Agency_Id'];
    //insert command
    $sql = " INSERT INTO vehicles (model,	number,	capacity,	rent,	owner_id, image) VALUES ('$model','$number','$capacity', '$rent', '$owner','$imageURL') ";

    if(mysqli_query($con, $sql))
    {
       echo "<script> alert('Car added successfully');</script>";
    } else {
      echo "<script> alert('Sorry! Failed to login/register you')</script>";
    }
    mysqli_close($con);
}
  ?>

</body>
</html>
