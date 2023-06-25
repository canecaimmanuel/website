<?php

// Start the session
session_start();

// Prevent CORS policy errors
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');

// Change this to your local settings
$servername = "localhost";
$username = "admin_imman";
$password = "ipAaa4./K5Gk5u0x";
$dbname = "kodego_db";

// Make a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if($conn->connect_error) {
    die("Connection error: " . $conn->connect_error);
}

?>