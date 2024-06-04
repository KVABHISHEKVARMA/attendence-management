<?php

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "attsystem";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

echo "Connected successfully to the database.";

// You can now use $conn in your queries, e.g.,
// $result = mysqli_query($conn, "SELECT * FROM admininfo");

?>
