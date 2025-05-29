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

$sql = "SELECT id, bus_number, seat_number, passenger_name, email, phone, cvv_number, card_number, expiry_date, total_amount FROM booking WHERE 1";


$result = $conn->query($sql);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Show Form</title>
    <style>

    </style>
</head>

<body>

</body>

</html>






<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Bus Booking</title>
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

    <div class="container-fluid bg-breadcrumb">
        <div class="container text-center py-5" style="max-width: 900px;">
            <h3 class="text-white display-3 mb-4">Booking Details</h1>

        </div>
    </div>


    <div class="container mt-4 viewbox">
        <form id="userForm" action="viewbooking.php" method="POST" class="row g-3 viewform">
            <div class="col-md-7 mx-auto shadow p-4 mb-5 bg-white rounded">
                <div class="mb-3">
                    <label for="mobile" class="form-label">Mobile:</label>
                    <input type="text" id="mobile" name="mobile" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>

                <div class="text-center">
                    <button type="submit" name="view" class="btn btn-primary mt-3">View</button>
                </div>
            </div>
        </form>
    </div>




   
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
<?php
require("./includes/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];

    $stmt = $conn->prepare("SELECT * FROM booking WHERE email = ? AND phone = ?");
    $stmt->bind_param("ss", $email, $mobile);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $ticket = $result->fetch_assoc();
    } else {
        echo "<script>alert('No booking found!'); window.location='index.php';</script>";
        exit();
    }
}
?>

