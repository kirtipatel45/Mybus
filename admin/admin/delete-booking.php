<?php
require("./include/config.php");
session_start();

if (isset($_GET['bookingid'])) {
    $bookingid = $_GET['bookingid'];

    $query = "DELETE FROM booking WHERE id='$bookingid'";
    $delete = mysqli_query($conn, $query);

    if ($delete) {
        echo '<script>alert("Bus deleted successfully.");</script>';
        header("location: manage-booking.php");
    } else {
        echo '<script>alert("Error deleting bus.");</script>';
    }
}
