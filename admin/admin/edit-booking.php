<?php
require("./include/config.php");
session_start();

// Initialize variables
$msg = '';
$errormsg = '';
if (isset($_GET['bookingid'])) {
  $bookingid = $_GET['bookingid'];

  // Fetch existing image details based on the provided image ID
  $query = "SELECT * FROM `booking` WHERE `id`='$bookingid'";
  $select = mysqli_query($conn, $query);

  if ($select) {
    $row = mysqli_fetch_array($select);
  } else {
    $errormsg = "Error fetching image details";
  }
}

// Replace 'busid' with the actual parameter name

if (isset($_POST['submit'])) {
  $busnumber = $_POST['busNumber'];
  $seatNumber = $_POST['seatNumber'];
  $passengerName = $_POST['passengerName'];
  $passengerEmail = $_POST['passengerEmail'];
  $passengerPhone = $_POST['passengerPhone'];
  $cvvNumber = $_POST['cvvNumber'];
  $cardNumber = $_POST['cardNumber'];
  $expiryDate = $_POST['expiryDate'];
  $totalAmount = $_POST['totalAmount'];

  $sql = "UPDATE `booking` SET `bus_number`='$busnumber',`seat_number`=' $seatNumber ',`passenger_name`='$passengerName ',`email`=' $passengerEmail',`phone`='$passengerPhone',`cvv_number`='  $cvvNumber',`card_number`='$cardNumber',`expiry_date`=' $expiryDate',`total_amount`='$totalAmount' WHERE  id='$bookingid'";

  $result = mysqli_query($conn, $sql);

  if ($result) {
    $msg = "Booking details updated successfully";
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
          <h2 align="center"> Add Passengers</h2>
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
                  <label class="control-label">Bus Number</label>
                  <input class="form-control" name="busNumber" type="text" placeholder="Enter Bus Number" value="<?php echo htmlspecialchars($row['bus_number']); ?>">
                </div>
                <div class=" form-group col-md-12">
                  <label class="control-label">Seat Number</label>
                  <input class="form-control" name="seatNumber" type="text" placeholder="Enter Seat Number" value="<?php echo htmlspecialchars($row['seat_number']); ?>">
                </div>
                <div class=" form-group col-md-12">
                  <label class="control-label">Passenger Name</label>
                  <input class="form-control" name="passengerName" type="text" placeholder="Enter Passenger Name" value="<?php echo htmlspecialchars($row['passenger_name']); ?>">
                </div>
                <div class=" form-group col-md-12">
                  <label class="control-label">Passenger Email</label>
                  <input class="form-control" name="passengerEmail" type="email" placeholder="Enter Passenger Email" value="<?php echo htmlspecialchars($row['email']); ?>">
                </div>
                <div class=" form-group col-md-12">
                  <label class="control-label">Passenger Phone</label>
                  <input class="form-control" name="passengerPhone" type="text" placeholder="Enter Passenger Phone" value="<?php echo htmlspecialchars($row['phone']); ?>">
                </div>
                <div class=" form-group col-md-12">
                  <label class="control-label">CVV Number</label>
                  <input class="form-control" name="cvvNumber" type="text" placeholder="Enter CVV Number" value="<?php echo htmlspecialchars($row['cvv_number']); ?>">
                </div>
                <div class=" form-group col-md-12">
                  <label class="control-label">Card Number</label>
                  <input class="form-control" name="cardNumber" type="text" placeholder="Enter Card Number" value="<?php echo htmlspecialchars($row['card_number']); ?>">
                </div>
                <div class=" form-group col-md-12">
                  <label class="control-label">Expiry Date</label>
                  <input class="form-control" name="expiryDate" type="date" placeholder="Enter Expiry Date" value="<?php echo htmlspecialchars($row['expiry_date']); ?>">
                </div>
                <div class=" form-group col-md-12">
                  <label class="control-label">Total Amount</label>
                  <input class="form-control" name="totalAmount" type="text" placeholder="Enter Total Amount" value="<?php echo htmlspecialchars($row['total_amount']); ?>">
                </div>
                <div class=" form-group col-md-4 align-self-end">
                  <input type="submit" name="submit" class="btn btn-primary" value="Submit">
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
  <script type="text/javascript" src="../js/plugins/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="../js/plugins/dataTables.bootstrap.min.js"></script>
  <script type="text/javascript">
    $('#sampleTable').DataTable();
  </script>

</body>

</html>