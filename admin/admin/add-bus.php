<?php
require("./include/config.php");
session_start();

// Initialize variables
$msg = '';
$errormsg = '';

// Check if the form is submitted
if (isset($_POST['submit'])) {
  // Get form data
  $busName = $_POST['busName'];
  $busNumber = $_POST['busNumber'];
  $fromLocation = $_POST['fromLocation'];
  $toLocation = $_POST['toLocation'];
  $arrivalTime = $_POST['arrivalTime'];
  $seatPrice = $_POST['seatPrice'];
  $busType = $_POST['bustype'];
  $totalSeats = $_POST['totalSeats'];
  if (empty($busName) || empty($busNumber) || empty($fromLocation) || empty($toLocation) || empty($arrivalTime) || empty($seatPrice) || empty($busType) || empty($totalSeats)) {
    $errormsg = 'All fields are required';
  } else {
    // Insert data into the database
    $sql = "INSERT INTO bus_details (bus_name, bus_number, from_location, to_location, arrival_time, seat_price, bus_type, total_seats) 
                VALUES ('$busName', '$busNumber', '$fromLocation', '$toLocation', '$arrivalTime', '$seatPrice', '$busType', '$totalSeats')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
      $msg = 'Bus details added successfully';
    } else {
      $errormsg = 'Error adding bus details';
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="description" content="Vali is a">
  <title>Admin</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Main CSS-->
  <link rel="stylesheet" type="text/css" href="../css/main.css">
  <!-- Font-icon css-->
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body class="app sidebar-mini rtl">
  <!-- Navbar-->
  <?php include 'include/header.php'; ?>
  <!-- Sidebar menu-->
  <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
  <?php include 'include/sidebar.php'; ?>
  <main class="app-content">

    <div class="row">

      <div class="col-md-8" style="margin-left: 20rem;">

        <div class="tile">
          <h2 align="center"> Add Bus</h2>
          <hr />
          <!---Success Message--->
          <?php if ($msg) { ?>
            <div class="alert alert-success" role="alert">
              <strong>Well done!</strong> <?php echo htmlentities($msg); ?>
            </div>
          <?php } ?>

          <!---Error Message--->
          <?php if ($errormsg) { ?>
            <div class="alert alert-danger" role="alert">
              <strong>Oh snap!</strong> <?php echo htmlentities($errormsg); ?>
            </div>
          <?php } ?>


          <div class="tile-body">
            <form method="post">
              <div class="form-group col-md-12">
                <label class="control-label">Bus Name</label>
                <input class="form-control" name="busName" id="busName" type="text" placeholder="Enter Bus Name">
              </div>
              <div class="form-group col-md-12">
                <label class="control-label">Bus Number</label>
                <input class="form-control" name="busNumber" id="busNumber" type="text" placeholder="Enter Bus Number">
              </div>
              <div class="form-group col-md-12">
                <label class="control-label">From Location</label>
                <input class="form-control" name="fromLocation" id="fromLocation" type="text" placeholder="Enter From Location">
              </div>
              <div class="form-group col-md-12">
                <label class="control-label">To Location</label>
                <input class="form-control" name="toLocation" id="toLocation" type="text" placeholder="Enter To Location">
              </div>
              <div class="form-group col-md-12">
                <label class="control-label">Arrival Time</label>
                <input class="form-control" name="arrivalTime" id="arrivalTime" type="time" placeholder="Enter Arrival Time">
              </div>
              <div class="form-group col-md-12">
                <label class="control-label">Seat Price</label>
                <input class="form-control" name="seatPrice" id="seatPrice" type="text" placeholder="Enter Seat Price">
              </div>
              <div class="form-group col-md-12">
                <label class="control-label">Bus Type</label>
                <select class="form-control" name="bustype" id="bustype">
                  <option value="AC">AC</option>
                  <option value="Non-AC">Non-AC</option>
                </select>
              </div>

              <div class="form-group col-md-12">
                <label class="control-label">Seat Select</label>
                <select class="form-control" name="totalSeats" id="totalSeats">
                  <option value="32">32</option>
                  <option value="52">52</option>
                </select>
              </div>

              <div class="form-group col-md-4 align-self-end">
                <input type="submit" name="submit" id="submit" class="btn btn-primary" value="Submit">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

  </main>
  <!-- Essential javascripts for application to work-->
  <script src="../js/jquery-3.2.1.min.js"></script>
  <script src="../js/popper.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/main.js"></script>
  <script src="../js/plugins/pace.min.js"></script>
  <script type="text/javascript" src="j../s/plugins/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="../js/plugins/dataTables.bootstrap.min.js"></script>
  <script type="text/javascript">
    $('#sampleTable').DataTable();
  </script>

</body>

</html>