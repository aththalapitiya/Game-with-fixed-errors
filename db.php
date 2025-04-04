<?php
$servername = "localhost";
$username = "root"; // Change this if you have a different DB user
$password = ""; // Change this if you have a password
$database = "whac_a_banana"; // Your database name


$conn = new mysqli($servername, $username, $password, $database);  //--> connection that created for the database

if ($conn->connect_error) {                           //--> checks the conn 
    die("Connection failed: " . $conn->connect_error);
}
?>
