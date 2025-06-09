<?php
include 'connection.php';

// Create enquiry table
$sql_enquiry = "CREATE TABLE IF NOT EXISTS enquiry (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `first_name` VARCHAR(50) NOT NULL,
    `last_name` VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    phone VARCHAR(15),
    street VARCHAR(100),
    city VARCHAR(50),
    `state` VARCHAR(50),
    postcode VARCHAR(10),
    `enquiry_type` VARCHAR(50),
    `message` TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

// Create joinus table
$sql_joinus = "CREATE TABLE IF NOT EXISTS joinus (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    email VARCHAR(100),
    phone VARCHAR(15),
    street VARCHAR(100),
    city VARCHAR(50),
    `state` VARCHAR(50),
    postcode VARCHAR(10),
    cv_filename VARCHAR(255),
    photo_filename VARCHAR(255),
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
    `register-Password` VARCHAR(255),
    balance DECIMAL(10,2) DEFAULT 0.00
)";

// Create admin table
$sql_admin = "CREATE TABLE IF NOT EXISTS admin (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `admin-ID` VARCHAR(10),
    `admin-Password` VARCHAR(255)
)";

// Create top-up history table
$sql_topup = "CREATE TABLE IF NOT EXISTS topup_history (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    register_ID VARCHAR(10) NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    topup_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

$products_table = "CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    category VARCHAR(50) NOT NULL,
    price_mp DECIMAL(5,2) NOT NULL,
    price_np DECIMAL(5,2) NOT NULL,
    image VARCHAR(255),
    description TEXT
)";

// Execute queries and output result
if (mysqli_query($conn, $sql_enquiry) && 
    mysqli_query($conn, $sql_joinus) &&
    mysqli_query($conn, $sql_register) &&
    mysqli_query($conn, $sql_user) &&
    mysqli_query($conn, $sql_admin) &&
    mysqli_query($conn, $sql_topup)) {
} else {
    echo "Error creating tables: " . mysqli_error($conn);
}

mysqli_close($conn);
?>

<?php
include 'autoadmin.php';
?>