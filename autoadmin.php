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
$admin_id = "Admin";
$admin_pass = "Admin";

// Check if admin already exists
$check_sql = "SELECT `admin-ID` FROM `admin` WHERE `admin-ID` = 'Admin'";
$result = $conn->query($check_sql);

if ($result->num_rows == 0) {
    // Insert admin if not found
    $insert_sql = "INSERT IGNORE INTO `admin` (`admin-ID`, `admin-Password`) VALUES ('$admin_id', '$admin_pass')";
    if ($conn->query($insert_sql) == TRUE) {
    } else {
        echo "Error inserting admin: " . $conn->error;
    }
} else {
}
?>
