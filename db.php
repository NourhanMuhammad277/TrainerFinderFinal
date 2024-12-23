<?php
$servername = "localhost"; // Host
$username = "root"; // Your MySQL username (default is 'root')
$password = ""; // Your MySQL password (default is empty)
$dbname = "TrainerFinder"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
