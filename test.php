<?php
// Database connection settings
$servername = "localhost"; // Host
$username = "root"; // Your MySQL username (default is 'root')
$password = ""; // Your MySQL password (default is empty)
$dbname = "TrainerFinder"; // Your database name

// Create a new MySQLi instance with error handling
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    echo "Connection failed: " . $conn->connect_error;
} else {
    echo "Connected successfully!";
}

$conn->close();
?>
