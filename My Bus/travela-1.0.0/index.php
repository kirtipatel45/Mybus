<!-- search.php -->
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

$msg = '';
$errormsg = '';


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>My Bus </title>
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
    <div class="col-md-12">
      <form action="" method="post" class="container-fluid search-bar position-relative">
        <div class="container mt-5 ">
          <div class="position-relative rounded-pill mx-auto p-5" style="background: rgba(19, 53, 123, 0.8); display: flex; align-items: center;">
            <label for="from" style="margin-right: 10px;">From:</label>
            <input class="form-control border-0 rounded-pill py-3 ps-4 pe-5" type="text" name="from" placeholder="Enter starting destination"  style="flex: 3;" pattern="[A-Za-z]+" title="letters only" required >

            <label for="to" style="margin-right: 10px; margin-left:10px">To:</label>
            <input class="form-control border-0 rounded-pill py-3 ps-4 pe-5" type="text" name="to" placeholder="Enter destination"  style="flex: 3;" pattern="[A-Za-z]+" title="letters only" required >

            <button type="submit" name="search" class="btn btn-primary rounded-pill py-2 px-4 ml-10" style="margin-left: 10px;">
              Search
            </button>
          </div>
        </div>
      </form>

      <!-- Assuming the $result variable contains the fetched data -->
      <?php
      // Get the current date in the format YYYY-MM-DD
      $currentDate = date("Y-m-d");

      // Get the current time in the format HH:MM:SS
      $currentTime = date("H:i:s");

      // Get the current date and time in the format YYYY-MM-DD HH:MM:SS
      $currentDateTime = date("Y-m-d H:i:s");
      if (isset($_POST['search'])) {
        $fromLocation = $_POST['from'];
        $toLocation = $_POST['to'];
        $sql = "SELECT * FROM `bus_details` WHERE `from_location` = '$fromLocation' AND `to_location` = '$toLocation'";
        $result = mysqli_query($conn, $sql);
      
      if ($result && mysqli_num_rows($result) > 0) {
        echo '<div class="text-center mt-5">';
        echo '<table class="table table-bordered mx-auto w-75">';
        echo '<thead class="thead-dark">';
        echo '<tr>';
        echo '<th scope="col">Bus Name</th>';
        echo '<th scope="col">Bus Number</th>';
        echo '<th scope="col">From Location</th>';
        echo '<th scope="col">To Location</th>';
        echo '<th scope="col">Arrival Time</th>';
        echo '<th scope="col">Seat Price</th>';
        echo '<th scope="col">Bus Type</th>';
        echo '<th scope="col">Total Seats</th>';
        echo '<th scope="col">Action</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        while ($row = mysqli_fetch_assoc($result)) {
          echo '<tr>';
          echo '<td>' . htmlentities($row['bus_name']) . '</td>';
          echo '<td>' . htmlentities($row['bus_number']) . '</td>';
          echo '<td>' . htmlentities($row['from_location']) . '</td>';
          echo '<td>' . htmlentities($row['to_location']) . '</td>';
          echo '<td>' . htmlentities($row['arrival_time']) . '</td>';
          echo '<td>' . htmlentities($row['seat_price']) . '</td>';
          echo '<td>' . htmlentities($row['bus_type']) . '</td>';
          echo '<td>' . htmlentities($row['total_seats']) . '</td>';
          echo '<td><a href="addseat.php?bus_number=' . $row['bus_number'] . '" class="btn btn-primary">Book Now</a></td>';
          echo '</tr>';
        }
        echo '</tbody></table>';
        echo '</div>';
      } else {
        echo '<p class="text-center mt-5">No matching buses found for the provided locations.</p>';
      }
    }
      ?>

    </div>
  </div>

  <!-- Navbar & Hero End -->

  <!-- About Start -->
  <div class="container-fluid about py-5">
    <div class="container py-5">
      <div class="row g-5 align-items-center">
        <div class="col-lg-5">
          <div class="h-100" style="
                border: 50px solid;
                border-color: transparent #13357b transparent #13357b;
              ">
            <img src="images/1.png" class="img-fluid w-100 h-100" alt="" />
          </div>
        </div>
        <div class="col-lg-7" style="
              background: linear-gradient(
                  rgba(255, 255, 255, 0.8),
                  rgba(255, 255, 255, 0.8)
                ),
                url(images/1.png);
            ">
          <h5 class="section-about-title pe-3">About Us</h5>
          <h1 class="mb-4">
            Welcome to <span class="text-primary">My Bus</span>
          </h1>
          <p class="mb-4">
          About Us

Welcome to My Bus, your premier destination for convenient and hassle-free bus travel. 
          </p>
          <p class="mb-4">
          At My Bus , we are dedicated to providing travelers with a seamless booking experience and comfortable journeys to their desired destinations.
          </p>
        </div>
      </div>
    </div>
    <!-- About End -->

    <!-- Services Start -->
    <div class="container-fluid bg-light service py-5">
      <div class="container py-5">
        <div class="mx-auto text-center mb-5" style="max-width: 900px">
          <h5 class="section-title px-3">Searvices</h5>
          <h1 class="mb-0">Our Services</h1>
        </div>
        <div class="row g-4">
          <div class="col-lg-6">
            <div class="row g-4">
              <div class="col-12">
                <div class="service-content-inner d-flex align-items-center bg-white border border-primary rounded p-4 pe-0">
                  <div class="service-content text-end">
                    <h5 class="mb-4">Easy Booking Process</h5>
                    <p class="mb-0">
                    Our intuitive booking system allows you to effortlessly reserve your seats with just a few clicks. Simply select your desired route, choose your preferred seats, and complete the booking process hassle-free.
                    </p>
                  </div>
                  <div class="service-icon p-4">
                    <i class="fa fa-globe fa-4x text-primary"></i>
                  </div>
                </div>
              </div>
            
              <div class="col-12">
                <div class="service-content-inner d-flex align-items-center bg-white border border-primary rounded p-4 pe-0">
                  <div class="service-content text-end">
                    <h5 class="mb-4">Wide Range of Destinations</h5>
                    <p class="mb-0">
                    Whether you're planning a short commute or a long-distance journey, we've got you covered. Explore our extensive network of routes, connecting major cities, towns, and tourist destinations across the region.
                    </p>
                  </div>
                  <div class="service-icon p-4">
                    <i class="fa fa-user fa-4x text-primary"></i>
                  </div>
                </div>
              </div>
             
            </div>
          </div>
          <div class="col-lg-6">
            <div class="row g-4">
              <div class="col-12">
                <div class="service-content-inner d-flex align-items-center bg-white border border-primary rounded p-4 ps-0">
                  <div class="service-icon p-4">
                    <i class="fa fa-globe fa-4x text-primary"></i>
                  </div>
                  <div class="service-content">
                    <h5 class="mb-4">Flexible Ticket Options</h5>
                    <p class="mb-0">
                    We understand that travel plans can change, which is why we offer flexible ticket options. Choose from a variety of fare types, including one-way, round-trip, and open tickets, to suit your schedule and budget.
                    </p>
                  </div>
              </div>
             
            
              <div class="col-12">
                <div class="service-content-inner d-flex align-items-center bg-white border border-primary rounded p-4 ps-0">
                  <div class="service-icon p-4">
                    <i class="fa fa-cog fa-4x text-primary"></i>
                  </div>
                  <div class="service-content">
                    <h5 class="mb-4">Comfortable Seating</h5>
                    <p class="mb-0">
                    Sit back, relax, and enjoy the journey in our comfortable and spacious seats. We prioritize passenger comfort and ensure that every seat is designed for maximum relaxation, with ample legroom and adjustable features.
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Services End -->

    <!-- Tour Booking Start -->
 
  </div>
  </div>
  </div>
  <!-- Tour Booking End -->

  <!-- Footer Start -->
  <div class="container-fluid footer py-5">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="footer-item d-flex flex-column">
                        <h4 class="mb-4 text-white">Get In Touch</h4>
                        <a href=""><i class="fas fa-home me-2"></i> 949/2, Dream Express</a>
                        <a href=""><i class="fas fa-envelope me-2"></i> info@example.com</a>
                        <a href=""><i class="fas fa-phone me-2"></i> +91 69896 58745</a>
                        <a href="" class="mb-3"><i class="fas fa-print me-2"></i> +91 69875 98698</a>
                        <div class="d-flex align-items-center">
                            <i class="fas fa-share fa-2x text-white me-2"></i>
                            <a class="btn-square btn btn-primary rounded-circle mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn-square btn btn-primary rounded-circle mx-1" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn-square btn btn-primary rounded-circle mx-1" href=""><i class="fab fa-instagram"></i></a>
                            <a class="btn-square btn btn-primary rounded-circle mx-1" href=""><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="footer-item d-flex flex-column">
                        <h4 class="mb-4 text-white">Company</h4>
                        <a href=""><i class="fas fa-angle-right me-2"></i> About</a>
                        <a href=""><i class="fas fa-angle-right me-2"></i> Careers</a>
                        <a href=""><i class="fas fa-angle-right me-2"></i> Blog</a>
                        <a href=""><i class="fas fa-angle-right me-2"></i> Press</a>
                        <a href=""><i class="fas fa-angle-right me-2"></i> Gift Cards</a>
                        <a href=""><i class="fas fa-angle-right me-2"></i> Magazine</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
  <!-- Footer End -->

  <!-- Copyright Start -->
 
  </div>
  <!-- Copyright End -->

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