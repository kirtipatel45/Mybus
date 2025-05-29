<?php
require("./include/config.php");
session_start();

if (isset($_GET['busid'])) {
    $busId = $_GET['busid'];

    $query = "DELETE FROM bus_details WHERE id='$busId'";
    $delete = mysqli_query($conn, $query);

    if ($delete) {
        echo '<script>alert("Bus deleted successfully.");</script>';
        header("location: manage-bus.php");
    } else {
        echo '<script>alert("Error deleting bus.");</script>';
    }
}
