<?php
require("./includes/db.php");

session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(!isset($_SESSION["user_login"]) || $_SESSION["user_login"] !== true)
{
    header("location: login.php"); //LOGIN
    exit;
}
//work use for tomorrow

/*

if (isset($_POST['submit'])) {
  $inputValues = $_POST['input'];

  // Display the values
  echo "Input values stored in the array:<br>";
  $busnumber = $_POST['busNumber'];
  $seatNumber = $_POST['seatNumber'];
  $passengerName = $_POST['passengerName'];
  $passengerEmail = $_POST['passengerEmail'];
  $passengerPhone = $_POST['passengerPhone'];
  $cvvNumber = $_POST['cvvNumber'];
  $cardNumber = $_POST['cardNumber'];
  $expiryDate = $_POST['expiryDate'];
  $totalAmount = $_POST['totalAmount'];
 
  if (empty($seatNumber) || empty($passengerName) || empty($passengerEmail) || empty($passengerPhone) || empty($cvvNumber) || empty($cardNumber) || empty($expiryDate) || empty($totalAmount)) {
    $errormsg = 'All fields are required';
  } else {

    $sql = "INSERT INTO `booking`(`bus_number`, `seat_number`, `passenger_name`, `email`, `phone`, `cvv_number`, `card_number`, `expiry_date`, `total_amount`) VALUES ('$busnumber','$seatNumber',' $passengerName','$passengerEmail',' $passengerPhone','$cvvNumber ','$cardNumber','$expiryDate',' $totalAmount')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
      $msg = 'Bus details added successfully';
    } else {
      $errormsg = 'Error adding bus details';
    }
  }
} */
?>

<?php
if (isset($_POST['submit'])) {

    $busnumber = $_POST['busNumber'];
    $seatNumbers = $_POST['seatNumber'];
    $passengerNames = $_POST['passengerName'];
    $passengerEmails = $_POST['passengerEmail'];
    $passengerPhones = $_POST['passengerPhone'];
    $cvvNumber = $_POST['cvvNumber'];
    $cardNumber = $_POST['cardNumber'];
    $expiryDate = $_POST['expiryDate'];
    $totalAmount = $_POST['totalAmount'];


    if (empty($seatNumbers) || empty($passengerNames) || empty($passengerEmails) || empty($passengerPhones) || empty($cvvNumber) || empty($cardNumber) || empty($expiryDate) || empty($totalAmount)) {
        $errormsg = 'All fields are required';
    } else {

        $stmt = $conn->prepare("INSERT INTO `booking`(`bus_number`, `seat_number`, `passenger_name`, `email`, `phone`, `cvv_number`, `card_number`, `expiry_date`, `total_amount`) VALUES(?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("sssssssss", $busnumber, $seatNumber, $passengerName, $passengerEmail, $passengerPhone, $cvvNumber, $cardNumber, $expiryDate, $totalAmount);

        // Insert each input value into the database
        for ($i = 0; $i < count($seatNumbers); $i++) {
            // Set parameter values and execute the statement
            $seatNumber = $seatNumbers[$i];
            $passengerName = $passengerNames[$i];
            $passengerEmail = $passengerEmails[$i];
            $passengerPhone = $passengerPhones[$i];
            $stmt->execute();
            // Check for errors
            if ($stmt->error) {
                echo "Error: " . $stmt->error;
            }
        }

        $stmt->close();
        $conn->close();

        // Display success message
        echo "<script>
        alert('booking sucssful')
        window.location='index.php'</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Passenger Booking Form</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 600px;
      margin: 50px auto;
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    .form-group {
      margin-bottom: 20px;
    }

    label {
      font-weight: bold;
      display: block;
    }

    input[type="text"],
    input[type="email"],
    input[type="tel"] {
      width: 100%;
      padding: 10px;
      border-radius: 4px;
      border: 1px solid #ccc;
      box-sizing: border-box;
      margin-top: 5px;
    }

    input[type="submit"] {
      width: 100%;
      padding: 10px;
      border-radius: 4px;
      border: none;
      background-color: #4caf50;
      color: white;
      cursor: pointer;
      font-size: 16px;
    }
  </style>
</head>

<body>

</body>

</html>




<!-- search.php -->
<?php
require("./includes/db.php");

$msg = '';
$errormsg = '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>My Bus</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta content="" name="keywords" />
  <meta content="" name="description" />

  <!-- Google Web Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600&family=Roboto&display=swap" rel="stylesheet" />

  <!-- Icon Font Stylesheet -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />

  <!-- Libraries Stylesheet -->
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet" />
  <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet" />

  <!-- Customized Bootstrap Stylesheet -->
  <link href="css/bootstrap.min.css" rel="stylesheet" />

  <!-- Template Stylesheet -->
  <link href="css/style.css" rel="stylesheet" />
</head>

<body>
  <!-- Spinner Start -->
  <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem" role="status">
      <span class="sr-only">Loading...</span>
    </div>
  </div>
  <!-- Spinner End -->

  <!-- Navbar & Hero Start -->
  <?php include("./includes/nav.php") ?>

  <!-- Carousel Start -->
  <?php include("./includes/slider.php") ?>

  <!-- Carousel End -->
  </div>

  <div class="row">
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") { ?>
      <div class="col-md-12">
        <div class="container">
          <h2>Passenger Booking Form</h2>
          <form action="" method="POST">

            <?php if (!empty($_POST['seats'])) {
              $selectedSeats = $_POST['seats'];
              $busnumber = $_POST['busnumber'];
           



              echo "<h2>Booked Seats:</h2>";
              echo "<ul>";
              foreach ($selectedSeats as $seat) {
            ?>

                <div class="form-group col-md-12">
                  <label class="control-label">Seat Number</label>
                  <input class="form-control" name="seatNumber[]" type="text" placeholder="Enter Seat Number" value="<?php echo $seat; ?>" required>
                </div>
                <div class="form-group col-md-12">
                  <label class="control-label">Bus Number</label>
                  <input class="form-control" name="busNumber" type="text" placeholder="Enter bus Number" value="<?php echo $busnumber; ?>" required>

                </div>
                <div class="form-group col-md-12">
                  <label class="control-label">Passenger Name</label>
                  <input class="form-control" name="passengerName[]" type="text" placeholder="Enter Passenger Name" pattern="[A-Za-z]+" title="letters only" required >
                </div>
                <div class="form-group col-md-12">
                  <label class="control-label">Passenger Email</label>
                  <input class="form-control" name="passengerEmail[]" type="email" placeholder="Enter Passenger Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+.[a-z]{2,4}$" title="xyz@something.com" required>
                </div>
                <div class="form-group col-md-12">
                  <label class="control-label">Passenger Phone</label>
                  <input class="form-control" name="passengerPhone[]" type="text" placeholder="Enter Passenger Phone" pattern="[0-9]{10}" title="10 numeric characters only" required>
                </div>
          <?php

              }
            }
          }
          ?>
          <h1 class="text-center">Pay Details</h1>
          <div class="form-group col-md-12">
            <label class="control-label">CVV Number</label>
            <input class="form-control" name="cvvNumber" type="text" placeholder="Enter CVV Number" pattern="[0-9]{3,4}" title="Please enter a valid CVV (3 or 4 digits)" required>
          </div>
          <div class="form-group col-md-12">
            <label class="control-label">Card Number</label>
            <input class="form-control" name="cardNumber" type="text" placeholder="Enter Card Number" pattern="[0-9]{12,19}" title="Please enter a valid debit card number (12-19 digits)" required>
          </div>
          <div class="form-group col-md-12">
            <label class="control-label">Expiry Date</label>
            <input class="form-control" name="expiryDate" type="date" placeholder="Enter Expiry Date" pattern="(0[1-9]|1[0-2])\/[0-9]{4}" title="Please enter a valid expiry date in the format MM/YYYY" required>
          </div>
          <div class="form-group col-md-12">
            <label class="control-label">Total Amount</label>
            <input class="form-control" name="totalAmount" type="text" placeholder="Enter Total Amount">
          </div>

          <input type="submit" name="submit" value="Book Now">
          </form>
        </div>
        <!-- Assuming the $result variable contains the fetched data -->

        <!-- Navbar & Hero End -->

        <!-- About Start -->
      </div>
      <!-- Tour Booking End -->

      <!-- Footer Start -->
      <!-- Footer End -->

      <!-- Copyright Start -->
  </div>
  <!-- Copyright End -->
  
  </div>
  <!-- Copyright End -->

  <!-- Back to Top -->

  <!-- Back to Top -->
  <a href="#" class="btn btn-primary btn-primary-outline-0 btn-md-square back-to-top"><i class="fa fa-arrow-up"></i></a>

  <!-- JavaScript Libraries -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="lib/easing/easing.min.js"></script>
  <script src="lib/waypoints/waypoints.min.js"></script>
  <script src="lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="lib/lightbox/js/lightbox.min.js"></script>

  <!-- Template Javascript -->
  <script src="js/main.js">

  </script>
</body>

</html>