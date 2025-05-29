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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>My Bus</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600&family=Roboto&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">


    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/selectseat.css" rel="stylesheet">
    <style>
        .seat {
            background-color: white;
        }

        .seat:checked {
            background-color: green;
        }

        .seat.selected {
            background-color: red;
        }
    </style>
</head>

<body>

    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar & Hero Start -->
    <?php include("./includes/nav.php") ?>
    <!-- Navbar & Hero End -->

    <!-- Header Start -->
    <div class="container-fluid bg-breadcrumb">
        <div class="container text-center py-5" style="max-width: 900px;">
            <h3 class="text-white display-3 mb-4">Booking</h1>
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item active text-white">About</li>
                </ol>
        </div>
    </div>
    <!-- Header End -->

    <div class="container mt-5 selectseat">
        <h2 class="mb-4 text-center mt-3 ">Select Your Seat</h2>
        <h4><input type="text" disabled class="bseat">BOOKED</h4>

        <?php
        require("./includes/db.php");
        if (isset($_GET['bus_number'])) {
            $busId = $_GET['bus_number'];
        
            $query = "SELECT * FROM `bus_details` WHERE `bus_number`='$busId'";
            $select = mysqli_query($conn, $query);
        
            if ($select) {
                $row = mysqli_fetch_array($select);
                $busnumber = $row['bus_number'];
              

                if (isset($row) && is_array($row)) {
                    echo '<form action="booking.php" method="post" class="form1">';
                    echo '<input type="hidden" name="busnumber" value="' . $busnumber . '">';
                    echo '<div class="bus">';
                    echo '<div class="row"><i class="fa fa-wheelchair" aria-hidden="true" id="fafa"></i></div>';
                    
                    $totalSeats = $row['total_seats'];

                  
                    echo '<div id="seats-container">';
                    
                    $query1 = "SELECT seat_number FROM `booking` WHERE `bus_number`='$busId'";
                    $select1 = mysqli_query($conn, $query1);
                        
                    if ($select1->num_rows > 0) 
                    {
                        $bookedSeats = [];
                        while ($row1 = $select1->fetch_assoc()) {
                            $bookedSeats[] = $row1['seat_number'];
                        }
                        
                        for ($i = 1; $i <= $totalSeats; $i++) {
                            if ($i % 4 == 1) {
                                echo '<div class="row">';
                            }
                            
                            $seat_id = "seat_" . $i;
                            
                            if (in_array($i, $bookedSeats)) {
                                echo '<input type="checkbox" name="seats[]" id="' . $seat_id . '" class="bseat selected" value="' . $i . '" disabled>';
                            } else {
                                echo '<input type="checkbox" name="seats[]" id="' . $seat_id . '" class="seat" value="' . $i . '">';
                            }
        
                            if ($i % 4 == 0 || $i == $totalSeats) {
                                echo '</div>';
                            }
                        }
                    }
                    else
                    {
                        for ($i = 1; $i <= $totalSeats; $i++) {
                            if ($i % 4 == 1) {
                                echo '<div class="row">';
                            }
                            
                            $seat_id = "seat_" . $i;
                            
                          
                                echo '<input type="checkbox" name="seats[]" id="' . $seat_id . '" class="seat" value="' . $i . '">';
                           
        
                            if ($i % 4 == 0 || $i == $totalSeats) {
                                echo '</div>';
                            }
                        }
                    }
                    
                    echo '</div>';
                    echo '<button type="submit" class="btn btn-primary w-25 mt-5 mb-4">Save</button>';
                    echo '</div>';
                    echo '</form>';
                } else {
                    echo '<p>No bus details found.</p>';
                }
            } else {
                $errormsg = "Error fetching bus details";
            }
        }
        
        ?>





    </div>


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

    <script>
        document.addEventListener("DOMContentLoaded", function () {
    const seatCheckboxes = document.querySelectorAll('.seat');
    
    seatCheckboxes.forEach(seat => {
        seat.addEventListener('change', function () {
            // Deselect other checkboxes if one is selected
            if (this.checked) {
                seatCheckboxes.forEach(otherSeat => {
                    if (otherSeat !== this) {
                        otherSeat.checked = false;
                    }
                });
            }
        });
    });
});

    </script>

    <!-- Template Javascript -->
    <script src="js/main.js">

    </script>
</body>

</html>




