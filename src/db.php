<?php
// Initialise the Database connection
$host = 'localhost';
$db = 'rolsa'; 
$user = 'root';

$conn = new mysqli($host, $user, null, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else {
}
?>