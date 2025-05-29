<?php
require("./include/config.php");
session_start();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM inquiry WHERE id='$id'";
    $delete = mysqli_query($conn, $query);

    if ($delete) {
        echo '<script>alert("inquiry deleted successfully.");</script>';
        header("location: inquiry.php");
    } else {
        echo '<script>alert("Error deleting bus.");</script>';
    }
}
