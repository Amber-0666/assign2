<?php
include 'connection.php';

// Create enquiry table
$sql_enquiry = "CREATE TABLE IF NOT EXISTS enquiry (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    phone VARCHAR(15),
    message TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

// Create joinus table
$sql_joinus = "CREATE TABLE IF NOT EXISTS joinus (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    email VARCHAR(100),
    phone VARCHAR(15),
    street VARCHAR(100),
    city VARCHAR(50),
    state VARCHAR(50),
    postcode VARCHAR(10),
    cv_file VARCHAR(255),
    photo_file VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

// Create register table
$sql_register = "CREATE TABLE IF NOT EXISTS register (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    loginid VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

// Create user table
$sql_user = "CREATE TABLE IF NOT EXISTS user (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `register-ID` VARCHAR(10),
    `register-Password` VARCHAR(255)
)";

// Create admin table
$sql_admin = "CREATE TABLE IF NOT EXISTS admin (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `admin-ID` VARCHAR(10),
    `admin-Password` VARCHAR(255)
)";

// Execute queries and output result
if (mysqli_query($conn, $sql_enquiry) &&
    mysqli_query($conn, $sql_joinus) &&
    mysqli_query($conn, $sql_register) &&
    mysqli_query($conn, $sql_user) &&
    mysqli_query($conn, $sql_admin)) {
    echo "All tables created successfully or already exist.";
} else {
    echo "Error creating tables: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
