<?php
// Database connection 
$conn = mysqli_connect('localhost', 'root', '', 'redbus');
if (!$conn) {
    echo mysqli_connect_error();
}
