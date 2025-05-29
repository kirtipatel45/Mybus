<?php
require("./include/config.php");
session_start();

// Initialize variables
$msg = '';
$errormsg = '';
if (isset($_GET['busid'])) {
  $busId = $_GET['busid'];

  // Fetch existing image details based on the provided image ID
  $query = "SELECT * FROM `bus_details` WHERE `id`='$busId'";
  $select = mysqli_query($conn, $query);

  if ($select) {
    $row = mysqli_fetch_array($select);
  } else {
    $errormsg = "Error fetching image details";
  }
}

// Replace 'busid' with the actual parameter name

if (isset($_POST['submit'])) {
  $busName = $_POST['busName'];
  $busNumber = $_POST['busNumber'];
  $fromLocation = $_POST['fromLocation'];
  $toLocation = $_POST['toLocation'];
  $arrivalTime = $_POST['arrivalTime'];
  $seatPrice = $_POST['seatPrice'];
  $busType = $_POST['bustype'];
  $totalSeats = $_POST['totalSeats'];

  $sql = "UPDATE bus_details SET 
            bus_name='$busName', 
            bus_number='$busNumber', 
            from_location='$fromLocation', 
            to_location='$toLocation', 
            arrival_time='$arrivalTime', 
            seat_price='$seatPrice', 
            bus_type='$busType', 
            total_seats='$totalSeats' 
            WHERE id='$busId'";

  $result = mysqli_query($conn, $sql);

  if ($result) {
    $msg = "Bus details updated successfully";
  } else {
    $errormsg = "Error updating bus details: " . mysqli_error($conn);
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
            <?php if ($row) { ?>
              <form method="post">
                <div class="form-group col-md-12">
                  <label class="control-label">Bus Name</label>
                  <input class="form-control" name="busName" id="busName" type="text" placeholder="Enter Bus Name" value="<?php echo htmlspecialchars($row['bus_name']); ?>">
                </div>
                <div class="form-group col-md-12">
                  <label class="control-label">Bus Number</label>
                  <input class="form-control" name="busNumber" id="busNumber" type="text" placeholder="Enter Bus Number" value="<?php echo htmlspecialchars($row['bus_number']); ?>">
                </div>
                <div class="form-group col-md-12">
                  <label class="control-label">From Location</label>
                  <input class="form-control" name="fromLocation" id="fromLocation" type="text" placeholder="Enter From Location" value="<?php echo htmlspecialchars($row['from_location']); ?>">
                </div>
                <div class="form-group col-md-12">
                  <label class="control-label">To Location</label>
                  <input class="form-control" name="toLocation" id="toLocation" type="text" placeholder="Enter To Location" value="<?php echo htmlspecialchars($row['to_location']); ?>">
                </div>
                <div class="form-group col-md-12">
                  <label class="control-label">Arrival Time</label>
                  <input class="form-control" name="arrivalTime" id="arrivalTime" type="time" placeholder="Enter Arrival Time" value="<?php echo htmlspecialchars($row['arrival_time']); ?>">
                </div>
                <div class="form-group col-md-12">
                  <label class="control-label">Seat Price</label>
                  <input class="form-control" name="seatPrice" id="seatPrice" type="text" placeholder="Enter Seat Price" value="<?php echo htmlspecialchars($row['seat_price']); ?>">
                </div>
                <div class="form-group col-md-12">
                  <label class="control-label">Bus Type</label>
                  <select class="form-control" name="bustype" id="bustype">
                    <option value="AC" <?php echo ($row['bus_type'] == 'AC') ? 'selected' : ''; ?>>AC</option>
                    <option value="Non-AC" <?php echo ($row['bus_type'] == 'Non-AC') ? 'selected' : ''; ?>>Non-AC</option>
                  </select>
                </div>

                <div class="form-group col-md-12">
                  <label class="control-label">Seat Select</label>
                  <select class="form-control" name="totalSeats" id="totalSeats">
                    <option value="32" <?php echo ($row['total_seats'] == 32) ? 'selected' : ''; ?>>32</option>
                    <option value="52" <?php echo ($row['total_seats'] == 52) ? 'selected' : ''; ?>>52</option>
                  </select>
                </div>

                <div class="form-group col-md-4 align-self-end">
                  <input type="submit" name="submit" id="submit" class="btn btn-primary" value="Submit">
                </div>
              </form>
            <?php } else { ?>
              <p>No image found with the provided ID.</p>
            <?php } ?>

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