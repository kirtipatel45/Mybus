<?php
require("./include/config.php");
$sql = "SELECT * FROM bus_details";
$result = mysqli_query($conn, $sql);

$busDetails = array();
if ($result) {
  while ($row = mysqli_fetch_assoc($result)) {
    $busDetails[] = $row;
  }
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="description" content="Vali is a responsive">

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
      <div class="col-md-12">
        <div class="tile">
          <div class="tile-body">
            <h2 align="center"> Manage Bus</h2>
            <hr />
            <table class="table table-hover table-bordered" id="sampleTable">
              <thead>
                <tr>
                  <th>Sr.No</th>
                  <th>Bus Name</th>
                  <th>Bus Number</th>
                  <th>From Location</th>
                  <th>To Location</th>
                  <th>Arrival Time</th>
                  <th>Price</th>
                  <th>Seat</th>
                  <th>Bus Type</th>
                  <th>Action</th>
                </tr>
              </thead>

              <tbody>
                <?php
                // Loop through each bus detail and display it in a table row
                foreach ($busDetails as $index => $bus) {
                  echo '<tr>';
                  echo '<td>' . ($index + 1) . '</td>';
                  echo '<td>' . $bus['bus_name'] . '</td>';
                  echo '<td>' . $bus['bus_number'] . '</td>';
                  echo '<td>' . $bus['from_location'] . '</td>';
                  echo '<td>' . $bus['to_location'] . '</td>';
                  echo '<td>' . $bus['arrival_time'] . '</td>';
                  echo '<td>' . $bus['seat_price'] . '</td>';
                  echo '<td>' . $bus['total_seats'] . '</td>';
                  echo '<td>' . $bus['bus_type'] . '</td>';
                  echo '<td><a href="edit-bus.php?busid=' . $bus['id'] . '"><span class="btn btn-success">Edit</span> | <a href="delete-bus.php?busid=' . $bus['id'] . '"><span class="btn btn-danger">Delete</span></td>';
                  echo '</tr>';
                }
                ?>
              </tbody>
            </table>
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
  <!-- The javascript plugin to display page loading on top-->
  <script src="js/plugins/pace.min.js"></script>
  <!-- Page specific javascripts-->
  <!-- Data table plugin-->
  <script type="text/javascript" src="../js/plugins/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="../js/plugins/dataTables.bootstrap.min.js"></script>
  <script type="text/javascript">
    $('#sampleTable').DataTable();
  </script>

</body>

</html>