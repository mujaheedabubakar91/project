<?php
$hostname = 'localhost'; // Change this to your database server's hostname
$username = 'root'; // Change this to your database username
$password = ''; // Change this to your database password
$database = 'ecommerce'; // Change this to your database name

$conn = new mysqli($hostname, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// echo "Connected to the database!";
?>
