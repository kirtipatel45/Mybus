<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Travela - Tourism Website Template</title>
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
        if (isset($_GET['bus_number'])) 
        {
            $busId = $_GET['bus_number'];


            $query = "SELECT * FROM `bus_details` WHERE `bus_number`='$busId'";
            $select = mysqli_query($conn, $query);

            if ($select) {
                $row = mysqli_fetch_array($select);
                $busnumber = $row['bus_number'];
                if (isset($row) && is_array($row)) 
                {
                    echo '<form action="booking.php" method="post" class="form1">';
                    echo '<input type="hidden" name="busnumber" value="' . $busnumber . '">';
                    echo '<div class="bus">';
                    echo '<div class="row"><i class="fa fa-wheelchair" aria-hidden="true" id="fafa"></i></div>';
                    $selectedSeats = [];

                    $totalSeats = $row['total_seats'];
                    echo '<div id="seats-container">';
                    $query1 = "SELECT seat_number FROM `booking` WHERE `bus_number`='$busId'";
                        $select1 = mysqli_query($conn, $query1);
                           
                        if ($select1->num_rows > 0) 
                        {
                            while ($row1 = $select1->fetch_assoc()) 
                            {  
                                $snumber = $row1['seat_number'];
                          
                                for ($i = 1; $i <= $totalSeats; $i++) 
                                {
                                    $seat_id = "seat_" . $i;
                        
                                    if($i==$snumber)
                                    {
                                        echo $snumber;
                                        $cname='b';
                                        // echo '<input type="checkbox" name="seats[]" id="' . $seat_id . '" class="seat" value="' . $i . '">';
                                        echo '<input type="checkbox"  name="seats[]" id="' . $seat_id . '" class="bseat'.(in_array($i, $selectedSeats)?'selected' :'') .'" value="' . $i . '" disabled>';
                                    }
                                    else
                                    {
                                        echo '<input type="checkbox" name="seats[]" id="' . $seat_id . '" class="seat' . (in_array($i, $selectedSeats) ? 'selected' : '') . '" value="' . $i . '">';
                                        if ($i % 4 == 0 || $i == $totalSeats) 
                                        {
                                            echo '</div>';
                            
                                        }
                                    }  
                                }
                            }
                        }
                        // echo '<input type="checkbox" name="seats[]" id="' . $seat_id . '" class="seat" value="' . $i . '">';
                       
                    }

                    echo '<button type="submit" class="btn btn-primary w-25 mt-5 mb-4">Save</button>';
                    echo '</div>';
                    echo '</form>';
                } else {
                    echo '<p>No bus details found.</p>';
                }
            } else {
                $errormsg = "Error fetching bus details";
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
                        <a href=""><i class="fas fa-home me-2"></i> 123 Street, New York, USA</a>
                        <a href=""><i class="fas fa-envelope me-2"></i> info@example.com</a>
                        <a href=""><i class="fas fa-phone me-2"></i> +012 345 67890</a>
                        <a href="" class="mb-3"><i class="fas fa-print me-2"></i> +012 345 67890</a>
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
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="footer-item d-flex flex-column">
                        <h4 class="mb-4 text-white">Support</h4>
                        <a href=""><i class="fas fa-angle-right me-2"></i> Contact</a>
                        <a href=""><i class="fas fa-angle-right me-2"></i> Legal Notice</a>
                        <a href=""><i class="fas fa-angle-right me-2"></i> Privacy Policy</a>
                        <a href=""><i class="fas fa-angle-right me-2"></i> Terms and Conditions</a>
                        <a href=""><i class="fas fa-angle-right me-2"></i> Sitemap</a>
                        <a href=""><i class="fas fa-angle-right me-2"></i> Cookie policy</a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="footer-item">
                        <div class="row gy-3 gx-2 mb-4">
                            <div class="col-xl-6">
                                <form>
                                    <div class="form-floating">
                                        <select class="form-select bg-dark border" id="select1">
                                            <option value="1">Arabic</option>
                                            <option value="2">German</option>
                                            <option value="3">Greek</option>
                                            <option value="3">New York</option>
                                        </select>
                                        <label for="select1">English</label>
                                    </div>
                                </form>
                            </div>
                            <div class="col-xl-6">
                                <form>
                                    <div class="form-floating">
                                        <select class="form-select bg-dark border" id="select1">
                                            <option value="1">USD</option>
                                            <option value="2">EUR</option>
                                            <option value="3">INR</option>
                                            <option value="3">GBP</option>
                                        </select>
                                        <label for="select1">$</label>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <h4 class="text-white mb-3">Payments</h4>
                        <div class="footer-bank-card">
                            <a href="#" class="text-white me-2"><i class="fab fa-cc-amex fa-2x"></i></a>
                            <a href="#" class="text-white me-2"><i class="fab fa-cc-visa fa-2x"></i></a>
                            <a href="#" class="text-white me-2"><i class="fas fa-credit-card fa-2x"></i></a>
                            <a href="#" class="text-white me-2"><i class="fab fa-cc-mastercard fa-2x"></i></a>
                            <a href="#" class="text-white me-2"><i class="fab fa-cc-paypal fa-2x"></i></a>
                            <a href="#" class="text-white"><i class="fab fa-cc-discover fa-2x"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Copyright Start -->
    <div class="container-fluid copyright text-body py-4">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-md-6 text-center text-md-end mb-md-0">
                    <i class="fas fa-copyright me-2"></i><a class="text-white" href="#">Your Site Name</a>, All right reserved.
                </div>
                <div class="col-md-6 text-center text-md-start">
                    <!--/*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/-->
                    <!--/*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/-->
                    <!--/*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/-->
                    Designed By <a class="text-white" href="https://htmlcodex.com">HTML Codex</a>
                </div>
            </div>
        </div>
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