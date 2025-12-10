<?php


// Change these values according to your local setup
$host = "localhost";      // server host (XAMPP/WAMP/Laragon)
$user = "root";           // database username
$pass = "";               // database password (mostly empty in XAMPP/WAMP)
$dbname = "ecommerce_db";    // your database name

// Create connection
$conn = mysqli_connect($host, $user, $pass, $dbname);

// Check connection
if (!$conn) {
    die("Database Connection Failed: " . mysqli_connect_error());
}

?>