<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$servername = "localhost";
$username   = "root";  // change if your DB user is different
$password   = "";      // change if your DB password is not empty
$database   = "ivoric"; // your DB name
$port = 3308;
$con = mysqli_connect($servername, $username, $password, $database,$port);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
