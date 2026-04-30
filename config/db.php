<?php
$loclhost = 'localhost'; 
$username = 'root'; 
$password = ''; 
$db_name = 'srs_electrical'; 

// Connection
$conn = new mysqli($loclhost, $username, $password, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>