<?php
$servername = "lamp.ii.us.edu.pl";
$username = "ii292684";
$password = "Jg*4KM81=<5pM";

// Create connection
$conn = mysqli_connect($servername, $username, $password);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
?>