<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$servername = "localhost";
$username   = "root";
$password   = "";
$database   = "rims";

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die("Sorry we failed to connect: " . mysqli_connect_error());
}
?>