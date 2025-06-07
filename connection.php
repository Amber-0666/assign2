<?php
$servername = "localhost";

// Input credentials (can come from env or form; hardcoded here)
$usernameInput = 'root';
$passwordInput = ''; // Empty password

// Convert to lowercase for case-insensitive comparison
$username = strtolower($usernameInput);
$password = strtolower($passwordInput);

// Create connection to server (no database yet)
$conn = mysqli_connect($servername, $username, $password);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create database if not exists
$sql = "CREATE DATABASE IF NOT EXISTS BrewnGo";
if (!mysqli_query($conn, $sql)) {
    die("Error creating database: " . mysqli_error($conn));
}

// Close initial connection
mysqli_close($conn);

// Reconnect to the newly created BrewnGo database
$conn = mysqli_connect($servername, $username, $password, "BrewnGo");

// Check connection again
if (!$conn) {
    die("Connection to BrewnGo failed: " . mysqli_connect_error());
}
?>
