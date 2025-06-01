<?php 
$servername = "localhost";
$username = "root";     
$password = "";         
$dbname = "BrewnGo";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Admin credentials
$admin_id = "admin";
$admin_pass = "admin";

// SQL to insert data
$sql = "INSERT INTO `admin` (`admin-ID`, `admin-Password`) VALUES ('$admin_id', '$admin_pass')";

// Execute and check result
if ($conn->query($sql) === TRUE) {
    echo "Admin user inserted successfully.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>
